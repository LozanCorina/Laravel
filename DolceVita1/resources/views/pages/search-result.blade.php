@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y border-top">
    <div class="container">
        <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif   
    </div>   
    @if($results->count())
    <div class="padding-y-sm">
        <span>{{$results->count()}} rezultat(e) pentru "{{ request()->input('query')}}"</span>
    </div>

    <div class="row-sm">
        @foreach($results as $result)
            <div class="col-md-3 col-sm-6">
                <a href="{{route('categorii.detalii',['categorii'=>$result->categories->descriere,'detalii'=>$result->nume])}}" class="title">
                <figure class="card card-product">
                    <div class="img-wrap"> <img src="{{asset('storage/'.$result->img)}}"></div>
                    <figcaption class="info-wrap">
                        {{$result->nume}}
                        <div class="price-wrap">
                            <span class="price-new">{{$result->priceFormat()}}</span>
                        </div> <!-- price-wrap.// -->
                    </figcaption>
                </figure></a> <!-- card // -->
            </div> <!-- col // -->
        @endforeach
    </div>
    @else
    <div class="alert-success">
                <div class="alert alert-success alert-block">
                     <strong>Nu s-au găsit produse!</strong>
                 </div>
            </div>
    @endif
    <div class="d-flex justify center">
            {{$results->links()}}
    </div>
</div>
</section>
  @endsection
