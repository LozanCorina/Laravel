@extends('layouts.main')
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
            <section class="section-content bg padding-y border-top">
                <div class="container">
                    <h1 class="h1-responsive font-weight-bold text-center my-5">Tutoriale</h1>
                     <!-- Section description -->
                    <p class="text-center w-responsive mx-auto pb-5">Suntem bucuroși să împărtășim din talentele noastre. Ești pregătit să descoperi magia gustului și dibăcia proprie? </p>
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
                    <main class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="card" style="background-color:  MistyRose;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe  class="embed-responsive-item" style="padding-right: 10px;" width="760" height="315" src="https://www.youtube.com/embed/2utgqRCAIr4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="background-color:  MistyRose; padding-left: 15px; padding-top: 15px; ">
                                    <form id="send-from" action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                                         @csrf
                                         <input type="hidden" name="raffle_id" value="{{$raffle_id}}"/>
                                        <header class="section-heading">
                                            <h2 style="font-family: 'Forte' ">Participă la tombolă!</h2>
                                        </header><!-- sect-heading -->
                                        @if($tombole==0)
                                        <p>Momentan nu sunt tombole în desfășurare</p>
                                        @else
                                        <p>Condițiile tombolei:</p>
                                        <p> 1. Participantul trebuie să încarce o poză cu prăjitura preparată după tutorialele noastre și la finalul tombolei va fi extras cu ajutorul aplicației aleator o persoană.</p>
                                        <p> 2. Perioada și aria de desfășurare a tombolei</p>
                                        <p> 2.1. Tombola este organizată și se desfăsoară pe întreg teritoriul României în conformitate cu prevederile prezentului Regulament.</p>
                                        <p> 2.2. Perioada de desfășurare a tombolei "{{$numeTombola}}"" este {{$startDate}} – {{ $endDate}} inclusiv. Dupa data încheierii tombolei, Organizatorul nu mai are nicio responsabilitate și nu își mai asumă nicio obligație în legatură cu orice circumstanță care ar putea eventual conduce la concluzia actualității sau continuării tombolei</p>
                                        <p> 3. Premiul tombolei este o prăjitură din partea companiei sau o reducere de 80% la suma achiziționată!</p>
                                        <div class="form-row">
                                            <div class="col form-group d-flex flex-column">    
                                                <label for="upload">Atașează poza:</label>
                                                <input type="file" name="upload" accept="image/png, image/jpeg" required>
                                            </div> <!-- form-group end.// -->           
                                        </div> <!-- form-row end.// -->
                                        <div class="text-center" style="padding-bottom: 15px;">
                                            <?php
                                                $dateSrc1= $startDate;
                                                $dateSrc2=$endDate;
                                                $startDate = date_create( $dateSrc1);
                                                $endDate = date_create( $dateSrc2);
                                                if(date_format($startDate,'Y-m-d') < now() and now() < date_format($endDate,'Y-m-d'))
                                                {
                                                    $valideDate=1;//valabil
                                                }
                                                else if( now() > date_format($endDate,'Y-m-d'))
                                                {
                                                    $valideDate=2;//expirat
                                                }
                                                else if( now() < date_format($startDate,'Y-m-d') )
                                                {
                                                    $valideDate=0; //inca nu e timpul
                                                }
                                            ?>  
                                            @if(!Auth::check())
                                              @if($valideDate==1)
                                                <button id="submit-btn" type="submit" name="send" class="btn btn-primary" disabled title="Loghează-te pentru a ne trimite poza">Încarcă</button>
                                                <p>Loghează-te pentru a ne trimite poza</p>
                                               @elseif($valideDate==2)
                                                <button id="submit-btn" type="submit" name="send" class="btn btn-primary" disabled title="Perioada de desfășurare a expirat!">Încarcă</button>
                                                <p>Perioada de desfășurare a expirat!</p>
                                                @elseif($valideDate==0)
                                                <button id="submit-btn" type="submit" name="send" class="btn btn-primary" disabled title="A mai rămas puțin până la desfăsâșurarea tombolei!">Încarcă</button>
                                                <p>A mai rămas puțin până la desfășurarea tombolei!</p>
                                                @endif
                                            @else
                                                @if($valideDate==1)
                                                <button id="submit-btn"type="submit" name="send" class="btn btn-primary" onClick="this.form.submit(); this.disabled=true; this.value='Procesare…'; " title="Încarcă poza!" value="">Încarcă</button>
                                                @elseif($valideDate==2)
                                                <button id="submit-btn"type="submit" name="send" class="btn btn-primary" disabled title="Perioada de desfășurare a expirat!">Încarcă</button>
                                                <p>Perioada de desfășurare a expirat!</p>
                                                @elseif($valideDate==0)
                                                <button id="submit-btn" type="submit" name="send" class="btn btn-primary" disabled title="A mai rămas puțin până la desfăsâșurarea tombolei!">Încarcă</button>   
                                                <p>A mai rămas puțin până la desfășurarea tombolei!</p>
                                                @endif
                                            @endif  
                                        @endif  
                                        </div>   
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
             </section>
