@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y">
    <div class="d-flex justify-content-center ">
        <div class=" col-xl-3 col-lg-4 col-md-5 col-sm-4">
            <div class="card">
                <header class="card-header">     
                    <h4 class="card-title mt-4 text-center">Mulțumim pentru comandă!</h4>
                </header>
                <div class="content">
                    <p class="text-center">Factura cu detalii a fost trimisă pe adresa dvs. de mail!</p>
                    <p class="text-center">Vă așteptăm cu drag pentru alte achiziții!</p> 
                    <p><a href="{{route('acasa')}}" class="btn  btn-outline-primary d-flex justify-content-center " style="padding-bottom: 15px;" > Acasa</a></p>                                                               
                </div>
            </div>   
        </div>
    </div>
</section>
@endsection