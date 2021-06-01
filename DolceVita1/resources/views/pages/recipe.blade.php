@extends('layouts.main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {

        function calcAndShowTotal(){
            var total = 0;
            $('#pricelist :checked').each(function(){
                total += parseFloat($(this).attr('price'));
            });          
            $('#total').val(total);
            var Grandtotal = parseFloat($('#price').attr('price'));
            Grandtotal+=total;
            $('#price').attr('price2',Grandtotal);
            $('#price').val(Grandtotal);
            $('#pretUnitarCio').val(Grandtotal);
        }
        function calculateMacarons(){
            var totalM = 0;
            $('#pricelistM :checked').each(function(){
                totalM += parseFloat($(this).attr('price'));
            });          
            $('#totalM').val(totalM);
            var Grandtotal = parseFloat($('#priceM').attr('price'));
            Grandtotal+=totalM;
            $('#priceM').attr('price2',Grandtotal);
            $('#priceM').val(Grandtotal);
            $('#pretUnitarMa').val(Grandtotal);
        }
        function calculateCroissant(){
            var total = 0;
            $('#pricelistC :checked').each(function(){
                total += parseFloat($(this).attr('price'));
            });          
            $('#totalC').val(total);
            var Grandtotal = parseFloat($('#priceC').attr('price'));
            Grandtotal+=total;
            $('#priceC').attr('price2',Grandtotal);
            $('#priceC').val(Grandtotal);
            $('#pretUnitarCro').val(Grandtotal);
        }
        function calculateTort(){
            var total = 0;
            $('#pricelistT :checked').each(function(){
                total += parseFloat($(this).attr('price'));
            });          
            $('#totalT').val(total);
            var Grandtotal = parseFloat($('#priceT').attr('price'));
            Grandtotal+=total;
            $('#priceT').attr('price2',Grandtotal);
            $('#priceT').val(Grandtotal);
            $('#pretUnitarTort').val(Grandtotal);
        }

        function ValidateChocolate(){

            var qty= parseFloat($('#qty option:selected').val());
            if(qty < 2){
               // alert('Comanda poate fi creată la procurarea mai mult de o unitate de produs!');
            }
            
        }

     function Validate()
    {
        //for croissant
        var qty= parseFloat($('#qtyC option:selected').val());
        if(qty > 5){                         
            $("#submit").prop('enabled', true);   
        }
        else
        {
            $("#submit").prop('disabled', true);     
        }      
        //for chocolate
        var qty= parseFloat($('#qty option:selected').val());
        if(qty > 2){                         
            $("#submitCho").prop('enabled', true);   
        }
        else
        {
            $("#submitCho").prop('disabled', true);     
        } 
                    
    }

        Validate();
        
        $('#pricelist').click(function(){
            calcAndShowTotal();
        });
        $('#pricelistM').click(function(){
            calculateMacarons();
        });
        $('#pricelistC').click(function(){
            calculateCroissant();
        });
        $('#pricelistT').click(function(){
            calculateTort();
        });       


        $('#qty').change(function(){
            var qty= parseFloat($('#qty option:selected').val());
            var price = parseFloat($('#price').attr('price2'));
            if(isNaN(price))
            {
                $('#qty').val('1');
                alert("Selectați componentele pentru rețetă!");
            }
            else if(qty < 2)
            {
                alert('Comanda poate fi creată la procurarea mai mult de o unitate de produs!');
                $("#submitCho").prop('disabled', true);   
            }
            else
            {   $("#submitCho").prop('disabled', false);  
                var finalPrice= qty*price;
                $('#price').val(finalPrice);
            }
	    });
        $('#qtyC').change(function(){
            var qty= parseFloat($('#qtyC option:selected').val());
            var price = parseFloat($('#priceC').attr('price2'));
            if(isNaN(price))
            {
                $('#qtyC').val('1');
                alert("Selectați componentele pentru rețetă!");
            }
            else if(qty < 5)
            {
                alert('Comanda poate fi creată la procurarea mai mult de 5 unități de produs!');
                $("#submit").prop('disabled', true);   
            }
            else{
                $("#submit").prop('disabled', false);   
                var finalPrice= qty*price;
                $('#priceC').val(finalPrice);
            }
            
	    });
        $('#qtyM').change(function(){
            var qty= parseFloat($('#qtyM option:selected').val());
            var price = parseFloat($('#priceM').attr('price2'));           
            var weight = parseFloat($('#weightM option:selected').val());
            if(isNaN(price))
            {
                $('#qtyM').val('1');
                alert("Selectați componentele pentru rețetă!");
            }
            else{
                var finalPrice= qty*price*weight;
                $('#priceM').val(finalPrice);
            }
	    });
        $('#weightM').change(function(){
            var qty= parseFloat($('#qtyM option:selected').val());
            var price = parseFloat($('#priceM').attr('price2'));
            var weight = parseFloat($('#weightM option:selected').val());
            if(isNaN(price))
            {   $('#weightM').val('1');
                alert("Selectați componentele pentru rețetă!");
            }
            else{
                var finalPrice= qty*price*weight;
                $('#priceM').val(finalPrice);
            }
	    });
        $('#qtyT').change(function(){
            var qty= parseFloat($('#qtyT option:selected').val());
            var price = parseFloat($('#priceT').attr('price2'));
            var weight = parseFloat($('#weightT option:selected').val());
            if(isNaN(price))
            {
                alert("Selectați componentele pentru rețetă!");              
                $('#qtyT').val('1');
            }
            else{
                var finalPrice= qty*price*weight;
                $('#priceT').val(finalPrice);
            }
	    });
        $('#weightT').change(function(){
            var qty= parseFloat($('#qtyT option:selected').val());
            var price = parseFloat($('#priceT').attr('price2'));
            var weight = parseFloat($('#weightT option:selected').val());
            if(isNaN(price))
            {
                $('#weightT').val(1);
                alert("Selectați componentele pentru rețetă!");
            }
            else{
                var finalPrice= qty*price*weight;
                $('#priceT').val(finalPrice);
            }
	    });
    });  

   
	
   
    </script>