<!-- ============== owl slide items  ============= -->
<div class="container">
    <section class="padding-y">
        <h3> Tutoriale prăjituri</h3>	
    </section>
	<div class="row">	
		<div class="owl-carousel owl-init slide-items" data-items="5" data-margin="20" data-dots="true" data-nav="true">
			<div class="item-slide">
                <figure class="card card-product">
                    <span class="badge-new"> NEW </span>
                    <div class="embed-responsive embed-responsive-4by3">
                        <iframe  class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/gDqyXnSXR5E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>		
                    <figcaption class="info-wrap text-center">
                        <h6 class="title text-truncate"> Tort "Summer Time"</h6>
                        <small class="text-secondary"> Tort cu glazură de fructe de vară, cu pudră de cocos.</small>
                    </figcaption>
                </figure> 
                <!-- card // -->
		    </div>
			    <div class="item-slide">
		            <figure class="card card-product">
                         <div class="embed-responsive embed-responsive-4by3">
                            <iframe   class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/x8viTpKTV1M" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			            </div>
                         <figcaption class="info-wrap text-center">
				            <h6 class="title text-truncate">Tort "Primăvara"</h6>
				            <small class="text-secondary"> Tort cu gust rafinat și aromă intensă de vanilie</small>
			            </figcaption>
		            </figure> <!-- card // -->
			    </div>
			    <div class="item-slide">
		            <figure class="card card-product">
                         <div class="embed-responsive embed-responsive-4by3">
                         <iframe  class="embed-responsive-item" style="padding-right: 10px;" width="560" height="315" src="https://www.youtube.com/embed/2utgqRCAIr4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			            </div>
                         <figcaption class="info-wrap text-center">
				            <h6 class="title text-truncate">Tort "Strawberry"</h6>
				            <small class="text-secondary"> Tort cu căpșuni și glazură de căpșuni.</small>
			            </figcaption>
		            </figure> <!-- card // -->
			    </div>
			    <div class="item-slide">
		            <figure class="card card-product">
                        <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/UMCZxqewVB8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			            </div>
                        <figcaption class="info-wrap text-center">
				            <h6 class="title text-truncate">Tort cu ciocolată</h6>
				            <small class="text-secondary"> Tort cu gust rafinat de ciocolată și aromă intensă de cafea</small>
			            </figcaption>
		            </figure> <!-- card // -->
			    </div>
			    <div class="item-slide">
		            <figure class="card card-product">
                        <div class="embed-responsive embed-responsive-4by3">
                        <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/lLafvxoUHrY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			            </div>
                        <figcaption class="info-wrap text-center">
				            <h6 class="title text-truncate">Macarons cu coacăză</h6>
				            <small class="text-secondary"> Macarons super moi înăuntru cu dulceață de coacăză.</small>
			            </figcaption>
		            </figure> <!-- card // -->
			    </div>
			    <div class="item-slide">
		            <figure class="card card-product">
                        <div class="embed-responsive embed-responsive-4by3">
                        <iframe  class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/73Fsbmq7UtE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			            </div>
                        <figcaption class="info-wrap text-center">
				            <h6 class="title text-truncate">Gogoși</h6>
				            <small class="text-secondary"> Cele mai moi gogoși cu cremă de vanilie.</small>
			            </figcaption>
		            </figure> <!-- card // -->
			    </div>
			    <div class="item-slide">
		            <figure class="card card-product">
                        <div class="embed-responsive embed-responsive-4by3">
                        <iframe  class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/3vUtRRZG0xY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			            </div>
                        <figcaption class="info-wrap text-center">
				            <h6 class="title text-truncate">Biscuiți cu ciocolată</h6>
				            <small class="text-secondary"> Biscuiți ca la mămuca acasă</small>
			            </figcaption>
		            </figure> <!-- card // -->
			    </div>
		</div>
	</div>
</div>
	<!-- ============== owl slide items .end // ============= -->
 <!-- ========================= SECTION  END// ========================= -->
 @endsection