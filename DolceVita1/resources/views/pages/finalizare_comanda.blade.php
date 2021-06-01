@extends('layouts.main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(function(){
		$('#district').change(function(){
			var delivery = $('#district option:selected').val();
            var finalPrice= parseFloat(delivery)+parseFloat({{$finalPrice}});
			$('#delivery').html(delivery +".00 Lei");		
			$('#amount').html(parseFloat(finalPrice).toFixed(2) + " Lei");
		});    
	});

    $(document).ready(function(){
			var delivery = $('#district option:selected').val();
            var finalPrice= parseFloat(delivery)+parseFloat({{$finalPrice}});
			$('#delivery').html(delivery +".00 Lei");		
			$('#amount').html(parseFloat(finalPrice).toFixed(2) + " Lei");
		});

</script>

<script>
    function Open() {
        var val = document.getElementsByName("typecheck"); 
        for(i = 0; i < val.length; i++) 
        { 
            if(val[i].checked) 
                {
                    if(val[i].value == 'cashCurier')
                    {
                        document.getElementById('online').style.display = "none";                 
                        document.getElementById('curier').style.display = "block";
                    }
                    else if(val[i].value == 'cardBancar')
                    {
                        document.getElementById('curier').style.display = "none";      
                        document.getElementById('online').style.display = "block";
                    }
                }
                
        } 
    
    }
