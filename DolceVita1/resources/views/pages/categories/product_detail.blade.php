@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y-sm">
    <div class="container">
	<div>
	@if($message=Session::get('success_message'))
        <div class="alert-success">
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{$message}}</strong>
            </div>
        </div>
        @endif  
	</div>
    <nav class="mb-3">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('acasa')}}">Acasa</a></li>
			<li class="breadcrumb-item" style="text-transform: capitalize;"><a href="{{route('categories',['categorie'=>$category->descriere])}}">{{$category->descriere}}</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{$data->nume}}</li>
		</ol> 
    </nav>
    <div class="row">
		<!--aici schimn la 1-->
    <div class="col-xl-12 col-md-12 col-sm-12">
    <main class="card">
        <div class="row no-gutters">
            <aside class="col-sm-6 border-right">
                <article class="gallery-wrap"> 
                    <div class="img-wrap">
                        <div><a href="{{asset('storage/'.$data->img)}}" data-fancybox=""><img src="{{asset('storage/'.$data->img)}}" class="img-fuid"></a></div>
                    </div> <!-- slider-product.// -->
                    <div class="img-small-wrap">
			            <div class="item-gallery"><a href="{{asset('storage/'.$data->img_nutrition)}}" data-fancybox=""><img src="{{asset('storage/'.$data->img_nutrition)}}"></a></div>
			        </div> <!-- slider-nav.// -->
                </article> <!-- gallery-wrap .end// -->
            </aside>
            <aside class="col-sm-6">
            <article class="card-body">
            <!-- short-info-wrap -->
            <h3 class="title mb-3">{{$data->nume}}</h3>
			<div class="mb-3"> 
				<var class="price h3 text"> 
				@if($data->promo == 1 )
					<span class="currency">{{returnPricePromo($data->pret)}}</span><small class="text-secondary"><del> {{$data->priceFormat()}} </del> </small>
					<span class="text-warning"> La comandă</span>
					
				@else
					<span class="currency">{{$data->priceFormat()}}</span><span class="text-warning"> La comandă</span>
				@endif
				</var> 
			</div> <!-- price-detail-wrap .// -->
			<dl>
			  <dt>Descriere</dt>
			  <dd><p>{{$data->descriere}}</p></dd>
			</dl>
			<dl class="row">
			  <dt class="col-sm-3">Livrare</dt>
			  <dd class="col-sm-9">România</dd>
			</dl>
			<div class="rating-wrap">
			<ul class="rating-stars">
				<li style="width:80%" class="stars-active"> 
					<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
					<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
					<i class="fa fa-star"></i> 
				</li>
				<li>
					<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
					<i class="fa fa-star"></i> <i class="fa fa-star"></i> 
					<i class="fa fa-star"></i> 
				</li>
			</ul>
			<div class="label-rating">132 aprecieri</div>
			<div class="label-rating">154 comenzi </div>
		</div> <!-- rating-wrap.// -->
		<hr>
		<form  style="display: inline;" action="{{route('cos.store')}}" method="POST">	
		<div class="row">	
		@csrf	
		<input type="hidden" name="prod_id" value="{{$data->id}}">
			<div class="col-sm-5">
				<dl class="dlist-inline">
				@if($category->descriere =='macarons' or $category->descriere =='biscuiți')
				<dt>Cutii: </dt>
				@else
				  <dt>Bucăți: </dt>
				@endif
				@if($category->descriere =='auxiliar')
				  <dd> 
					  <select  name="quantity" class="form-control form-control-sm" style="width:70px;">
					 	@if($stock == 0)
						 <option> 0</option>	
						@elseif($stock >= 10)
							@foreach(range(1,10) as $y)
								<option> {{$y}} </option>	 
							@endforeach
							@else
							@foreach(range(1,$stock) as $y)
								<option> {{$y}} </option>	 
							@endforeach
						@endif										  
					  </select>
				  </dd>			
				</dl>  <!-- item-property .// -->
			</div> <!-- col.// -->
			@else
				<dd> 
					<select  name="quantity" class="form-control form-control-sm" style="width:70px;">
						<option> 1 </option>
						<option> 2 </option>
						<option> 3 </option>
						<option> 4 </option>
						<option> 5 </option>
						<option> 6 </option>
						<option> 7 </option>
						<option> 8 </option>
						<option> 9 </option>
						<option> 10 </option>
					</select>
				  </dd>			
				</dl>  <!-- item-property .// -->
			</div> <!-- col.// -->
			@endif	
			@if($category->descriere =='torturi')	
			 <div class="col-sm-7">					
					<dl class="dlist-inline">
						<dt>Gramaj: </dt>	
						<dd> 														
						<select name="gramaj" class="form-control form-control-sm" style="width:70px;">
							<option> 1 </option>
							<option> 2 </option>
							<option> 3 </option>
							<option> 4 </option>
							<option> 5 </option>
							<option> 6 </option>							
						</select> 
						</dd>					
						<p style="display:inline;">kg</p>															
					</dl>  <!-- item-property .// -->				
			</div> <!-- col.// -->
			@elseif($category->descriere =='macarons' or $category->descriere =='biscuiți')
			<div class="col-sm-7">					
					<dl class="dlist-inline">
						<dt>Gramaj: </dt>	
						<dd> 														
						<select name="gramaj" class="form-control form-control-sm" style="width:70px;">
							<option> 1 </option>
							<option> 2 </option>
							<option> 3 </option>
							<option> 4 </option>
							<option> 5 </option>
							<option> 6 </option>							
						</select> 
						</dd>					
						<p style="display:inline;">kg</p>															
					</dl>  <!-- item-property .// -->				
			</div> <!-- col.// -->
			@elseif($category->descriere =='ciocolată' or $category->descriere =='desert' or $category->descriere =='croissant' )
			<div class="col-sm-7">					
					<dl class="dlist-inline">
						<dt>Gramaj: </dt>	
						<dd> 														
						<select name="gramaj" class="form-control form-control-sm" style="width:70px;">
							<option> 0.2 </option>							
						</select> 
						</dd>					
						<p style="display:inline;">kg</p>															
					</dl>  <!-- item-property .// -->				
			</div> <!-- col.// -->		
			@endif
		</div> <!-- row.// -->
		<hr>
		@if($stock == 0)		
			<button data-original-title="Salvează în coșul de cumpărături" type="submit" title="" class="btn btn-outline-primary" onClick="this.form.submit(); this.disabled=true;" data-toggle="tooltip" disabled> <i class="fa fa-shopping-cart"></i></button>	
			@else
			<button data-original-title="Salvează în coșul de cumpărături" type="submit" onClick="this.form.submit(); this.disabled=true;" class="btn btn-outline-primary" data-toggle="tooltip"> <i class="fa fa-shopping-cart"></i></button>	
		@endif
		</form>
		<form style="display:inline;" class="form-prevent" action="{{route('adauga.favorite',['produs'=>$data->id])}}" method="POST">
                @csrf	
		<button data-original-title="Salvează la favorite" type="submit" onClick="this.form.submit(); this.disabled=true; " title="" class="btn btn-outline-primary" data-toggle="tooltip" > <i class="fa fa-heart"></i></button>
		</form>
		<a href="{{route('pages','contacte')}}" class="btn  btn-outline-primary"> <i class="fa fa-envelope"></i> Contactează-ne </a>
	<!-- short-info-wrap .// -->
    </article> <!-- card-body.// -->
    </aside> <!-- col.// -->
    </div> <!-- row.// -->
    </main> <!-- card.// -->
    <br>
	
<!-- PRODUCT DETAIL .// -->
<div class="card">
			<div class="card-header">
					<header class="card-header">
						@if($comments->count() == 1)
						<h4 class="card-title mt-3">{{$comments->count()}}&nbsp;Comentariu</h4>
						@else
						<h4 class="card-title mt-3">{{$comments->count()}}&nbsp;Comentarii</h4>
						@endif
					</header>         
			</div> 
		<!-- coments section  -->
		@comments(['model' => $data])
</div>

</div> <!-- col // -->
</div> <!-- row.// -->
</div><!-- container // -->
</section>


<!-- ========================= SECTION CONTENT .END// ========================= -->

<!-- ========================= FOOTER ========================= -->
@endsection