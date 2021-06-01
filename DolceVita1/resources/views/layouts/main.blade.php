<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>
<title>DolceVita</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('front_assets/images/icons/icon1')}}">

<!-- jQuery -->
<script src="{{asset('front_assets/js/jquery-2.0.0.min.js')}}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{ asset('front_assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<link href="{{asset('front_assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="{{asset('front_assets/fonts/fontawesome/css/fontawesome-all.min.css')}}" type="text/css" rel="stylesheet">

<!-- plugin: fancybox  -->
<script src="{{asset('front_assets/plugins/fancybox/fancybox.min.js')}}" type="text/javascript"></script>
<link href="{{asset('front_assetsplugins/fancybox/fancybox.min.css')}}" type="text/css" rel="stylesheet">

<!-- plugin: owl carousel  -->
<link href="{{asset('front_assets/plugins/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
<link href="{{asset('front_assets/plugins/owlcarousel/assets/owl.theme.default.css')}}" rel="stylesheet">
<script src="{{asset('front_assets/plugins/owlcarousel/owl.carousel.min.js')}}"></script>



<!-- plugin: slickslider -->
<link href="{{asset('front_assets/plugins/slickslider/slick.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('front_assets/plugins/slickslider/slick-theme.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('front_assets/plugins/slickslider/slick.min.js')}}"></script>

<!-- custom style -->
<link href="{{asset('front_assets./css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front_assets/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />

<!-- custom javascript -->
<script src="{{asset('front_assets/js/script.js')}}" type="text/javascript"></script>

<!-- our styles -->
<link href="{{asset('front_assets/css/styles.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('front_assets/css/checkout.css')}}" rel="stylesheet" type="text/css" />


<script type="text/javascript">
    /// some script

    // jquery ready start
    $(document).ready(function() {
	// jQuery code
}); 
// jquery end
</script>

</head>
    <body>
        <header class="section-header">
          <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
              <div class="container">
                  <div class="row" style="width:100%;">
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarNav">
                              <ul class="navbar-nav d-flex justify-content-left align-items-center py-1">
                                  <li class="{{'/'== request()->path() ? 'active':''}}">
                                      <a class="nav-link" href="{{route('acasa')}}">Acas&#259; <span class="sr-only"></span></a>
                                  </li>
                                  <li class="{{'despre'== request()->path() ? 'active':''}}">
                                    <a class="nav-link" href="{{route('pages','despre')}}"> Despre noi </a>
                                  </li>
                                  <li class="{{'contacte'== request()->path() ? 'active':''}}">
                                    <a class="nav-link" href="{{route('pages','contacte')}}"> Contacte </a>
                                  </li>

                                  <li class="nav-item dropdown {{(request()->segment(1)=='categorii') ? 'active':''}}">
                                      <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  Categorii </a>

                                      <ul class="dropdown-menu">
                                      @foreach($categories as $category)
                                          <li  style="text-transform: capitalize;"><a class="dropdown-item" href="{{route('categories',['categorie'=>$category->descriere])}}"> {{$category->descriere}}</a></li>                 
                                          @endforeach
                                         
                                          <li><a class="dropdown-item" href="{{route('recipe')}}"> Rețetă personalizată</a></li>                  
                                      </ul>
                                      <li class="{{'tutoriale'== request()->path() ? 'active':''}}">
                                    <a class="nav-link" href="{{route('tutoriale')}}"> Tutoriale </a>
                                  </li>
                                  </li>
                              </ul>
                          </div>

                      </div>


                      <!--aici inseram blocul cu iconite-->
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                          <div class="widgets-wrap no-gutters py-1 d-flex justify-content-right align-items-center">
                              <div class="col-auto">
                                  <div class="widget-header dropdown">
                                      <a href="{{ route('login') }}" data-toggle="dropdown" data-offset="20,10">
                                          <div class="icontext">
                                              <div class="icon-wrap"><i class="text-light icon-sm fa fa-user"></i>
                                              </div>
                                                <div class="text-wrap text-light">
                                              @if (Auth::check())

                                                    {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                                              @else
                                                    Logare <i class="fa fa-caret-down"></i>
                                                @endif
                                              </div>
                                          </div>
                                      </a>

                                      <div class="dropdown-menu">
                                        <form method="POST" action="{{ route('login') }}" class="px-4 py-3">
                                        @csrf
                                              <div class="form-group">
                                                  <label>Adresa de email</label>
                                                <input id="email" type="email" placeholder="email@example.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                              </div>
                                              <div class="form-group">
                                                  <label>Parola</label>
                                                  <input id="password" type="password" placeholder="Parola" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                  @error('password')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                  @enderror
                                              </div>
                                              <div class="form-group">
                                                          <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                          <label class="" for="remember">
                                                              {{ __('Memoreaza-mă') }}
                                                          </label>
                                              </div>
                                                <button type="submit" onClick="this.form.submit(); this.disabled=true; " class="btn btn-primary">Logare</button>
                                              </form>
                                              <a class="dropdown-item" href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                               document.getElementById('logout-form').submit();">
                                                  {{ __('Logout') }}
                                              </a>
                                              <hr class="dropdown-divider">
                                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                  @csrf
                                              </form>
                                                @if (Route::has('register'))
                                                <a class="dropdown-item" href="{{route('register')}}">Ai un cont? Înregistrează-te</a>
                                                  @endif

                                                  @if (Route::has('password.request'))
                                                    <a class="dropdown-item" href="{{ route('password.request') }}">Ai uitat parola?</a>
                                                  @endif
                                      </div> <!--  dropdown-menu .// -->
                                  </div>  <!-- widget-header .// -->
                              </div> <!-- col.// -->
                              <div class="col-auto">
                                  <a href="{{route('cos.index')}}" class="widget-header">
                                      <div class="icontext">
                                          <div class="icon-wrap"><i class="text-light icon-sm fa fa-shopping-cart"></i></div>
                                          <div class="text-wrap text-light">Coș </div>                   
                                          @if(Auth::check())
                                            @if(DB::table('cart')->where('user_id',auth()->id())->count() or DB::table('personal_order')->where(['user_id'=> auth()->id(),'ordered'=>0])->count())
                                            <span class="badge badge-pill badge-secondary"> {{DB::table('cart')->where('user_id',auth()->id())->count()+DB::table('personal_order')->where(['user_id'=> auth()->id(),'ordered'=>0])->count()}}</span>    
                                            @endif
                                        @endif                   
                                   </div>
                                  </a>
                              </div> <!-- col.// -->
                              <div class="col-auto">
                                  <a href="{{route('favorite')}}" class="widget-header">
                                      <div class="icontext">
                                          <div class="icon-wrap"><i class="text-light icon-sm  fa fa-heart"></i></div>
                                          <div class="text-wrap text-light">Favorite</div>
                                        @if(Auth::check())
                                          @if(DB::table('product_user')->where('user_id',auth()->id())->count() > 0)
                                            <span class="badge badge-pill badge-secondary"> {{DB::table('product_user')->where('user_id',auth()->id())->count()}}</span>    
                                            @endif
                                        @endif
                                      </div>
                                  </a>
                              </div> <!-- col.// -->
                              <!-- contacts -->
                                <div class="col-lg-4 col-sm-12">
                                    <a href="tel:+40 075887324" class="widget-header float-md-right">
                                        <div class="icontext text-light">
                                            <div class="icon-wrap"><i class="flip-h fa-lg fa fa-phone"></i></div>
                                            <div class="text-wrap text-light">
                                                <small>Telefon</small>
                                                <div>(+40) 75887324</div>
                                            </div>
                                        </div>
                                    </a>
                                </div> <!-- col.// -->
                    <!-- end-contacts -->
                          </div> <!-- widgets-wrap.// row.// -->
                      </div> <!-- col.// -->
                  </div>
              </div>
          </nav>
          <section class="header-main">
              <div class="container">
                  <div class="row align-items-center">
                      <div class="col-md-4">
                          <div class="brand-wrap">
                            	<img  src="{{asset('front_assets/images/icons/logo.jpg')}}" style=" border-radius: 50%; height: 70px;">
                              <h2 class="logo-text font-weight-bold text-secondary">DolceVita</h2>
                          </div> <!-- brand-wrap.// -->
                      </div>
                      <div class="col-md-4">

                      </div> <!-- col.// -->
                      <div class="col-md-4">
                          <form action="{{ route('search') }}" method="GET" class="widget-header float-right">
                              <div class="input-group">
                                  <input id="inp" type="text" name="query" value="{{ request()->input('query') }}" class="form-control" placeholder="Search">
                                  <div class="input-group-append">
                                      <button class="btn btn-primary" type="submit">
                                          <i class="fa fa-search"></i>
                                      </button>
                                  </div>
                              </div>
                          </form> <!-- search-wrap .end// -->
                      </div> <!-- col.// -->               
                  </div> <!-- row.// -->
              </div> <!-- container.// -->
          </section> <!-- header-main .// -->
        </header> <!-- section-header.// -->

<!-- ========================= SECTION CONTENT  ========================= -->
@yield('content')
<!-- ========================= SECTION CONTENT END// ========================= -->

<!-- ========================= FOOTER ========================= -->
<footer class="section-footer bg-primary">
    <div class="container">
        <section class="footer-top padding-top">
            <div class="row">
                <aside class=" col-xl-3 col-lg-3col-sm-12 col-sm-6 white">
                    <h5 class="title">Serviciu Clien&#539;i</h5>
                    <ul class="list-unstyled">
                        <li> <a href="#">Centru de ajutor</a></li>
                        <li> <a href="{{route('pages','politica_rambursari')}}">Returnarea Banilor</a></li>
                        <li> <a href="{{route('pages','termeni_conditii')}}">Termeni &#351;i Politica</a></li>
                        <li> <a href="{{route('pages','contestatii')}}">Deschide o contesta&#539;ie</a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3  col-md-3 white">
                    <h5 class="title">Contul meu</h5>
                    <ul class="list-unstyled">
                        <li> <a href="{{route('login')}}"> Logare client </a></li>
                        <li> <a href="{{route('register')}}"> &#206;nregistrare </a></li>            
                        <li> <a href="{{route('cos.index')}}"> Coșul de cumpărături</a></li>
                        <li> <a href="{{route('favorite')}}"> Lista de dorin&#539;e </a></li>
                        <li> <a href="{{route('history')}}"> Istoric comandă </a></li>   
                        @if(auth()->id() ==1)
                            <li> <a href="{{route('add.recipe')}}"> Secțiunea rețete </a></li> 
                            <li> <a href="{{route('show.price')}}"> Formarea prețului </a></li>  
                            <li> <a href="{{route('admin.tombola')}}"> Istoric tombole </a></li>   
                        @endif
                    </ul>
                </aside>
                <aside class="col-sm-3  col-md-3 white">
                    <h5 class="title">Despre</h5>
                    <ul class="list-unstyled">
                        <li> <a href="#"> Istoricul nostru</a></li>
                        <li> <a href="{{route('pages','cum_cumperi')}}"> Cum s&#259; faci o comand&#259;</a></li>
                        <li> <a href="{{route('pages','plati&livrare')}}"> Livrare &#537;i achitare </a></li>
                        <li> <a href="#"> Anun&#539;uri </a></li>
                        <li> <a href="#"> Interese comune </a></li>
                    </ul>
                </aside>
                <aside class="col-sm-3">
                    <article class="white">
                        <h5 class="title">Contacte</h5>
                        <p>
                            <strong>Telefon: </strong> +123456789 <br>
                            <strong>Fax:</strong> +123456789
                        </p>

                        <div class="btn-group white">
                            <a class="btn btn-facebook" title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f  fa-fw"></i></a>
                            <a class="btn btn-instagram" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram  fa-fw"></i></a>
                            <a class="btn btn-youtube" title="Youtube" target="_blank" href="#"><i class="fab fa-youtube  fa-fw"></i></a>
                            <a class="btn btn-twitter" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter  fa-fw"></i></a>
                        </div>
                    </article>
                </aside>
            </div> <!-- row.// -->
            <br>
        </section>
        <section class="footer-bottom row border-top-white">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <p class="text-md-right text-white-50">
                    Copyright &copy  <br>
                    <a href="http://bootstrap-ecommerce.com" class="text-white-50">DolceVita societate comercial&#259;</a>
                </p>
            </div>
        </section> <!-- //footer-top -->
    </div><!-- //container -->
</footer>
<!-- ========================= FOOTER END // ========================= -->

    </body>
</html>
