@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y border-top">
<div class="container col-xl-10 col-sm-12 col-md-10">
    <section class="my-5">
      <!-- Section heading -->
      <h1 class="h1-responsive font-weight-bold text-center my-5">Contacteaz&#259;-ne</h1>
      <!-- Section description -->
      <p class="text-center w-responsive mx-auto pb-5">Suntem la dispozi&#355;ia dvs. Pentru servicii calitative nu ezita&#355;i s&#259; ne suna&#355;i
			s&#259; afla&#355;i mai multe despre comand&#259; sau alte necesit&#259;&#355;i.</p>
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
      <!-- Grid row -->
      <div class="row">
        <!-- Grid column -->
        <div class="col-lg-6 mb-lg-0 mb-4">
          <!-- Form with header -->
          <div class="card">
            <div class="card-body">
              <!-- Header -->
              <div class="form-header blue accent-1">
                <h3 class="mt-2 text-dark"><i class="fas fa-envelope text-dark"></i> Scrie-ne:</h3>
              </div>
              <p class="text-dark">Suntem bucuro&#351;i s&#259; v&#259; r&#259;spundem.</p>
              <!-- Body -->
              <form method="POST" action="{{ route('trimite.mesaj')}}">
                {{csrf_field()}}
              <div class="md-form input-group flex-nowrap mb-3 shadow-sm">
                <div class="input-group-prepend">
                    <i class="fas fa-user prefix text-dark"></i>
                </div>
                <input type="text" id="form-name" name="name" class="form-control text-dark" placeholder="Nume Prenume" required>
              </div>
              <div class="md-form input-group flex-nowrap mb-3 shadow-sm">
                <div class="input-group-prepend">
                    <i class="fas fa-envelope prefix text-dark"></i>
                </div>
                <input type="text" id="form-email" name="email" class="form-control text-dark" placeholder="Email" required>
              </div>
              <div class="md-form input-group flex-nowrap mb-3 shadow-sm">
                <div class="input-group-prepend">
                    <i class="fas fa-tag prefix text-dark"></i>
                </div>
                <input type="text" id="form-Subject" name="sbj" class="form-control text-dark" placeholder="Subiect" required>
              </div>
              <div class="md-form input-group flex-nowrap mb-3 shadow-sm">
                <div class="input-group-prepend">
                    <i class="fas fa-pencil-alt prefix text-dark"></i>
                </div>
                <textarea id="form-text" name="message" class="form-control md-textarea text-dark" rows="3" placeholder="Mesaj" required></textarea>
              </div>
              <div class="text-center">
                <button type="submit" name="send" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; " value=" ">Trimite</button>
              </div>
              </form>
            </div>
          </div><!-- Form with header -->
        </div><!-- Grid column -->     
        <div class="col-lg-6"><!--Google map-->
          <div id="map-container-section" class="z-depth-1-half map-container-section mb-4" style="height: 400px">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2776.217301564594!2d28.189299114901804!3d45.9069650791087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b65ceafb773d17%3A0x3ad6070f2bd52999!2sDulcinella!5e0!3m2!1sro!2sro!4v1596729541247!5m2!1sro!2sro" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
          <!-- Buttons-->
          <div class="row text-center">
            <div class="col-md-4 ic">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-map-marker-alt shadow text-dark"></i>
              </a>
              <p class="text-dark">Bucure&#351;ti, 8003655</p>
              <p class="mb-md-0 text-dark">Rom&#226;nia</p>
            </div>
            <div class="col-md-4 ic">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-phone shadow text-dark"></i>
              </a>
              <p class="text-dark">+ 40 075887324</p>
              <p class="mb-md-0 text-dark">Lu - Du, 8:00-22:00</p>
            </div>
            <div class="col-md-4 ic">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-envelope shadow text-dark"></i>
              </a>
              <p class="text-dark">infoDolceVita@gmail.com</p>
              <p class="mb-0 text-dark">saleDolceVita@gmail.com</p>
            </div>
          </div>
        </div><!-- Grid column -->
      </div><!-- Grid row -->
    </section><!-- Section: Contact v.1 -->
	</div>
</section>

    <!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
