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
                          <a class="nav-link" href="{{route('despre')}}"> Despre noi </a>
                        </li>
                        <li class="{{'contacte'== request()->path() ? 'active':''}}">
                          <a class="nav-link" href="{{route('contacte')}}"> Contacte </a>
                        </li>

                        <li class="nav-item dropdown {{(request()->segment(1)=='categorii') ? 'active':''}}">
                            <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  Categorii </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route ('page','torturi')}}"> Torturi</a></li>
                                <li><a class="dropdown-item" href="{{route ('page','ciocolata')}}"> Ciocolat&#259; </a></li>
                                <li><a class="dropdown-item" href="{{route ('page','desert')}}"> Desert </a></li>
                                <li><a class="dropdown-item" href="{{route ('page','macarons')}}"> Macarons </a></li>
                                <li><a class="dropdown-item" href="{{route ('page','croisant')}}"> Croisant </a></li>
                                <li><a class="dropdown-item" href="{{route ('page','biscuiti')}}"> Biscui&#539;i </a></li>
                                <li><a class="dropdown-item" href="{{route ('page','auxiliar')}}"> Auxiliar </a></li>
                            </ul>
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
                                      <button type="submit" class="btn btn-primary">Logare</button>
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
                                      <a class="dropdown-item" href="{{route('inregistrare')}}">Ai un cont? Înregistrează-te</a>
                                        @endif

                                        @if (Route::has('password.request'))
                                          <a class="dropdown-item" href="{{ route('password.request') }}">Ai uitat parola?</a>
                                        @endif
                            </div> <!--  dropdown-menu .// -->
                        </div>  <!-- widget-header .// -->
                    </div> <!-- col.// -->
                    <div class="col-auto">
                        <a href="{{route('cos')}}" class="widget-header">
                            <div class="icontext">
                                <div class="icon-wrap"><i class="text-light icon-sm fa fa-shopping-cart"></i></div>
                                <div class="text-wrap text-light">Coș </div>
                            </div>
                        </a>
                    </div> <!-- col.// -->
                    <div class="col-auto">
                        <a href="{{route('favorite')}}" class="widget-header">
                            <div class="icontext">
                                <div class="icon-wrap"><i class="text-light icon-sm  fa fa-heart"></i></div>
                                <div class="text-wrap text-light">Favorite</div>
                            </div>
                        </a>
                    </div> <!-- col.// -->
                    <div class="col-auto">
              				<a href="{{route('livrare')}}" class="widget-header">
              					<div class="icontext">
              						<img  style="height: 30px; width: 35px; " src="{{asset('front_assets/images/icons/del1.png')}}">
              						<div class="text-wrap text-light">Pla&#355;i&Livrare</div>
              					</div>
              				</a>
              			</div> <!-- col.// -->
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
                <form action="#" class="widget-header float-right">
                    <div class="input-group">
                        <input id="inp" type="text" class="form-control" placeholder="Search">
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
