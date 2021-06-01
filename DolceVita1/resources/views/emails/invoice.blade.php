<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- Bootstrap4 files-->
<script src="{{ asset('front_assets/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<link href="{{asset('front_assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<!-- custom style -->
<link href="{{asset('front_assets./css/ui.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('front_assets/css/responsive.css')}}" rel="stylesheet" media="only screen and (max-width: 1200px)" />
<!-- our styles -->
<link href="{{asset('front_assets/css/styles.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('front_assets/css/checkout.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>
<section class="section-content bg padding-y border-top">
<div class="container d-flex justify-content-center">
        <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
            <div class="card">
                <header class="card-header">     
                    <h4 class="card-title mt-2">Factura DolceVita
                    <img  src="{{asset('front_assets/images/icons/logo.jpg')}}" style=" border-radius: 50%; height: 70px; float:right;">
                    </h4>
                    <small class="form-text text-muted"> <p>infoDolceVita@gmail.com| saleDolceVita@gmail.com
                   <br> Bucureşti, 8003655 România | + 40 075887324</p>
                    </small>
                </header>
            <article class="card-body">  
                    <div class="form-row">
                        <h4 class="card-title mt-2">Factura nr#12345</h4>
                    </div> 
                    <br>
                    <table class="section-content  padding-y" >
                        <tr>
                            <td style="float: left;">
                                <p>Data facturare: {{$data['date_now']}}
                                    <br>
                                    Data Livrare: {{$data['date']}}
                                    <br>
                                    Valuta: RON
                                </p>
                            </td>
                            <td style="float: right;">
                                <p>Clientul: {{$data['name']}}
                                    </br>
                                    Email: {{$data['email']}}
                                    </br>
                                    Adresa: {{$data['city']}} &nbsp; {{$data['home']}}
                                    <br>
                                    Contacte: {{$data['phone']}}
                                    <br>
                                </p>
                            </td>
                        </tr>
                        </table>
                       
                        <table  class=" table table-striped" style="margin-top: 80px;">
                            <thead>
                                <tr>
                                    <th  scope="col"> Produse comandate:
                                    </th>
                                    <th  scope="col"> Cantitate:
                                    </th>
                                    <th  scope="col"> Gramaj:
                                    </th>
                                    <th  scope="col"> Preț:
                                    </th>
                                    <th  scope="col"> Suma:
                                    </th>
                                </tr>
                            </thead>
                            @foreach($data1->product as $product)
                            <tr>
                                <td>
                                {{$product->nume}}
                                </td>
                                <td>
                                {{$product->pivot->qty}}
                                </td>
                                <td>
                                {{$product->pivot->weight}} kg
                                </td>
                                <td>
                                {{returnPriceFormat($product->pret)}}
                                </td>  
                                <td>
                                {{returnPriceFormat($product->pivot->totalprice)}}
                                </td> 
                            </tr>
                            @endforeach
                    </table>  

                    <aside  class=" table table-primary" style="float: rigth;"> 
                        <table>
                            <tr class="border-buttom">
                                <td style="float:left;">
                                Subtotal:
                                </td>
                                <td style="float:right;">
                                {{$data['subtotal']}} lei
                                </td>
                            </tr>
                            <tr>
                                <td style="float:left;"> Reducere: 
                                </td>
                                @if($data['discount'] =='')
                                <td style="float:right;"> 0 lei
                                @else
                                <td style="float:right;"> {{$data['discount']}} lei
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="float:left;"> Livrare: 
                                </td>
                                @if($data['delivery'] =='')
                                <td style="float:right;"> 0 lei
                                @else
                                <td style="float:right;"> {{$data['delivery']}} lei
                                @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="float:left;"> Total: 
                                </td>
                                @if($data['amount'] =='')
                                <td style="float:right;"> 0 lei
                                @else
                                <td style="float:right;"> {{$data['amount']}} lei
                                @endif
                                </td>
                            </tr>
                        </table>
                    </aside>
                    <div class="content"> 
                        Notițe: {{$data['note']}}
                    </div>
                   
            </article> <!-- card-body end .// -->
        </div> <!-- card.// -->
        </main>
    </div>
</section>
</body>
</html>