<script>


function Open() {
    var val = document.getElementsByName("category"); 
    for(i = 0; i < val.length; i++) 
    { 
        if(val[i].checked) 
        {
            if(val[i].value == 'torturi')
            {
                document.getElementById('ciocolata').style.display = "none";
                document.getElementById('macaron').style.display = "none";
                document.getElementById('croissan').style.display = "none";
                document.getElementById('tort').style.display = "block";
                document.getElementById('resultT').value = val[i].value;
            }
            else if(val[i].value == 'ciocolată')
            {
                document.getElementById('macaron').style.display = "none";
                document.getElementById('croissan').style.display = "none";
                document.getElementById('tort').style.display = "none";
                document.getElementById('ciocolata').style.display = "block";                 
                document.getElementById('result').value = val[i].value;
            }                
            else if(val[i].value == 'macarons')
            {
                document.getElementById('ciocolata').style.display = "none";
                document.getElementById('tort').style.display = "none";
                document.getElementById('croissan').style.display = "none";                  
                document.getElementById('macaron').style.display = "block";
                document.getElementById('resultM').value = val[i].value;
            }               
            else if(val[i].value == 'croissant')
            {
                document.getElementById('ciocolata').style.display = "none";
                document.getElementById('macaron').style.display = "none"; 
                document.getElementById('tort').style.display = "none";                                    
                document.getElementById('croissan').style.display = "block"; 
                document.getElementById('resultC').value = val[i].value;
            }
        }
               
    } 
  
}

