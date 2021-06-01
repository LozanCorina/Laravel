@extends('layouts.main')
        <!-- ========================= SECTION INTRO ========================= -->
        @section('content')
<section id="intro" class="intro bg-secondary pt-5">
	<div class="container">
		<div class="row d-flex" style="min-height:600px;">
		<div class="col-sm-6 d-flex align-items-center">
			<header class="intro-wrap text-white">
				<h2 class="display-3"> Cu noi viața e mai dulce </h2>
			</header>  <!-- intro-wrap .// -->
		</div> <!-- col.// -->
		<div class="col-sm-6 text-right">
		</div> <!-- col.// -->
		</div> <!-- row.// -->
	</div> <!-- container .//  -->
	</section>
<!-- ========================= SECTION INTRO END// ========================= -->
<!-- ============== owl slide items  ============= -->
<section class="section-content bg padding-y border-top">
    <div class="container">
        <h3> Descoperă produsele noastre</h3>
      <div class="row">
      <div class="owl-carousel owl-init slide-items" data-items="5" data-margin="20" data-dots="true" data-nav="true">
          @foreach($results as $item)
            <a href="{{route('categorii.detalii',['categorii'=>$item->categories->descriere,'detalii'=>$item->nume] )}}">
              <div class="item-slide">
                <figure class="card card-product">
                <?php $date= now()->subDays(60) ?>
                  @if ($item->created_at > $date)
                    <span class="badge-new"> NEW </span>
                    @elseif($item->promo == 1)			
                    <span class="badge-new"> PROMO </span>
                  @endif
                  <div class="img-wrap"> <img src="{{asset('storage/'.$item->img)}}"></div>
                    <figcaption class="info-wrap text-center">
                      <h6 class="title text-truncate"> {{$item->nume}}</h6>
                      @if($item->promo == 1)
                      <small class="text-secondary"><del>{{$item->priceFormat()}}</del> {{returnPricePromo($item->pret)}} </small>
                      @else
                        <small class="text-secondary">{{$item->priceFormat()}} </small>
                      @endif
                    </figcaption>
                </figure><!-- card // -->
              </div>
            </a>
          @endforeach	
        </div>
      </div>
    </div>
  </section>
  
      <!-- ============== owl slide items .end // ============= -->
  <section class="section-content bg padding-y border-top">
      <div class="container">
        <div class="row">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <div class="container display d-flex padding-y">
                <div>
                  <header class="section-heading">
                    <h2 style="font-family: 'Forte' ">Ziua ta un pic mai Dulce</h2>
                  </header><!-- sect-heading -->
                    <p>În anul 2019, stabilim Motto-ul pentru strategia de dezvoltare a produsului –
                    DolceVita rEvoluționează. Acest motto are la bază diferențierea produsului, și anume tortul,
                    de tot ce este pe piață și elaborarea unor gusturi noi, specifice doar companiei DolceVita, la baza cărora stau
                    elementele avantajului nostru concurențial unic. Astfel, produsele marca DolceVita
                    au fost clasificate în 3 Serii:</p>
                    <p>
                      <ul>
                        <li>Seria Autor</li>
                        <li>Seria Fusion</li>
                        <li>Seria Raw&Veg</li>
                      </ul>
                    </p>
                    <p>Dorința de a fi într-un continuu proces de inovare și redescoperire a produselor noi, ce ar permite formarea unor
                    gusturi excepționale, pe care dorim sa le împărtășim tuturor;</p>
                    <p>
                    Materia primă de cea mai înaltă calitate, controlată riguros conform normativelor în domeniu: prelucrată,
                    modelată, ambalată și depozitată în spații de producție certificate de către instituțiile abilitate în domeniu;
                    </p>
                  </div>

                  <div style="float: right;" >
                    <img style="margin-left: 50px; height: auto; width: 100%;" src="{{asset('front_assets/images/avatars/bann.png')}}" alt="Tort">
                  </div>
            </div>
        </main> <!-- col.// -->
      </div>
    </div> <!-- container .//  -->
  </section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<br>
<div class="d-flex justify-content-center">
  <div class="col-md-3 mb15">
    <article class="box h-100">
    <figure class="itembox text-center">
      <span class="mt-2 icon-wrap rounded icon-sm bg-primary"><i class="fa fa-cogs white"></i></span>
        <figcaption class="text-wrap">
          <h5 class="title">Strategie &amp; soluție creativă</h5>
          <p class="text-muted">Rețete UNICE, elaborate EXCLUSIV de către compania DolceVita, fiind combinate gusturile rețetelor moderne, tradiționale și clasice, tehnici de cofetărie ale trecutului și prezentului. </p>
        </figcaption>
      </figure> <!-- iconbox // -->
      </article> <!-- panel-lg.// -->
      </div><!-- col // -->

        <div class="col-md-3 mb15">
          <article class="box h-100">
            <figure class="itembox text-center">
              <span class="mt-2 icon-wrap rounded icon-sm "><img src="{{asset('front_assets/images/icons/qua.png')}}">	</span>
              <figcaption class="text-wrap">
                <h5 class="title">Pre&#355; raport calitate</h5>
                <p class="text-muted">TESTĂM diverse ingrediente din diferite zone geografice ale lumii, în ideea obținerii mixului perfect/neobișnuit, ceea ce ne reprezintă.</p>
              </figcaption>
            </figure> <!-- iconbox // -->
          </article> <!-- panel-lg.// -->
        </div> <!-- col // -->

      <div class="col-md-3 mb15">
        <article class="box h-100">
          <figure class="itembox text-center">
              <span class="mt-2 icon-wrap rounded icon-sm bg-primary"><i class="fa fa-user white"></i>	</span>
            <figcaption class="text-wrap">
              <h5 class="title">Clien&#355;i mul&#355;umi&#355;i</h5>
              <p class="text-muted">Noi credem că oricine merită o viață un pic mai dulce. O viață, pe care ar să o savureze zi de zi, indiferent de statut, mijloace, stil de viață, preferințe și necesități. </p>
            </figcaption>
          </figure> <!-- iconbox // -->
        </article> <!-- panel-lg.// -->
    </div> <!-- col // -->
</div> <!-- row.// -->
<br>
<!-- ============== PROMO slide items  ============= -->
<section class="section-content bg padding-y border-top">
    <div class="container">
        <h3> Promoțiile săptămânei</h3>
      <div class="row">
      <div class="owl-carousel owl-init slide-items" data-items="5" data-margin="20" data-dots="true" data-nav="true">
          @foreach($promo as $item)
            <a href="{{route('categorii.detalii',['categorii'=>$item->categories->descriere,'detalii'=>$item->nume] )}}">
              <div class="item-slide">
                <figure class="card card-product">                
                    <span class="badge-new"> PROMO </span>				                 
                  <div class="img-wrap"> <img src="{{asset('storage/'.$item->img)}}"></div>
                    <figcaption class="info-wrap text-center">
                      <h6 class="title text-truncate"> {{$item->nume}}</h6>                 
                      <small class="text-secondary"><del>{{$item->priceFormat()}}</del> {{returnPricePromo($item->pret)}} </small>
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
<!-- ========================= SECTION PRE-CONTENT END// ========================= -->
@endsection
