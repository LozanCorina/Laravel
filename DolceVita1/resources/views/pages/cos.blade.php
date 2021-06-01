@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')

<section class="section-content bg padding-y border-top">
    <div class="container">
    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif 
        @if($message=Session::get('success_message'))
        <div class="alert-success">
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{$message}}</strong>
            </div>
        </div>
        @endif  
    </div>
    <div class="row">
        <main class="col-xl-9 col-lg-9 col-md-12 col-sm-12">   
            @if($items->count() or  $countData!=0)      
            <div class="card p-2">
                <table class="table-responsive table-hover shopping-cart-wrap">
                    <thead class="text-muted">
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col" width="120">Cantitate</th>                 
                            <th scope="col" width="120">Gramaj <small class="text-muted">(kg)</small></th>        
                            <th scope="col" width="120">Preț</th>
                            <th scope="col" class="text-right" width="200">Acțiune</th>
                        </tr>
                    </thead>
                    @foreach($products->product as $product) 
                    <tbody>
                        <tr>
                            <td>
                                <figure class="media">
                                    <a href="{{route('categorii.detalii',['categorii'=>$product->categories->descriere,'detalii'=>$product->nume] )}}">
                                        <div class="img-wrap"><img src="{{asset('storage/'.$product->img)}}" class="img-thumbnail img-sm"></div>
                                    </a>
                                    <figcaption class="media-body">
                                        <h6 class="title text-truncate">{{$product->nume}} </h6>
                                        <dl class="dlist-inline small">
                                            <dt>Descriere: </dt>
                                            <dd>{{$product->descriere}}</dd>
                                        </dl>
                                    </figcaption>
                                </figure>
                            </td>	
                            <td>
                                <form  method="POST" action="{{route('cos.update',$product->pivot->id)}}" >
                                @csrf    
                                @method('PUT')                
                                    <input  name="quantity" class="form-control" type="number" min="1" max="10" value="{{$product->pivot->qty}}">                                            
                            </td>           
                            <td>
                                @if($product->categories->um!='bucata' and $product->categories->descriere!='auxiliar')
                                    <input  name="gramaj" class="form-control" type="number" min="1" max="10" width="50px;" value="{{$product->pivot->weight}}">                 
                                @elseif($product->categories->um =='bucata' and $product->categories->descriere != 'auxiliar')
                                <input  name="gramaj" class="form-control" type="number" min="1" max="10" width="50px;" value="{{$product->pivot->weight}}" readonly>                 
                                @endif
                            </td>
                            <td>
                                <div class="price-wrap">
                                    <var class="price" name="price">{{returnPriceFormat($product->pivot->price)}}</var>                            
                                </div> <!-- price-wrap .// -->     
                                <div class="price-wrap">
                                    <var class="price" id="subTotal">{{returnPriceFormat($product->pivot->totalprice)}} &nbsp;<small class="text-muted">(subTotal)</small></var>
                                </div> <!-- price-wrap  -->              
                            </td>
                            <td class="text-right">
                                <button data-original-title="Salvează modificarea" type="submit" title="" class="btn btn-outline-success" data-toggle="tooltip"> <i class="fa fa-check"></i></button>       
                            </form>
                                <form class="form-prevent" style="display:inline;" action="{{route('adauga.favorite',['produs'=>$product->id])}}" method="POST">
                                @csrf
                                <button data-original-title="Salvează la favorite" onClick="this.form.submit(); this.disabled=true;" class="btn btn-outline-primary buttom-prevent" data-toggle="tooltip"> <i class="fa fa-heart"></i></button>
                            </form>
                            <form method="POST" action="{{route('cos.destroy',$product->pivot->id)}}"> 
                                @csrf    
                                @method('DELETE')    
                                <input type="hidden" name="quantity" value="{{$product->pivot->qty}}">
                                <button type="submit" onclick="return confirm('Validați?')" class="btn btn-outline-danger" data-original-title="Șterge produsul" data-toggle="tooltip" style="width:112px;"> × Șterge</button>
                            </form>

                               
                            </td>     
                        </tr>
                    </tbody>
                        @endforeach 
                        <!-- personal order -->
                        @foreach($products->personal_order as $product) 
                        @if($product->pivot->ordered == 0)
                        <tbody>
                        <tr>
                            <td>
                                <figure class="media">  
                                        <div class="img-wrap"><img src="{{asset('front_assets/images/banners/pers.jpg')}}" class="img-thumbnail img-sm"></div>                                   
                                    <figcaption class="media-body">
                                        <h6 class="title text-truncate">{{$product->descriere}}  Nr#{{$product->pivot->id}}</h6>
                                        <dl class="dlist-inline small">
                                            <dt>Descriere: </dt>
                                            <?php
                                              $prod=App\Models\PersonalOrder::find($product->pivot->id);
                                            ?>
                                            @foreach($prod->characteristic as $p)
                                            <dd>{{$p->characteristic.' '.$p->pivot->value }},</dd>
                                            @endforeach
                                        </dl>
                                    </figcaption>
                                </figure>
                            </td>	
                            <td>
                                <form method="POST" action="{{route('update.produsP',$product->pivot->id)}}" >
                                @csrf                             
                                    <input  name="quantity" class="form-control" type="number" min="1" max="10" value="{{$product->pivot->qty}}">                                            
                            </td>           
                            <td>
                                @if($product->um!='bucata' and $product->descriere!='auxiliar')
                                    <input  name="gramaj" class="form-control" type="number" min="0" max="10" width="50px;" value="{{$product->pivot->weight}}">                 
                                @elseif($product->um =='bucata' and $product->descriere != 'auxiliar')
                                <input  name="gramaj" class="form-control" type="number" min="0" max="10" width="50px;" value="{{$product->pivot->weight}}" readonly>                 
                                @endif
                            </td>
                            <td>
                                <div class="price-wrap">
                                    <var class="price" name="price">{{returnPriceFormat($product->pivot->price)}}</var>
                                </div> <!-- price-wrap .// -->  
                                <div class="price-wrap">
                                    <var class="price" id="subTotal">{{returnPriceFormat($product->pivot->totalprice)}} &nbsp;<small class="text-muted">(subTotal)</small></var>
                                </div> <!-- price-wrap  -->                    
                            </td>
                            <td class="text-right">
                                <button data-original-title="Salvează modificarea" type="submit" title="" class="btn btn-outline-success" data-toggle="tooltip" style="width:112px;"> <i class="fa fa-check"></i></button>       
                            </form>
                                <a href="{{route('sterge.produsP',$product->pivot->id)}}" data-original-title="Șterge produsul" data-toggle="tooltip" class="btn btn-outline-danger" style="width:112px;"> × Șterge</a>
                            </td>     
                        </tr>
                    </tbody>
                    @endif
                    @endforeach 
                       <!-- end personal order -->

                </table>
            </div> <!-- card.// --> 
                        @else
                        <div class="alert-success">
                            <div class="alert alert-success alert-block">
                                <strong>Nu sunt produse în coș</strong>
                            </div>
                        </div>
                    @endif
                     <!-- recipe -->
        <div class="padding-y">
            <div class="card p-2">
                <div class="card-header">
                    <h5 class="card-title mt-2">Rețetă personalizată</h4>
                </div>
                    <div class="card-body" style="font-family: Arial, Helvetica, sans-serif; background-color:  MistyRose">
                        <div class="container">
                            <p>Nu ai găsit nimic? Crează-ți propria rețetă!</p>
                            <a href="{{route('recipe')}}"  class="btn btn-outline-success" style="width:112px;"> Începe</a>
                            <img style=" margin-top: -40px; height: auto; width: 30%; float: right;" src="{{asset('front_assets/images/banners/pers.jpg')}}" alt="Personalize recipe">
                            
                        </div>
                    </div>        
            </div>
        </div>
        </main> <!-- col.// -->
        @if(!$items->count())
        <aside class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                        <p class="alert alert-success">La o comandă în sumă de 1000 lei livrarea e gratuită. </p>
                        <p class="alert alert-success">La o comandă în sumă de 1800 lei aveti 5% reducere. </p>
                        <!--button-->  
                        @if($orders)                     
                        <figure class="itemside mb-3">
                            <a href="{{route('history')}}" class="btn btn-outline-primary" style="width: 255px;"> Istoric cumpărături</a>
                        </figure>   
                        @endif        
                    <hr>
                    <figure class="itemside mb-3">
                        <aside class="aside"><img src="{{asset('front_assets/images/icons/pay-visa.png')}}"></aside>
                        <div class="text-wrap small text-muted">
                                 Achită 1000 ( Economisește 10 lei)
                                Folosind cardul VISA
                        </div>
                    </figure>
                    <figure class="itemside mb-3">
                        <aside class="aside"> <img src="{{asset('front_assets/images/icons/pay-MasterCard.png')}}"> </aside>
                        <div class="text-wrap small text-muted">
                        Achită 1000 Economisește  2%. <br>
                        Folosind cardul MasterCard
                        </div>
                    </figure>
	            </aside> <!-- col.// -->

        @endif

        @if($items->count())
				<aside class="col-xl-3 col-lg-3 col-md-12 col-sm-12">

                        <p class="alert alert-success">La o comandă în sumă de 1000 lei livrarea e gratuită. </p>
                        <p class="alert alert-success">La o comandă în sumă de 1800 lei aveti 5% reducere. </p>
                        @if($orders)
                        <figure class="itemside mb-3">
                            <a href="{{route('history')}}" class="btn btn-outline-primary" style="width: 255px;"> Istoric cumpărături</a>
                        </figure>
                        @endif
                        <dl class="dlist-align">
                            <dt>Suma totală: </dt>
                            <dd class="text-right">{{returnPriceFormat(DB::table('cart')->where('user_id',auth()->id())->sum('totalprice')+DB::table('personal_order')->where(['user_id'=>auth()->id(),'ordered'=>0])->sum('totalprice'))}}</dd>
                        </dl>
                        <dl class="dlist-align">
                        <dt>Reducere:</dt>  
                            <dd class="text-right">{{returnPriceFormat($reducere)}}</dd>                                           
                    </dl>
                        <dl class="dlist-align h4">
                        <dt>Total:</dt>
                        <dd class="text-right"><strong>{{returnPriceFormat($finalPrice)}} </strong></dd>
                        </dl>
                        <!--button-->                       
                        <div class="form-group">                      
                            <a href="{{route('finalizare.comanda')}}" class="btn btn-primary btn-block" style="width: 255px;">Finalizare comanda  </a>
                        </div> <!-- form-group// -->            
                    </form>
                    <hr>
                    <figure class="itemside mb-3">
                        <aside class="aside"><img src="{{asset('front_assets/images/icons/pay-visa.png')}}"></aside>
                        <div class="text-wrap small text-muted">
                                 Achită 1000 ( Economisește 10 lei)
                                Folosind cardul VISA
                        </div>
                    </figure>
                    <figure class="itemside mb-3">
                        <aside class="aside"> <img src="{{asset('front_assets/images/icons/pay-MasterCard.png')}}"> </aside>
                        <div class="text-wrap small text-muted">
                        Achită 1000 Economisește  2%. <br>
                        Folosind cardul MasterCard
                        </div>
                    </figure>
	            </aside> <!-- col.// -->
            @endif
       </div>
    </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->

    <!-- ========================= SECTION  ========================= -->
    <section class="section-name bg-white padding-y">
    <div class="container">
    <header class="section-heading">
    <h2 class="title-section">Informații suplimentare</h2>
    </header><!-- sect-heading -->

    <p> Returnarea mărfii:</p>
    <p> 
        Datorită naturii artizanale a produselor noastre, nu putem oferi rambursări sau schimbăm produse de panificație și patiserie.
        Odată ce un tort a fost luat de dvs. sau de o parte desemnată, acesta este considerat "acceptat". Toate produsele sunt responsabilitatea clientului după ce acesta părăsește magazinul nostru sau după primirea de la șoferi. Restituirile solicitate datorită stilului de decorare, nuanței de culoare sau designului general de decorare nu vor fi onorate.
        Dacă aveți nevoie să amânați tortul pentru o altă dată, avem nevoie de o notificare de cel puțin 48 de ore în avans. Putem ține comanda amânată pentru o perioada nelimitată sau vă putem reprograma comanda pentru altă dată (în funcție de disponibilitate).
    </p>
    </div><!-- container // -->
    </section>
    <!-- ========================= SECTION  END// ========================= -->
@endsection
