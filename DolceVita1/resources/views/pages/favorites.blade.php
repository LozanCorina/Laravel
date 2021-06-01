@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y border-top">
    <div class="container">
    <div>
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
    </div>
    <div class="row">
        <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    @if($data->products->count())
        <div class="card">
        <table class="table table-hover shopping-cart-wrap p-1">
        <thead class="text-muted">
        <tr>
        <th scope="col">Produs</th>
        <th scope="col" width="120">Preț</th>
        <th scope="col" class="text-right" width="200">Acțiune</th>
        </tr>
        </thead>
        @foreach($data->products as $product)
        <tbody>
        <tr>
            <td>
        <figure class="media">
            <a href="{{route('categorii.detalii',['categorii'=>$product->categories->descriere,'detalii'=>$product->nume] )}}">
                <div class="img-wrap"><img src="{{asset('storage/'.$product->img)}}" class="img-thumbnail img-sm"></div>
            </a>
    
            <figcaption class="media-body">
                <h6 class="title text-truncate">{{$product->nume}} </h6>
                <dl class="dlist-inline small">
                    <dt>Descriere: </dt>
                    <dd>{{$product->descriere}}</dd>
                </dl>
            </figcaption>
        </figure>
            </td>
            <td>
                <div class="price-wrap">
                @if($product->promo == 1)
                    <var class="price">{{returnPricePromo($product->pret)}}</var>
                @else
                    <var class="price">{{returnPriceFormat($product->pret)}}</var>
                @endif   
                </div> <!-- price-wrap .// -->               
            </td>
            <td class="text-right">
            <form style="display:inline;" action="{{route('adauga.favorite',['produs'=>$product->id])}}" method="POST" >
                @csrf			
                <button data-original-title="Salvează în coșul de cumpărături" type="submit" onClick="this.form.submit(); this.disabled=true;" title="" class="btn btn-outline-primary" data-toggle="tooltip"> <i class="fa fa-shopping-cart"></i></button>	
            </form>
            <a href="{{route('sterge.favorite',$product->id)}}"  class="btn btn-outline-danger" style="width:112px;"> × Șterge</a>
            </td>     
        </tr>
        </tbody>
        @endforeach 
        </table>
        </div> <!-- card.// -->
        @else
            <div class="alert-success">
                <div class="alert alert-success alert-block">
                     <strong>Nu sunt produse favorite!</strong>
                 </div>
            </div>
        @endif
    </main> <!-- col.// -->
    </div>

    </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->

    <!-- ========================= SECTION  ========================= -->
    <section class="section-name bg-white padding-y">
    <div class="container">
    <header class="section-heading">
    <h2 class="title-section">Informații suplimentare</h2>
    </header><!-- sect-heading -->

    <p> Returnarea mărfii:</p>
    <p> 
        Datorită naturii artizanale a produselor noastre, nu putem oferi rambursări sau schimbăm produse de panificație și patiserie.
        Odată ce un tort a fost luat de dvs. sau de o parte desemnată, acesta este considerat "acceptat". Toate produsele sunt responsabilitatea clientului după ce acesta părăsește magazinul nostru sau după primirea de la șoferi. Restituirile solicitate datorită stilului de decorare, nuanței de culoare sau designului general de decorare nu vor fi onorate.
        Dacă aveți nevoie să amânați tortul pentru o altă dată, avem nevoie de o notificare de cel puțin 48 de ore în avans. Putem ține comanda amânată pentru o perioada nelimitată sau vă putem reprograma comanda pentru altă dată (în funcție de disponibilitate).
    </p>
    </div><!-- container // -->
    </section>
    <!-- ========================= SECTION  END// ========================= -->
@endsection