</script>
@section('content')
<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y border-top">
<div class="container">

    @if($message=Session::get('success_message'))
            <div class="alert-success">
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{$message}}</strong>
                </div>
            </div>
    @endif  
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif    
        <div class="row">
        <main class=" col-xl-9 col-lg-9 col-md-12 col-sm-12">   
            <div class="card">
                <header class="card-header">     
                    <h4 class="card-title mt-2">Finalizare comandă</h4>
                </header>
            <article class="card-body">     
            <form  method="POST">
                     @csrf                    
                     <input type="hidden" class="form-control" name="subtotal" value="{{$totalPrice}}">
                     <input type="hidden" class="form-control" name="amount" value="{{$finalPrice}}">
                     <input type="hidden" class="form-control" name="product_discount" value="{{$reducere}}">
                    <div class="form-row">
                        <div class="col form-group">
                        @if (auth()->user())
                            <label> Nume</label>
                            <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" readonly>
                        </div> <!-- form-group end.// -->           
                    </div> <!-- form-row end.// -->
                    <div class="form-group">                   
                        <label>Adresa de email</label>
                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" readonly>
                        <small class="form-text text-muted">Nu vom divulga emailul dvs.</small>
                        @endif
                    </div> <!-- form-group end.new// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                        </div>
                        <select class="custom-select" style="max-width: 120px;">
                            <option selected="">+40</option>
                            <option value="1">+373</option>
                        </select>
                        <input name="phone" class="form-control" placeholder="Număr de contact" type="tel" length="9">
                        <input name="phoneFormat" type="hidden" >
                   </div> <!-- form-group// -->
                    <div class="form-group">
                        <label>Data livrării </label>
                        <input type="date" class="form-control" name="date" id="datePicker"  min="{{$date}}" >
                    </div> <!-- form-group// -->
                    <div class="form-group">         
                        <label>Județ</label>
                        <select class="form-control" name="city" id="district" style="max-width:800px;"> 
                            @foreach($districts as $district)
                            <option value="{{$district->pret_livrare}}">{{$district->judet}}</option>
                            @endforeach
                            </select>     
                    </div> <!-- form-row.// -->
                    <div class="form-group">
                        <label>Domiciliu</label>
                        <input type="text" name="home" class="form-control" placeholder="Localitate strada nr. ap. ">
                    </div> <!-- form-group end.// -->  
                    <div class="form-group">
                        <label>Notițe</label>
                        <input type="textarea" name="note" class="form-control" placeholder="Scrieți preferințele pentru comandă">
                    </div> <!-- form-group end.// -->                                           
                    <div class="form-group">
                        <label>Metoda de plată</label>                           
                        <div class="form-check">
                            <input class="form-check-input"  type="radio" name="typecheck" id="cashCurier" value="cashCurier" onclick="Open()" checked >
                                <label class="form-check-label" for="cashCurier">
                                Cash curierului
                                </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="typecheck" id="cardBancar"   onclick="Open()" value="cardBancar">
                                <label class="form-check-label" for="cardBancar">
                                Card bancar
                                </label>
                        </div>
                    </div>
                    <div class="form-group" id="curier" style="display:block;">
                        <button type="submit" class="btn btn-primary btn-block"  formaction="{{route('procesat')}}">Procesează</button>
                    </div> <!-- form-group// --> 
                    <div class="form-group"  id="online" style="display:none;" >
                        <button  type="submit"  class="btn btn-primary btn-block" formaction="{{route('achitare')}}">Procesează</button>
                    </div> <!-- form-group// --> 
                <small class="text-muted">Dupa ce apăsați "Procesează" sunteți de acord cu  <br> Termenii și politica noastră.</small>                                          
            </article> <!-- card-body end .// -->
            </div> <!-- card.// -->
        </main>
        <aside class="col-xl-3 col-lg-3 col-md-12 col-sm-12">                 
                    <h2>Comanda ta:</h2>
                    <hr>
                    @foreach($products->product as $product)
                    <div class="checkout-table">           
                        <div class="checkout-table-row">
                            <div class="checkout-table-row-left">
                                <div class="checkout-item-details">
                                <dl class="dlist-align">
                                        <dt>Produs:</dt>   
                                        <dd class="text-right" name="product_name">{{$product->nume}}</dd>
                                </dl>
                                    <dl class="dlist-align">
                                        <dt>Cantitate:</dt>   
                                        <dd class="text-right" name="product_qty">{{$product->pivot->qty}}</dd>
                                     </dl>
                                     <dl class="dlist-align">
                                        <dt>Gramaj:</dt>   
                                            <dd class="text-right" name="product_weight">{{$product->pivot->weight}} kg</dd>
                                     </dl>
                                     <dl class="dlist-align">
                                        <dt>Pret:</dt>   
                                            <dd class="text-right" name="product_price">{{returnPriceFormat($product->pivot->totalprice)}}</dd>                                      
                                     </dl>
                                </div>
                            </div> <!-- end checkout-table -->
                            <div class="checkout-table-row-right">
                                <div class="checkout-table-quantity"></div>
                             </div>
                        </div> <!-- end checkout-table-row -->
                    </div> <!-- end checkout-table --> 
                    @endforeach
                    @foreach($products->personal_order as $product) 
                    @if($product->pivot->ordered ==0)
                    <div class="checkout-table">           
                        <div class="checkout-table-row">
                            <div class="checkout-table-row-left">
                                <div class="checkout-item-details">
                                <dl class="dlist-align">
                                        <dt>Produs:</dt>   
                                        <dd class="text-right" name="product_name">{{$product->descriere}}  Nr#{{$product->pivot->id}}</dd>
                                </dl>
                                    <dl class="dlist-align">
                                        <dt>Cantitate:</dt>   
                                        <dd class="text-right" name="product_qty">{{$product->pivot->qty}}</dd>
                                     </dl>
                                     <dl class="dlist-align">
                                        <dt>Gramaj:</dt>   
                                            <dd class="text-right" name="product_weight">{{$product->pivot->weight}} kg</dd>
                                     </dl>
                                     <dl class="dlist-align">
                                        <dt>Pret:</dt>   
                                            <dd class="text-right" name="product_price">{{returnPriceFormat($product->pivot->price)}}</dd>
                                     </dl>
                                </div>
                            </div> <!-- end checkout-table -->
                            <div class="checkout-table-row-right">
                                <div class="checkout-table-quantity"></div>
                             </div>
                        </div> <!-- end checkout-table-row -->
                    </div> <!-- end checkout-table --> 
                    @endif
                    @endforeach
                    <hr> 
                    <dl class="dlist-align">     
                    <dt>Reducere:</dt>                      
                        <dd class="text-right">{{returnPriceFormat($reducere)}}</dd>
                    </dl>
                   
                    <dl class="dlist-align">      
                    <dt>Livrare:</dt>                          
                        <dd class="text-right" name="product_delivery" id="delivery" value="{{$livrare}}">{{returnPriceFormat($livrare)}}</dd>
                    </dl>
                        <dl class="dlist-align">
                        <dt>Total:</dt>
                        <dd class="text-right h5" name="amount" id="amount" value="{{$finalPrice}}"><strong>{{returnPriceFormat($finalPrice)}}</strong></dd>
                        </dl>
                        <hr>
                    </form> 
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
                            Achită 1000 Economisește  20%. <br>
                            Folosind cardul MasterCard
                            </div>
                        </figure>
                </aside> <!-- col.// -->
        </div> <!--end row-->
    </div> <!-- container-->
</section>
 <!-- ========================= SECTION  END// ========================= -->
@endsection
