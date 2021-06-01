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
                    <img  style="height: 30px; width: 35px; padding-right: 2px;" src="{{asset('front_assets/images/icons/terms.png')}}">
                    Rambursarea plății
                </th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <div> 
                         <p> Se efectuează în cazurile când există o bănuială rezonabilă că a fost comisă o fraudă și când livrarea este imposibilă sau livrarea nu a fost efectuată în limitele termenului maxim / nu a fost efectuată în termen de 30 (treizeci) zile din data confirmării Operațiunii de plată respective, SC “DOLCEVITA” SRL este obligat să inițieze Revocarea Operațiunii de plată/Tranzacției respective, cu excepția situațiilor în care a fost primit de la Cumpărător acordul expres în scris cu privire la prelungirea termenului de livrare. Magazinul electronic DolceVita sau Cumpărătorul are posibilitate să inițieze atât Revocarea Operațiunii de plată/Tranzacției în sumă totală, cât şi în sumă parțială, reieșind din natura şi cauza revocării.
                                </p>
                                <p> Returnarea mărfii
                                Datorită naturii artizanale a produselor noastre, nu putem oferi rambursări sau schimbăm produse de panificație și patiserie.
                                Odată ce un tort a fost luat de dvs. sau de o parte desemnată, acesta este considerat "acceptat". Toate produsele sunt responsabilitatea clientului după ce acesta părăsește magazinul nostru sau după primirea de la șoferi. Restituirile solicitate datorită stilului de decorare, nuanței de culoare sau designului general de decorare nu vor fi onorate.
                                Dacă aveți nevoie să amânați tortul pentru o altă dată, avem nevoie de o notificare de cel puțin 48 de ore în avans. Putem ține comanda amânată pentru o perioada nelimitată sau vă putem reprograma comanda pentru altă dată (în funcție de disponibilitate).
                                </p>
                                <p> Dacă doriți să schimbați forma tortuluii dvs., vă rugăm să ne informați în decurs de 48 de ore. Torturile 3D necesită o notificare de cel puțin 5 zile dacă schimbările vor fi făcute la tort sau pentru a schimba data. Aroma și textura tortului sunt subiective. Restituirile solicitate din cauza aromei sau texturii după ce tortul a fost acceptat și preluat nu vor fi onorate.
                                Puteți beneficia de o rambursare dacă produsul este adus înapoi la noi și calitatea aromei sau texturii tortului nu respecte standardele noastre. Producția noastră este testată zilnic pentru a asigura cea mai înaltă calitate posibilă. Țineți minte, varietatea temperaturii și umiditatea poate afecta într-o oarecare măsură aroma, designul general sau textura tortului. Vă rugăm să înțelegeți că nu putem controla modificările de textură sau schimbări de culoare sau formă din cauza condițiilor meteorologice.
                                Băuturi Alcoolice pot fi vândute și livrate doar pînă la ora 18.00. Minorii sub vârsta de 18 ani li se interzice să procure băuturi alcoolice.
                                Următoarele scenarii sunt singurele cazuri în care vom oferi rambursări înainte de livrare:
                                Anulare pentru "Plata Online": cel puțin 48 ore (torturi la comanda) înainte de livrare cu taxa de 5%; în caz contrar cînd producerea a început lucrul asupra produsului se va aplica o taxă de 30% din comanda dvs. Rambursarea se va face numai prin metoda originală de plată.
                                Pentru întrebări legate de restituirea mărfii vă adresați la Serviciul Suport Clienți.
                            </p>
                              
                        </div>
                        <div>
                        <p> 
                                 Reclamații:
                                În cazul reclamațiilor legate direct de bunurile achiziționate, puteți contacta Serviciul Suport Clienți: tel. (+373) 22025858; (+373) 60025858. Adresa de email: direct@dolcevita.com, pentru a găsi o soluție de remediere a situației, în caz contrar puteți să vă adresați la Agenția pentru Protecția Consumatorilor și Supravegherea Pieței pe următoarele coordonate: or București, str. Vasile Alecsandri 78, RO-2012. Telefon: (022) 51-51-51 Linia fierbinte: 080028028 www.consumator.gov.ro
                                Zilele de lucru ale Serviciului suport: luni –vineri, orele de lucru 09:00 până la ora 17:00, sâmbătă-de la 09:00 pănă la 13:00, duminica - zile libere.
                                </p>
                                <p>Dispoziții finale și juridice:
                                Orice litigiu apărut în timpul accesării site-ului www.dolcevita.com (în timpul efectuării comenzii, achitării sau transportării produselor) va fi soluționat pe cale amiabilă în decurs de 30 zile lucrătoare din momentul înștiințării vânzătorului în formă scrisă. În cazul în care conflictul nu poate fi soluționat pe cale amiabilă, competența revine instanțelor de judecată din Republica Moldova. Fiind de acord cu acești termeni și condiții, clientul își asumă în totalitate aceste riscuri.
                            </p>
                        </div>
                    </td>
                </tr>
                </tbody>
                </table>
                </div> <!-- card.// -->

             </main> <!-- col.// -->

        </div>
    <div>
</section>
 <!-- ========================= SECTION  END// ========================= -->
 @endsection