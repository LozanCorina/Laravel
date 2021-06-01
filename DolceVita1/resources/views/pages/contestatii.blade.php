@extends('layouts.main')
@section('content')
<!-- ========================= SECTION REQUEST ========================= -->
<section class="section-request bg padding-y-sm">
<div class="container">
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
<header class="section-heading heading-line">
	<h4 class="title-section bg text-uppercase">Deschide o contestație</h4>
</header>

<div class="row">
	<div class="col-md-8">
<figure class="card-banner banner-size-lg">
	<figcaption class="overlay left">
		<br>
		<h2 style="max-width: 300px;">Vă rugăm să citiți termenii și politica noastră înainte de a trimite o contestație </h2>
		<br>
		<a class="btn btn-warning" href="{{route('pages','termeni_conditii')}}">Mai multe informații » </a>
	</figcaption>
	<img src="{{asset('front_assets/images/banners/cont.jpg')}}" style="width: 960px;">
</figure>
	</div> <!-- col // -->
	<div class="col-md-4">

<div class="card card-body">
	<h4 class="title">Nu sunteți mulțumiți de un serviciu?</h4>
	<form method="POST" action="{{route('trimite.contest')}}">
		@csrf  
		<div class="form-group">
			<input class="form-control" name="name" type="text" placeholder="Nume Prenume" required>
		</div>
		<div class="form-group">
			<input class="form-control" name="email" type="email" placeholder="Adresa de email" required>
		</div>
		<div class="form-group">
			<input class="form-control" name="phone" type="phone" placeholder="Nr. de contact" required>
		</div>
		<div class="form-group">			
			<input class="form-control" name="subject" type="text" placeholder="Subiect" required>
		</div>	
		<div class="form-group">
			<textarea id="form-text" name="message" class="form-control md-textarea text-dark" rows="3" placeholder="Mesaj"></textarea required>			
		</div>		
		<div class="form-group">
			<button type="submit" onClick="this.form.submit(); this.disabled=true;" class="btn btn-warning">Trimite contestația</button>
		</div>
	</form>
</div>

	</div> <!-- col // -->
</div><!-- row // -->

</div><!-- container // -->
</section>
<!-- ========================= SECTION REQUEST .END// ========================= -->
@endsection