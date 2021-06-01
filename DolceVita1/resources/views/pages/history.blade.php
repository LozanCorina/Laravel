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
        <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    @if($user->orders->count())
        <div class="card  p-2">
        <table class="table-responsive table-hover shopping-cart-wrap p-1">
        <thead class="text-muted">
        <tr>
        <th scope="col">Produs</th>
        <th scope="col" class="text-center" style="width:150px;">Cantitate</th>
        <th scope="col" class="text-center"style="width:150px;">Gramaj</th>
        <th scope="col" class="text-center" style="width:150px;">Preț</th>
        <th scope="col" class="text-center" style="width:150px;">Data achiziție</th>
        <th scope="col" class="text-center" style="width:150px;">Statut comandă</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $data)   
          @foreach($data->products as $product)
        
        <tr >
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
            <td class="text-center">
                    {{$product->pivot->qty}} 
            </td>  
            <td class="text-center">
                    {{$product->pivot->weight}} 
            </td> 
            <td>
                    <div class="price-wrap">
                        <var class="price">{{returnPriceFormat($product->pivot->price)}}</var>
                    </div> <!-- price-wrap .// -->
                    <div class="price-wrap">
                        <var class="price"> &nbsp;<small class="text-muted"> {{returnPriceFormat($product->pivot->totalprice)}}(Total)</small></var>
                    </div> <!-- price-wrap  -->
            </td>
            <td class="text-center">
                {{date_format($product->pivot->created_at,'Y-m-d')}} 
            </td>   
            <td class="text-center">
                <span>{{$data->order_status}}<span>
                
            </td>  
        </tr>    
             @endforeach    
        @endforeach  
        <!-- personal products history --> 
          @foreach($user->personal_order as $product)
          @if($product->pivot->ordered == 1)
        <tr >
            <td>
                <figure class="media">
                    <div class="img-wrap"><img src="{{asset('front_assets/images/banners/pers.jpg')}}" class="img-thumbnail img-sm"></div>
                <figcaption class="media-body">
                        <h6 class="title text-truncate">{{$product->descriere}}  Nr#{{$product->pivot->id}} </h6>
                        <dl class="dlist-inline small">
                            <dt>Descriere: </dt>
                            <?php
                                $prod=App\Models\PersonalOrder::find($product->pivot->id);
                            ?>
                            @foreach($prod->characteristic as $p)
                            <dd>{{$p->characteristic.' '.$p->pivot->value }}</dd>
                            @endforeach  
                        </dl>
                    </figcaption>
                </figure>
            </td>
            <td class="text-center">
                    {{$product->pivot->qty}} 
            </td>  
            <td class="text-center">
                    {{$product->pivot->weight}} 
            </td> 
            <td>
                    <div class="price-wrap">
                        <var class="price">{{returnPriceFormat($product->pivot->price)}}</var>
                    </div> <!-- price-wrap .// -->
                    <div class="price-wrap">
                        <var class="price"> &nbsp;<small class="text-muted"> {{returnPriceFormat($product->pivot->totalprice)}}(Total)</small></var>
                    </div> <!-- price-wrap  -->
            </td>
            <td class="text-center">
                {{date_format($product->pivot->created_at,'Y-m-d')}} 
            </td>   
            <td class="text-center">
                <span>{{$data->order_status}}<span>
                
            </td>  
        </tr>    @endif
        @endforeach 
        </tbody>
        </table>
        <div class="content">
           
        </div>
        </div> <!-- card.// -->
        @else
            <div class="alert-success">
                <div class="alert alert-success alert-block">
                     <strong>Nu sunt produse achiziționate!</strong>
                 </div>
            </div>
        @endif
    </main> <!-- col.// -->
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
