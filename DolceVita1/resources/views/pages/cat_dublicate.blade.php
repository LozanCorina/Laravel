@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

function searchProducts()
  {
    var categorie= $('#categorie').val();
    var query= $('#compozit').val();
    var priceMin= $('#priceMin').val();
    var priceMax= $('#priceMax').val();
    var filterBy=$('#FilterBy option:selected').val();
    $.ajax({
      url:"{{route('filters')}}",
      method:'POST',
      data:{'query': query,
      'categorie': categorie,
      'priceMin': priceMin,
      'priceMax': priceMax,
      'filterBy':filterBy,
      '_token':'{{csrf_token()}}'},
      dataType:'json',
      success:function(data){
        console.log(data);
       $('#content').html(data);
      }
    });
  } 

  $(document).on('keyup','#compozit',function(){
    searchProducts();
  });

  $(document).on('keyup','#priceMin',function(){
    searchProducts();
  });
  $(document).on('keyup','#priceMax',function(){
    searchProducts();
  });
  $(document).on('change','#FilterBy',function(){
    searchProducts();
  });

</script>
@section('content')
<section class="section-content bg padding-y-sm">
    <div class="container">
    <div class="card">
        <div class="card-body">
    <div class="row">
        <div class="col-md-3-24"> <strong>Ești aici:</strong> </div> <!-- col.// -->
        <nav class="col-md-18-24">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('acasa')}}">Acasa</a></li>
            <li class="breadcrumb-item" style="text-transform: capitalize;"><a href="{{route('categories',['categorie'=>$category->descriere])}}">{{$category->descriere}}</a></li> 
        </ol>
        </nav> <!-- col.// -->
    </div> <!-- row.// -->
    <hr>
   <!-- start form -->

    <input type="hidden" id="categorie" name="categorie" value="{{$category->descriere}}">
    <div class="row">
        <div class="col-md-3-24" > <strong>Filtru după:</strong> </div> <!-- col.// -->
        <div class="col-md-21-24">
            <ul class="list-inline">
              <li>
                <div class="form-inline">
                    <label class="mr-2">Preț</label>
                    <input class="form-control form-control-sm" id="priceMin" name="priceMin" min="1" max="{{$maxPrice}}"placeholder="Min" type="number" style="max-width:80px; margin-left:50px;" >
                        <span class="px-2"> - </span>
                    <input class="form-control form-control-sm" id="priceMax" name="priceMax" min="1" max="{{$maxPrice}}" placeholder="Max" type="number" style="max-width:80px">           
                </div>
              </li>
              <li>
                <div class="form-inline py-2">
                  <label class="mr-2">Compoziție</label>
                    <input class="form-control form-control-sm" id="compozit" name="compozit" placeholder="Compoziție" type="text" style="width:180px" >  
                </div>          
              </li>
              <li> 
                <div class="form-inline">
                  <label class="mr-2">Produse</label>
                    <select class="form-control form-control-sm" name="FilterBy"  style="width:180px; margin-left:22px;">
                        <option value="Top vânzări"> Top vânzări</option>
                        <option value="Top recenzii"> Top recenzii</option>
                        <option value="Noi apărute"> Noi apărute</option>
                        <option value="Cele mai ieftine"> Cele mai ieftine</option>
                        <option value="Cele mai scumpe"> Cele mai scumpe</option>        
                    </select> 
                    <!-- <span class="px-2"> 
                      <button type="submit" class="btn btn-sm ml-2">Ok</button> 
                    </span> -->
                </div> <!-- dropdown-menu.// -->
              </li>
            </ul>
        </div> <!-- col.// -->
    </div> <!-- row.// -->

    <!-- end form -->
        </div> <!-- card-body .// -->
    </div> <!-- card.// -->
        <div class="alert-success ">
            <div class="alert alert-success alert-block padding-y-sm" id="total">
            @if($total == 1 )
            <strong> 1 rezultat pentru "{{$category->descriere}}"</strong>
            @else
            <strong>{{$total}} rezultate pentru "{{$category->descriere}}"</strong>
            @endif       
            </div>
        </div>
    <div class="row-sm" id="content">
        @foreach($products as $product)
        <div class="col-md-3 col-sm-6">
            <a href="{{route('categorii.detalii',['categorii'=>$product->categories->descriere,'detalii'=>$product->nume] )}}" class="title">
                <figure class="card card-product">
                    @if ($loop->iteration==1 or $loop->iteration==2 or $loop->iteration==3)
                                <span class="badge-new"> NEW </span>				
                    @endif
                    <div class="img-wrap"> <img src="{{asset('storage/'.$product->img)}}"></div>
                    <figcaption class="info-wrap">
                        {{$product->nume}}
                        <div class="price-wrap">
                            <span class="price-new">{{$product->priceFormat()}}</span> 
                        </div> <!-- price-wrap.// -->
                    </figcaption>
                </figure> 
            </a><!-- card // -->
        </div> <!-- col // -->
        @endforeach 
    </div> <!-- row.// -->
    <div>
        {{$products->links()}}
    </div>
    <!-- ============== PROMO slide items  ============= -->
    <section class="section-content bg padding-y border-top">
    <div class="container">
        <h3> Produse BestSeller</h3>
      <div class="row">
      <div class="owl-carousel owl-init slide-items" data-items="5" data-margin="20" data-dots="true" data-nav="true">
          @foreach($best as $item)
            <a href="{{route('categorii.detalii',['categorii'=>$item->categories->descriere,'detalii'=>$item->nume] )}}">
              <div class="item-slide">
                <figure class="card card-product">                
                    <!-- <span class="badge-new"> PROMO </span>				                  -->
                  <div class="img-wrap"> <img src="{{asset('storage/'.$item->img)}}"></div>
                    <figcaption class="info-wrap text-center">
                      <h6 class="title text-truncate"> {{$item->nume}}</h6>
                      <small class="text-secondary">{{$item->priceFormat()}} </small>
                    </figcaption>
                </figure><!-- card // -->
              </div>
            </a>
          @endforeach	
        </div>
      </div>
    </div>
  </section>
  
      <!-- ============== PROMO slide items .end // ============= -->
    </div><!-- container // -->
    </section>
    <!-- ========================= SECTION CONTENT .END// ========================= -->

<!-- ========================= FOOTER ========================= -->
@endsection
