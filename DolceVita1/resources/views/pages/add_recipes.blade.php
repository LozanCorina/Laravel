@extends('layouts.main')
<script>
function exist(){
    document.getElementById('f_add').style.display = "none";
    document.getElementById('f_new').style.display = "none";
    document.getElementById('f_ex').style.display = "block";
}
function newForm(){
    document.getElementById('f_add').style.display = "none";
    document.getElementById('f_ex').style.display = "none";
    document.getElementById('f_new').style.display = "block";
}

function addMat(){
    document.getElementById('f_ex').style.display = "none";
    document.getElementById('f_new').style.display = "none";
    document.getElementById('f_add').style.display = "block";
}
</script>



<!-- ========================= SECTION CONTENT ========================= -->
@section('content')
<section class="section-content bg padding-y">
<div class="d-flex justify-content-center ">
<div class="container col-xl-4 col-sm-12">
    <div class="card">
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
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-block" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{$message}}</strong>
            </div>
        </div>
    </div>
    @endif
    <header class="card-header">      
        <h4 class="card-title mt-2">Secțiunea rețete</h4>
    </header>
    <article class="card-body">
    <!-- buttons check -->
    <div class="form-row">
        <div class="form-group" style="padding-right:20px;">
            <button id="ex" type="button" class="btn btn-primary btn-block" onclick="exist()"  style="width:180px;">Rețetă existentă </button>           
        </div> <!-- form-group// -->
        <div class="form-group">
            <button id="new" type="button" class="btn btn-primary btn-block"  onclick="newForm()"  style="width:180px;">Nouă rețetă </button>
        </div>
    </div>
    <form id="f_ex" method="POST" action="{{ route('store.recipe') }}" style="display:none;">
				@csrf
                <input type="hidden" name="action" value="r_existenta">
        <div class="form-row">
            <div class="form-group">         
                <label>Selecteaza rețeta</label>
                <select class="form-control" name="recipe_id" style="width:390px;" required>               
                <!-- foreach -->-
                @foreach($recipes as $ret)                   
                    <option value="{{$ret->id_reteta}}">{{$ret->id_reteta}}</option>                 
                @endforeach
                </select>     
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->        
        <div class="form-row">
            <div class="form-group">         
                <label>Materie primă</label>
                <select class="form-control" name="materie" style="width:390px;" required>                    
                    <!-- foreach -->
                    @foreach($materie as $mat)
                        <option value="{{$mat->id}}">{{$mat->denumire}}</option>
                    @endforeach
                    </select>  
                    <small id="add_mat" onclick="addMat()">Nu există materia primă? <b>Click aici</b> pentru a adăuga</small>      
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-row">
            <div class="form-group">         
                <label>Gramaj</label>
                <input type="number" class="form-control" name="gramaj" min="0" max="999.99" step=".001" style="width:390px;" required>
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-group">
            <button type="submit" onClick="this.form.submit(); this.disabled=true;" class="btn btn-primary btn-block">Adaugă   </button>
        </div> <!-- form-group// -->
    </form>
    <form id="f_new" method="POST" action="{{ route('store.recipe') }}"  style="display:none;">
				@csrf
            <input type="hidden" name="action" value="r_noua">
        <div class="form-row">
            <div class="form-group">         
                <label>Crează denumirea/id rețeta</label>
                <input type="text" class="form-control" name="recipe_id" style="width:390px;" required>               
                <!-- foreach -->                           
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-row">
            <div class="form-group">         
                <label>Categorie</label>
                <select class="form-control" name="categorie" style="width:390px;" required>               
                <!-- foreach -->
                @foreach($category as $cat)
                    @if($cat->id!= 7)
                    <option value="{{$cat->id}}">{{$cat->descriere}}</option>
                    @endif
                @endforeach
                </select>     
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-row">
            <div class="form-group">         
                <label>Materie primă</label>
                <select class="form-control" name="materie" style="width:390px;" required>                    
                    <!-- foreach -->
                    @foreach($materie as $mat)
                        <option value="{{$mat->id}}">{{$mat->denumire}}</option>
                    @endforeach
                    </select> 
                    <small id="add_mat" onclick="addMat()">Nu există materia primă? <b>Click aici</b> pentru a adăuga</small>   
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-row">
            <div class="form-group">         
                <label>Gramaj</label>
                <input type="number" class="form-control" name="gramaj" min="0" max="999.99" step=".001" style="width:390px;" required>
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-group">
            <button type="submit" onClick="this.form.submit(); this.disabled=true;" class="btn btn-primary btn-block">Adaugă   </button>
        </div> <!-- form-group// -->
    </form>
    <form id="f_add" method="POST" action="{{ route('store.recipe') }}"  style="display:none;">
				@csrf
            <input type="hidden" name="action" value="mat_prima">
        <div class="form-row">
            <div class="form-group">         
                <label>Denumirea materie primă</label>
                <input type="text" class="form-control" name="denumire" style="width:390px;" required>               
                <!-- foreach -->                           
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-row">
            <div class="form-group">         
                <label>Unitatea de măsură</label>
                <select class="form-control" name="um" style="width:390px;" required>                                            
                    <option>kg</option>
                    <option>buc</option>  
                    <option>litru</option> 
                </select>     
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-row">
            <div class="form-group">         
                <label>Gramaj</label>
                <input type="number" class="form-control" name="gramaj" min="0" max="999.99" step=".001" style="width:390px;" required>
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-row">
            <div class="form-group">         
                <label>Preț</label>
                <input type="number" class="form-control" name="pret" min="0" max="999.99" step=".001" style="width:390px;" required>
            </div> <!-- form-group.// -->
        </div> <!-- form-row.// -->
        <div class="form-group">
            <button type="submit" onClick="this.form.submit(); this.disabled=true;" class="btn btn-primary btn-block">Adaugă   </button>
        </div> <!-- form-group// -->
    </form>
    </article> <!-- card-body end .// -->
    </div> <!-- card.// -->
	</div> <!-- container-->
</div>
</section>
    <!-- ========================= SECTION  END// ========================= -->
@endsection
