@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y border-top">
    <div class="container">
        <div class="row">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                <table class="table shopping-cart-wrap p-1">
                <thead class="text-muted">
                <tr>
                <th scope="col">
                    <img  style="height: 30px; width: 35px; padding-right: 2px;" src="{{asset('front_assets/images/icons/pay1.png')}}">
                    Modalitate de plat&#259;
                </th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div>
                            <p>Pute&#355;i achita cash,  &#238;n momentul primirii livr&#259;rii de la curier.</p>
                        </div>
                        <div>
                            <p>Alt&#259; metod&#259; este online. Pute&#355;i efectua o plat&#259;  online sigur&#259;, folosind cardul personal.</p>
                        </div>
                    </td>
                </tr>
                </tbody>
                </table>
                </div> <!-- card.// -->

             </main> <!-- col.// -->

        </div>


        <div class="row padding-top 10px">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                <table class="table shopping-cart-wrap p-1">
                <thead class="text-muted">
                <tr>
                <th scope="col">
                    <img  style="height: 30px; width: 35px; padding-right: 2px;" src="{{asset('front_assets/images/icons/del1.png')}}">
                    Modalitate de livrare
                </th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div>
                            <p>Pute&#355;i ridica comanda de la sediul principal. </p>
                            <p>Ora&#351;ul <i>Bucure&#351;ti str. Stefan cel Mare nr.7</i></p>
                            <p>Program: Lu-Du 08:00-22:00</p>
                        </div>
                        <div>
                            <p>O alt&#259; metod&#259; este livrare la domiciliu sau la adresa indicat&#259; din comand&#259;.</p>
                            <p>Pre&#355;ul livr&#259;rii variaz&#259; &#238;n dependen&#355;&#259; de distan&#355;a fa&#355;&#259; de sediul principal.</p>
                        </div>
                    </td>
                </tr>
                </tbody>
                </table>
                </div> <!-- card.// -->

             </main> <!-- col.// -->

        </div>
    </div> <!-- container .//  -->
 </section>
  @endsection