</script>
<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y border-top">
    <div class="container">
        <div class="row justify-content-center">
            <main class="col-xl-10 col-lg-10 col-md-10 col-sm-10">
                <div class="card" style="border-radius: 20px; box-shadow: 0 0 15px #888888;">
                    <div class="card-header"><h4>Rețetă personalizată</h4></div>
                        <div class="card-body">
                            @if($message=Session::get('success_message'))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success alert-block" role="alert">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                            <strong>{{$message}}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="card mb-3">
                                <div class="card-header">Alege produsul</div>               
                                <div class="card-body display d-flex">
                                    @foreach($categorie as $category)
                                    @if($category->descriere == 'torturi' or $category->descriere == 'macarons' or $category->descriere == 'ciocolată' or $category->descriere == 'croissant')
                                    <div class="form-check" style="margin-right: 10px;">
                                        <input class="form-check-input"  type="radio" name="category" id="{{$category->descriere}}" onclick="Open()" value="{{$category->descriere}}"  required>
                                        <label class="form-check-label" for="{{$category->descriere}}" style="text-transform: capitalize;">{{$category->descriere}}</label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <!-- form for cacke -->
                            <div style="display:none; position:relative" id="tort">
                                <div class="card mb-3">
                                    <div class="card-header">Crează rețeta</div>               
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('recipe.store')}}">
                                                @csrf
                                                <input type="hidden" id="resultT" name="result" value="">                      
                                                <input type="hidden" name="client" value="{{auth()->user()->name}}">
                                                <input type="hidden" name="mail" value="{{auth()->user()->email}}">
                                                <div id="pricelistT">
                                                    <div class="form-group">
                                                        <label>Umplutură</label>   
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input"  type="radio" name="umplutura" price="12.75" value="Ideal" required />
                                                            <label class="form-check-label" for="c1"><b>Ideal</b>
                                                                Umplutură din foi subțiri cu miere, cremă de smântână și vișină.
                                                                Potrivită pentru forme complexe.
                                                            </label>
                                                        </div>
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input"  type="radio" name="umplutura"  price="14.75" value="Romance">
                                                            <label class="form-check-label" for="c1"><b>Romance</b>
                                                                Umplutură din foi de miere și cacao cu cremă de smântână și ciocolată.
                                                                Potrivită pentru forme complexe.</label>
                                                        </div>
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input"  type="radio" name="umplutura" price="10.25" value="Smântânel">
                                                            <label class="form-check-label" for="c1"><b>Smântânel</b>
                                                                Umplutură din foi subțiri de miere cu crema de smântână si miez de nucă grecească.
                                                                Potrivită pentru forme complexe.</label>
                                                        </div>
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input"  type="radio" name="umplutura"  price="13" value="Fiesta">
                                                            <label class="form-check-label" for="c1"><b>Fiesta</b>
                                                                Umplutură din foi de miere cu cremă de smântână si miez de nucă grecească.
                                                                Potrivită pentru forme complexe.</label>
                                                        </div>
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input"  type="radio" name="umplutura"  price="11" value="Tiramisu">
                                                            <label class="form-check-label" for="c1"><b>Tiramisu</b>
                                                                    Umplutură din ruladă albă si ruladă cu cacao cu cremă din cașcaval topit și cafea.
                                                                    NU e portivit pentru forme complexe.</label>
                                                        </div>
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input"  type="radio" name="umplutura"  price="14.5" value="Mascarpone">
                                                            <label class="form-check-label" for="c1"><b>Mascarpone</b>
                                                                Umplutură din foi subțiri de aluat opărit, cremă de brânză Mascarpone și vișină.</label>
                                                        </div>
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input"  type="radio" name="umplutura" price="14.75" value="Prințul Negru">
                                                            <label class="form-check-label" for="c1">
                                                            <b>Prințul Negru</b>
                                                            Umplutură din pandișpan de ciocolată, cremă de cafea și nuci grecești.</label>
                                                        </div>
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input"  type="radio" name="umplutura"  price="15.66" value="Tropic Breeze">
                                                            <label class="form-check-label" for="c1">
                                                            <b>Tropic Breeze</b>
                                                            Umplutură din foi fărâmicioase cu cocos și cremă cu cocos.
                                                            Ornare doar cu FRIȘCĂ.</label>
                                                        </div>                                                   
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label>Supliment</label>   
                                                        <div class="display d-flex">
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]" price="5.5" value="Nucă">
                                                                <label class="form-check-label" for="c1">Nucă</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]"price="9" value="Cocos">
                                                                <label class="form-check-label" for="c1">Cocos</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]"price="7.3" value="Prună">
                                                                <label class="form-check-label" for="c1">Prună</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]"price="5" value="Vișină">
                                                                <label class="form-check-label" for="c1">Vișină</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]"price="11" value="Alune de migdale">
                                                                <label class="form-check-label" for="c1">Alune de migdale</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Decor</label> 
                                                        <div class="display d-flex">
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="decor"  price="8.25" value="Floare">
                                                                <label class="form-check-label" for="c1">Floare</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="decor" price="11" value="Animăluțe">
                                                                <label class="form-check-label" for="c1">Animăluțe</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="decor"  price="9.25"value="Iepuraș">
                                                                <label class="form-check-label" for="c1">Iepurași</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="decor" price="8" value="Minion">
                                                                <label class="form-check-label" for="c1">Minion</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="decor" price="12" value="Fructe">
                                                                <label class="form-check-label" for="c1">Fructe</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="decor" price="2" value="Nude">
                                                                <label class="form-check-label" for="c1">Nude</label>
                                                            </div>
                                                        </div>                                                                                                                                                         
                                                    </div>
                                                </div> <!--end priceList -->

                                                <div class="form-group">
                                                    <label>Decor personal</label>  
                                                    <input type="text" class="form-control" name="decor_p" placeholder="Adaugă decor personalizat">
                                                </div>
                                                <div class="form-group">
                                                    <label>Auxiliar</label>  
                                                    <input type="text" class="form-control" name="auxiliar" placeholder="Adaugă ceva personalizat">
                                                </div>
                                                <div>
                                                    <dl class="dlist-inline" style="padding-right:15px;">
                                                        <dt>Preț compoziție: </dt>	
                                                        <dd> 														
                                                        <input type="text" id="totalT" name="total" class="form-control form-control-sm" value="0.00" style="width:70px;" readonly>                                    
                                                        </dd>	
                                                        <p style="display:inline;">lei</p>																				
                                                    </dl>  <!-- item-property .// -->	
                                                </div>
                                                <div class="form-group d-flex">
                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Bucăți: </dt>	
                                                            <dd> 														
                                                            <select  id="qtyT" name="qty" class="form-control form-control-sm" style="width:70px;">
                                                                <option> 1 </option>
                                                                <option> 2 </option>
                                                                <option> 3 </option>
                                                                <option> 4 </option>
                                                                <option> 5 </option>
                                                                <option> 6 </option>							
                                                            </select> 
                                                            </dd>					                         															
                                                        </dl>  <!-- item-property .// -->	
                                                   
                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Gramaj: </dt>	
                                                            <dd> 														
                                                            <select id="weightT" name="gramaj" class="form-control form-control-sm" style="width:70px;">
                                                                <option> 1 </option>
                                                                <option> 2 </option>
                                                                <option> 3 </option>
                                                                <option> 4 </option>
                                                                <option> 5 </option>
                                                                <option> 6 </option>	                        						
                                                            </select> 
                                                            </dd>					
                                                            <p style="display:inline;">kg</p>															
                                                        </dl>  <!-- item-property .// -->	

                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Preț: </dt>	
                                                            <dd> 														
                                                            <input id="priceT" type="text" id="price_tort" name="price" class="form-control form-control-sm" value="25.00"  price="25" price2="" style="width:70px;" readonly>                                    
                                                            <input id="pretUnitarTort" name="pretUnitarTort"type="hidden" value=""/>
                                                            </dd>	
                                                            <p style="display:inline;">lei</p>																				
                                                        </dl>  <!-- item-property .// -->	
                                                    </div>
                                                
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6">
                                                        <button type="submit"  class="btn btn-primary">
                                                            Trimite spre validare
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                </div>
                            </div>
                                                    
                                <!-- first form for chocolate -->
                                <div style="display:none; position:relative" id="ciocolata">
                                    <div class="card mb-3">
                                        <div class="card-header">Crează rețeta</div>               
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('recipe.store')}}">
                                                    @csrf
                                                <input type="hidden" id="result" name="result" value="">
                                                <input type="hidden" name="categorie_id" value="2">
                                                <input type="hidden" name="client" value="{{auth()->user()->name}}">
                                                <input type="hidden" name="mail" value="{{auth()->user()->email}}">
                                                <div id="pricelist">
                                                    <div class="form-group">                                                   
                                                        <label>Tip ciocolată</label>  
                                                        <div class="display d-flex" > 
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="tip_ciocolata" price="8.5" value="Albă"  required>
                                                                <label class="form-check-label" for="c1">Albă</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="tip_ciocolata"  price="8.5" value="Cu lapte"  required>
                                                                <label class="form-check-label" for="c1">Cu lapte</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="radio" name="tip_ciocolata"  price="8.5" value="Neagră(80%)"  required>
                                                                <label class="form-check-label" for="c1">Neagră(80%)</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Supliment</label>   
                                                        <div class="display d-flex" >
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]" price="2.5"  value="Nucă">
                                                                <label class="form-check-label" for="c1">Nucă</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]"  price="2.5"  value="Cocos">
                                                                <label class="form-check-label" for="c1">Cocos</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]" price="2.75"  value="Prună">
                                                                <label class="form-check-label" for="c1">Prună</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]" price="2"  value="Vișină">
                                                                <label class="form-check-label" for="c1">Vișină</label>
                                                            </div>
                                                            <div class="form-check" style="margin-right: 10px;">
                                                                <input class="form-check-input"  type="checkbox" name="supliment[]" price="3.5"  value="Alune">
                                                                <label class="form-check-label" for="c1">Alune</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  
                                                    <div class="form-group">
                                                        <label>Auxiliar</label>  
                                                        <input id="aux" type="text" class="form-control" name="auxiliar" placeholder="Adaugă ceva personalizat">
                                                    </div>
                                                    <div class="form-gropu">
                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Preț compoziție: </dt>	
                                                            <dd> 														
                                                                <input type="text" id="total" name="total" class="form-control form-control-sm" value="0.00" style="width:70px;" readonly>                                                         
                                                            </dd>	
                                                            <p style="display:inline;">lei</p>																			
                                                        </dl>  <!-- item-property .// -->	
                                                    </div>
                                        

                                                    <div class="form-group d-flex">
                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Cutii: </dt>	
                                                            <dd> 														
                                                            <select id="qty" name="qty" class="form-control form-control-sm" style="width:70px;">
                                                                <option> 1 </option>
                                                                <option> 2 </option>
                                                                <option> 3 </option>
                                                                <option> 4 </option>
                                                                <option> 5 </option>
                                                                <option> 6 </option>							
                                                            </select> 
                                                            </dd>					                                                          														
                                                        </dl>  <!-- item-property .// -->	
                                                   
                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Gramaj: </dt>	
                                                            <dd> 														
                                                            <select id="weight" name="gramaj" class="form-control form-control-sm" style="width:70px;">
                                                                <option> 0.5 </option>                        						
                                                            </select> 
                                                            </dd>					
                                                            <p style="display:inline;">kg</p>															
                                                        </dl>  <!-- item-property .// -->	

                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Preț total: </dt>	
                                                            <dd> 														
                                                                <input type="text" id="price" name="price" class="form-control form-control-sm" value="8.00" price="8" price2="" style="width:70px;" readonly>                                                         
                                                                <input id="pretUnitarCio" name="pretUnitarCio" type="hidden" value=""/>
                                                            </dd>	
                                                            <p style="display:inline;">lei</p>																			
                                                        </dl>  <!-- item-property .// -->	
                                                    </div>

                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6">
                                                            <button id="submitCho" type="submit" title="Comanda poate fi creată la procurarea mai mult de o unitate de produs!" class="btn btn-primary">
                                                                Trimite spre validare
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>  
                                            </div>  
                                    </div> 
                                </div>                                                                                  
                                    <!-- Second form for macarons -->
                                        <div style="display:none; position:relative" id="macaron">
                                            <div class="card mb-3">
                                                <div class="card-header">Crează rețeta</div>               
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('recipe.store')}}">
                                                        @csrf
                                                        <input type="hidden" id="resultM" name="result" value="">
                                                        <input type="hidden" name="categorie_id" value="4">
                                                        <input type="hidden" name="client" value="{{auth()->user()->name}}">
                                                        <input type="hidden" name="mail" value="{{auth()->user()->email}}">
                                                        <div id="pricelistM">
                                                            <div class="form-group">
                                                                <label>Culoare (se referă la culoarea macarons, se adaugă coloranți alimentari)</label>  
                                                                <div class="display d-flex"> 
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="culoare" price="3.5" value="Cafenii"  required/>
                                                                        <label class="form-check-label" for="c1">Cafenii</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="culoare" price="3.5" value="Roz"  required/>
                                                                        <label class="form-check-label" for="c1">Roz</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="culoare" price="3.5" value="Galbene"  required/>
                                                                        <label class="form-check-label" for="c1">Galbene</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="culoare" price="3.5" value="Albastre"  required/>
                                                                        <label class="form-check-label" for="c1">Albastre</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="culoare" price="3.5" value="Verzi"  required/>
                                                                        <label class="form-check-label" for="c1">Verzi</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="culoare" price="3.5" value="Portocalii"  required/>
                                                                        <label class="form-check-label" for="c1">Portocalii</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="culoare" price="3.5" value="Roșii"  required/>
                                                                        <label class="form-check-label" for="c1">Roșii</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Cremă</label>  
                                                                <div class="display d-flex"> 
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="crema" price="5.25" value="Vanilie"  required/>
                                                                        <label class="form-check-label">Vanilie</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="crema" price="6" value="Ciocolată"  required/>
                                                                        <label class="form-check-label">Ciocolată</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="crema" price="6" value="Caramel"  required/>
                                                                        <label class="form-check-label" for="c1">Caramel</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="crema" price="4.2" value="Banană"  required/>
                                                                        <label class="form-check-label" for="c1">Banană</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="crema" price="4.2" value="Zmeură"  required/>
                                                                        <label class="form-check-label" for="c1">Zmeură</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="crema" price="4.2" value="Căpșună"  required/>
                                                                        <label class="form-check-label" for="c1">Căpșună</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="crema" price="4.2" value="Portocală"  required/>
                                                                        <label class="form-check-label" for="c1">Portocală</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="crema" price="4.2" value="Vișină"  required/>
                                                                        <label class="form-check-label" for="c1">Vișină</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Decor</label>   
                                                                <div class="display d-flex">
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="decor" price="7" value="Floare" required/>
                                                                        <label class="form-check-label" for="c1">Floare</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="decor" price="8.25" value="Animăluțe" required/>
                                                                        <label class="form-check-label" for="c1">Animăluțe</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="decor" price="8.25" value="Iepuraș" required/>
                                                                        <label class="form-check-label" for="c1">Iepurași</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="decor" price="5" value="Minion" required/>
                                                                        <label class="form-check-label" for="c1">Minion</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="decor" price="4.5" value="Fructe" required/>
                                                                        <label class="form-check-label" for="c1">Fructe</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="decor" price="0" value="Nude" required/>
                                                                        <label class="form-check-label" for="c1">Nude</label>
                                                                    </div>
                                                                </div>                                                       
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Decor personal</label>  
                                                            <input type="text" class="form-control" name="auxiliar" placeholder="Adaugă decor personalizat">
                                                        </div>
                                                        <div class="form-gropu">
                                                            <dl class="dlist-inline" style="padding-right:15px;">
                                                                    <dt>Preț compoziție: </dt>	
                                                                    <dd> 														
                                                                        <input type="text" id="totalM" name="total" class="form-control form-control-sm" value="0.00" style="width:70px;" readonly>                                                         
                                                                    </dd>	
                                                                    <p style="display:inline;">lei</p>																			
                                                            </dl>  <!-- item-property .// -->	
                                                        </div>
                                                        <div class="form-group d-flex">
                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Cutii: </dt>	
                                                            <dd> 														
                                                            <select id="qtyM" name="qty" class="form-control form-control-sm" style="width:70px;">
                                                                <option> 1 </option>
                                                                <option> 2 </option>
                                                                <option> 3 </option>
                                                                <option> 4 </option>
                                                                <option> 5 </option>
                                                                <option> 6 </option>							
                                                            </select> 
                                                            </dd>					                         															
                                                        </dl>  <!-- item-property .// -->	
                                                   
                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Gramaj: </dt>	
                                                            <dd> 														
                                                            <select id="weightM" name="gramaj" class="form-control form-control-sm" style="width:70px;">
                                                                <option> 1 </option>
                                                                <option> 2 </option>
                                                                <option> 3 </option>
                                                                <option> 4 </option>
                                                                <option> 5 </option>
                                                                <option> 6 </option>	                        						
                                                            </select> 
                                                            </dd>					
                                                            <p style="display:inline;">kg</p>															
                                                        </dl>  <!-- item-property .// -->	

                                                        <dl class="dlist-inline" style="padding-right:15px;">
                                                            <dt>Preț: </dt>	
                                                            <dd> 														
                                                                <input type="text" id="priceM" name="price" class="form-control form-control-sm" value="50.00" price2="" price="50" style="width:70px;" readonly>                                    
                                                                <input id="pretUnitarMa" name="pretUnitarMa" type="hidden" value=""/>
                                                            </dd>	
                                                            <p style="display:inline;">lei</p>																			
                                                        </dl>  <!-- item-property .// -->	
                                                    </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Trimite spre validare
                                                                </button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                            </div>
                                        </div>    
                                        <!-- third form croissant -->
                                        <div style="display:none; position:relative" id="croissan">
                                            <div class="card mb-3">
                                                <div class="card-header">Crează rețeta</div>               
                                                    <div class="card-body">
                                                        <form method="POST" action="{{ route('recipe.store')}}">
                                                        @csrf     
                                                        <input type="hidden" id="resultC" name="result" value="">               
                                                        <input type="hidden" name="client" value="{{auth()->user()->name}}">
                                                        <input type="hidden" name="mail" value="{{auth()->user()->email}}">
                                                        <div id="pricelistC">
                                                            <div class="form-group">
                                                                <label>Umplutură</label>  
                                                                <div class="row" style="padding-left: 15px;"> 
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="umpl" price="1.5" value="Unt"  required>
                                                                        <label class="form-check-label" for="c1">Unt</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="umpl" price="2.5" value="Ciocolată neagră"  required>
                                                                        <label class="form-check-label" for="c1">Ciocolată neagră</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="umpl" price="2.5" value="Ciocolată cu vanilie"  required>
                                                                        <label class="form-check-label" for="c1">Ciocolată cu vanilie</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="umpl" price="3" value="Caramelă"  required>
                                                                        <label class="form-check-label" for="c1">Caramelă</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="umpl" price="3.5" value="Nutella"  required>
                                                                        <label class="form-check-label" for="c1">Nutella</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="umpl" price="3" value="Mix (ciocolată neagră și de vanilie)"  required/>
                                                                        <label class="form-check-label" for="c1">Mix (ciocolată neagră și de vanilie)</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="umpl" id="c1" price="2.5" value="Gem fructe"  required>
                                                                        <label class="form-check-label" for="c1">Gem fructe</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="umpl" id="c1" price="1" value="Clasic"  required>
                                                                        <label class="form-check-label" for="c1">Clasic</label>
                                                                    </div>                                 
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Glazură</label>  
                                                                <div class="display d-flex"> 
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="glazura" price="1.5" value="Ciocolată neagră"  required>
                                                                        <label class="form-check-label" for="c1">Ciocolată neagră</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="glazura" price="1.5" value="Ciocolată cu vanilie"  required>
                                                                        <label class="form-check-label" for="c1">Ciocolată cu vanilie</label>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Pe strat exterior</label>  
                                                                <div class="display d-flex"> 
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="ex" price="1.5" value="Alune de migdale"  required>
                                                                        <label class="form-check-label" for="c1">Alune demigdale</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="ex" price="1.5" value="Nucă"  required>
                                                                        <label class="form-check-label" for="c1">Nucă</label>
                                                                    </div>
                                                                    <div class="form-check" style="margin-right: 10px;">
                                                                        <input class="form-check-input"  type="radio" name="ex" price="1.5" value="Mac"  required>
                                                                        <label class="form-check-label" for="c1">Mac</label>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>  
                                                        <div class="form-group">
                                                            <label>Auxiliar</label>  
                                                            <input type="text" class="form-control" name="auxiliar" placeholder="Adaugă ceva personalizat">
                                                        </div>                     
                                                        <div class="form-group d-flex">
                                                            <dl class="dlist-inline" style="padding-right:15px;">
                                                                <dt>Preț compoziție: </dt>	
                                                                <dd> 														
                                                                    <input id="totalC" type="text" id="price_croissant" name="price" class="form-control form-control-sm" value="0.00" style="width:70px;" readonly>                                    
                                                                </dd>	
                                                                <p style="display:inline;">lei</p>																				
                                                            </dl>  <!-- item-property .// -->	
                                                        </div>
                                                        <div class="form-group d-flex">
                                                            <dl class="dlist-inline" style="padding-right:15px;">
                                                                <dt>Bucăți: </dt>	
                                                                <dd> 														
                                                                <select id="qtyC" name="qty" class="form-control form-control-sm" style="width:70px;">
                                                                    <option> 1 </option>
                                                                    <option> 2 </option>
                                                                    <option> 3 </option>
                                                                    <option> 4 </option>
                                                                    <option> 5 </option>
                                                                    <option> 6 </option>							
                                                                </select> 
                                                                </dd>					                         															
                                                            </dl>  <!-- item-property .// -->	
                                                    
                                                            <dl class="dlist-inline" style="padding-right:15px;">
                                                                <dt>Gramaj: </dt>	
                                                                <dd> 														
                                                                <select name="gramaj" class="form-control form-control-sm" style="width:70px;">
                                                                    <option> 0.2 </option>                                           	                        						
                                                                </select> 
                                                                </dd>					
                                                                <p style="display:inline;">kg</p>															
                                                            </dl>  <!-- item-property .// -->	

                                                            <dl class="dlist-inline" style="padding-right:15px;">
                                                                <dt>Preț: </dt>	
                                                                <dd> 														
                                                                    <input type="text" id="priceC" name="price" class="form-control form-control-sm" value="{{3.90}}" price="3.9" price2="" style="width:70px;" readonly>                                    
                                                                    <input id="pretUnitarCro" name="pretUnitarCro" type="hidden" value=""/>
                                                                </dd>	
                                                                <p style="display:inline;">lei</p>																				
                                                            </dl>  <!-- item-property .// -->	
                                                        </div>
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6">
                                                                <button id="submit" type="submit" title="Comanda poate fi creată la procurarea mai mult de 5 unități de produs" class="btn btn-primary">
                                                                    Trimite spre validare
                                                                </button>
                                                            </div>
                                                        </div>                                                        
                                                        </form>                                                       
                                                    </div>    
                                            </div>  
                                        </div>
                                                       

                </div> <!-- card.// -->
            </main> <!-- col.// -->
        </div> <!--  row// -->
    </div> <!-- container .//  -->
</section>
@endsection