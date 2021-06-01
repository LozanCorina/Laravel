@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y">
<div class="d-flex justify-content-center ">
<div class="container col-xl-6 col-sm-12">
    <div class="card">
    <header class="card-header">
        <a href="{{route('login')}}" class="float-right btn btn-outline-primary mt-1">Logare</a>
        <h4 class="card-title mt-2">Înregistrează-te</h4>
    </header>
    <article class="card-body">
    <form method="POST" action="{{ route('register') }}">
				@csrf
        <div class="form-row">
            <div class="col form-group">
                <label for="name">{{ __('Nume') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
										@error('name')
												<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
												</span>
										@enderror
					  </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->
        <div class="form-group">
            <label for="email">{{ __('Adresa de Email') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
						@error('email')
								<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
								</span>
						@enderror
						<small class="form-text text-muted">Nu vom divulga emailul dvs.</small>
		</div> <!-- form-group end.new// -->
        <div class="form-group input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
			  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Creaza parola">
				@error('password')
						<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
						</span>
				@enderror
		</div> <!-- form-group// -->
		<div class="form-group input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
		  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"  placeholder="Repeta parola">
		</div> <!-- form-group// -->
        <div class="form-group">
            <button type="submit" onClick="this.form.submit(); this.disabled=true;" class="btn btn-primary btn-block">Înregistrează-te   </button>
        </div> <!-- form-group// -->
        <small class="text-muted">Dupa ce apăsați "Înregistrează-te" sunteți de acord cu  <br> Termenii și politica noastră.</small>
    </form>
    </article> <!-- card-body end .// -->
    <div class="border-top card-body text-center">Ai un cont? <a href="{{route('login')}}">Loghează-te</a></div>
    </div> <!-- card.// -->
	</div> <!-- container-->
</div>
</section>
    <!-- ========================= SECTION  END// ========================= -->
@endsection
