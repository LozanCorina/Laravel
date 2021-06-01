@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y">
<div class="d-flex justify-content-center ">
  <div class="card col-xl-3 col-lg-4 col-md-5 col-sm-8">
	   <article class="card-body">
	      <a href="{{route('register')}}" class="float-right btn btn-outline-primary">Inregistrează-te</a>
	         <h4 class="card-title mb-4 mt-1">Logare</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                    			<label>{{ __('E-Mail') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="email@example.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Parola') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Parola">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Memoreaza-mă') }}
                                    </label>
                        </div>

                        <div class="form-group row mb-0">
                                <button type="submit" onClick="this.form.submit(); this.disabled=true;" class="btn btn-primary">
                                    {{ __('Logare') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Ai uitat parola?') }}
                                    </a>
                                @endif
                        </div>
                    </form>
                  </article>
                	</div> <!-- card.// -->
                </div>
							</section>
  <!-- ========================= SECTION END CONTENT ========================= -              <br>
@endsection
