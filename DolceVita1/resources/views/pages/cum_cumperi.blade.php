@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y border-top">
    <div class="container">
				<h1 class="h1-responsive font-weight-bold text-center my-5">Cum faci o comandă?</h1>
        <div class="row">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
											<div class="container display d-flex padding-y col-xl-6 col-sm-12">
                        <div style="padding-top:20px;">
                            <p> <strong>1. Adaugi produsul în coș</strong>
														</p>
														<p>Produsul preferat ajunge în coș doar printr-un click pe buton
														</p>

                        </div>
												<div style="">
													<img style="margin-left: 10px; padding-right: 10px; height: auto; width: 100%;" src="{{asset('front_assets/images/icons/cart.png')}}">
												</div>
										</div>
                </div> <!-- card.// -->

             </main> <!-- col.// -->
        </div>

				<div class="row padding-top 10px">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
									<div class="container display d-flex padding-y col-xl-6 col-sm-12">
			                <div>
												<img style="padding-right: 10px; height: auto; width: 100%;
												"src="{{asset('front_assets/images/icons/sent.png')}}">
											</div>
											<div class="content">

												<p> <strong> 2. Plasează comanda</strong>	</p>
												<p>	În momentul completării formularului de facturare ai posibilitatea să alegi metoda de livrare și achitare — este foarte ușor</p>
											</div>
									</div>
                </div> <!-- card.// -->
             </main> <!-- col.// -->
        </div>

        <div class="row padding-top 10px">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
									<div class="container display d-flex padding-y col-xl-6 col-sm-12">
											<div class="content">
												<p><strong> 3. Revenim cu un mesaj</strong></p>
												<p>Timp de 5 minute pentru confirmarea coșului și datelor personale.</p>
											</div>
											<div>
												<img style="padding-left: 15px; height: auto; width: 100%;
												"src="{{asset('front_assets/images/icons/mess.png')}}">
											</div>
									</div>
                </div> <!-- card.// -->
             </main> <!-- col.// -->
        </div>

				<div class="row padding-top 10px">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
									<div class="container display d-flex padding-y col-xl-6 col-sm-12">
			                <div>
												<img style="padding-right: 10px; height: auto; width: 100%;
												"src="{{asset('front_assets/images/icons/del1.png')}}">
											</div>
											<div class="content">

												<p> <strong> 4. Livrăm la adresa indicată</strong>	</p>
												<p>	Comanda poate să ajungă și mai repede după confirmarea datelor</p>
											</div>
									</div>
                </div> <!-- card.// -->
             </main> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
 </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
