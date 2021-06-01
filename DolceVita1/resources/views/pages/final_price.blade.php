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
    @if($content->count())
        <div class="card  p-2">
        <table class="table-responsive table-hover shopping-cart-wrap p-1">
        <thead class="text-muted">
        <tr>
        <th scope="col" class="text-center" style="width:150px;">Denumire</th>
        <th scope="col" class="text-center"style="width:150px;">Materii prime</th>
        <th scope="col" class="text-center" style="width:150px;">Cheltuieli cu salariații</th>
        <th scope="col" class="text-center" style="width:150px;">CAS</th>
        <th scope="col" class="text-center" style="width:150px;">Cheltuieli indirecte</th>
        <th scope="col" class="text-center" style="width:150px;">Preț net</th>
        <th scope="col" class="text-center" style="width:150px;">Adaos</th>
        <th scope="col" class="text-center" style="width:150px;">Preț de comerț</th>
        </tr>
        </thead>
        <tbody>
        @foreach($content as $data)   
        <tr>
            <td class="text-center">               
               <h6> {{$data->id_reteta}}</h6>            
            </td>
            <td class="text-center">
            <div class="price-wrap">
                    <var class="price">{{returnPriceFormat($data->pret_mat)}}</var>
                </div> 
            </td>  
            <td class="text-center">
                <div class="price-wrap">
                    <var class="price">{{returnPriceFormat($data->c_salarii)}}</var>
                </div>          
            </td> 
            <td>
                <div class="price-wrap">
                    <var class="price">{{returnPriceFormat($data->CAS)}}</var>
                </div>        
            </td>
            <td class="text-center">
                <div class="price-wrap">
                    <var class="price">{{returnPriceFormat($data->c_indirecte)}}</var>
                </div> 
            </td>   
            <td class="text-center">
                <div class="price-wrap">
                    <var class="price">{{returnPriceFormat($data->pret_net)}}</var>
                </div>      
            </td>  
            <td class="text-center">
                <div class="price-wrap">
                    <var class="price">{{returnPriceFormat($data->adaos)}}</var>
                </div>      
            </td>  
            <td class="text-center">
                <div class="price-wrap">
                    <var class="price">{{returnPriceFormat($data->pret_final)}}</var>
                </div>      
            </td>  
        </tr>    
        @endforeach 
        </tbody>
        </table>
        </div> <!-- card.// -->
        @else
            <div class="alert-success">
                <div class="alert alert-success alert-block">
                     <strong>Nu există produse !</strong>
                 </div>
            </div>
        @endif
    </main> <!-- col.// -->
    </div>

    </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->
@endsection
