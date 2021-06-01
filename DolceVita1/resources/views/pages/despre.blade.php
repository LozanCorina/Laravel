@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y border-top">
    <div class="container">
    <h1 class="h1-responsive font-weight-bold text-center my-5">Despre noi</h1>
                <!-- Section description -->
               
                <p class="text-center w-responsive">Suntem plini de emoții când trebuie să povestim de unde am pornit și câte provocări am avut.</p>
        <div class="row">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                        <div class="container display d-flex padding-y">
                            <div>
                                <header class="section-heading">
                                    <h2 style="font-family: 'Forte' ">De unde ideea ?...</h2>
                                </header><!-- sect-heading -->
                                <p>Totul a început acum doi ani, când un grup de prieteni, dornici să schimbe lumea spre bine, au decis să facă un dar frumos copiilor
                                                                din orfelinat. Am dorit să creăm atmosfera de sarbatoare și am decis să coacem dulciuri pentru pici.
                                </p>
                                <p>Din toate ce-am avut, am colectat bani și de la alți prieteni care doreau sa ni se alăture.
                                                                Pâna la final, am reușit să strângem o sumă bună pentru a crea un zâmbet și o amintire dulce copilașilor.
                                </p>
                                <p>Până la final, un reprezentat mass-media a auzit despre noi. A scris un articol despre fapta noatră si ne-a întrebat dacă suntem cofetari sau brutari.
                                                                Noi pe atunci studenți, dornici de muncă, nici nu ne-am gândit peste cateva luni să rasară ideea să deschidem o afacere de cofetărie.
                                </p>
                            </div>
                        <div>
                         <img style="margin-left: 10px; padding-right: 10px; height: auto; width: 100%;" src="{{asset('front_assets/images/avatars/car.jpg')}}">
                </div> <!-- card.// -->

             </main> <!-- col.// -->
        </div>

        <div class="row padding-top 10px">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="container display d-flex padding-y">
                        <div>
                            <img style="padding-right: 10px; height: auto; width: 100%;"src="{{asset('front_assets/images/avatars/ev.jpg')}}">
                        </div>
                            <div class="content">
                                <header class="section-heading">
                                    <h2 style="font-family: 'Forte' ">Evolutia...</h2>
                                </header><!-- sect-heading -->
                                                <p> În departamentul de cercetare și dezvoltare, activează Comitetul dedicat inovațiilor.
                                                    Acesta este format din specialiști în diverse domenii de activitate, ce au ca scop abordarea noilor trenduri, analiza ideilor inovatoare, implicarea în procesul de cunoaștere și creștere a companiei.
                                                </p>
                                                Avantajul nostru CONCURENȚIAL UNIC este axat pe străduința noastră de a fi cea mai bună ALEGERE în calitate, gust și aspect exterior al produselor.
                                                <p>

                                                </p>
                            </div>
                    </div>
                </div> <!-- card.// -->
            </main> <!-- col.// -->
        </div>

        <div class="row padding-top 10px">
            <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                                    <div class="container display d-flex padding-y">
                                            <div class="content">
                                                <header class="section-heading">
                                                    <h2 style="font-family: 'Forte' ">Echipa...</h2>
                                                 </header><!-- sect-heading -->
                                                <p> Peste jumate de an am reușit să creăm o echipă dornică de muncă, pasionată de stil, design și gust.
                                                    Împreună, cu mari puteri, am reușit să ajungem la scopul propus. Să intrăm în casele voastre și de sarbatori
                                                    să ne aveți pe mese.
                                                </p>
                                                <div style="background-color:  MistyRose;">
                                                <p>
                                                    În scopul realizării celor expuse mai sus, compania își stabilește ca VALORI FUNDAMENTALE următoarele:
                                                        <ul>
                                                            <li>	Disciplina în execuție - “am spus - am făcut”;</li>
                                                            <li>	Spirit de echipă – “unul pentru toți, toți pentru unul”;</li>
                                                            <li>	Respectul reciproc - “respectăm și încurajăm păreri diferite”;</li>
                                                            <li>Dezvoltarea profesională și personală - “vom avansa doar împreună”</li>
                                                        </ul>
                                                </p>
                                            </div>
                                                <p>
                                                    Motto-ul de comunicare a esenței brandului este “ZIUA TA UN PIC MAI DULCE”.
                                                </p>
                                                <p>
                                                    Noi credem că oricine merită o viață un pic mai dulce. O viață, pe care ar să o savureze zi de zi, indiferent de statut, mijloace, stil de viață, preferințe și necesități.
                                                    În fiecare produs celebrăm emoții sincere și oamenii care trăiesc cu dedicație față de tot ceea ce fac.
                                                </p>
                                            </div>
                                            <div>
                                                <img style="padding-left: 15px; height: auto; width: 100%;
                                                "src="{{asset('front_assets/images/avatars/col.jpg')}}">
                                            </div>
                                    </div>
                </div> <!-- card.// -->


             </main> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
 </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
