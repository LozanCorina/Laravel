<?php
 function returnPriceFormat($price){
    return number_format($price, 2).' Lei';
}
function returnPricePromo($price){
    return number_format($price-$price*0.05, 2).' Lei';
}

function pricePromo($price){
    return ($price-$price*0.05); //promoted price without price format
}

function returnCityValue($val){
    $cityName='';
    $districts=DB::table('districts')->get();
    foreach($districts as $district){
        if($val == $district->pret_livrare)
        {
            $cityName=$district->judet;
        }
       
    }
    return $cityName;
}
function updateDeliveryStatus(){
    DB::table('orders')
              ->where('delivery_date','<=', now())
              ->update(['order_status'=>'livrat']);
}

function materialPrice($val)
{
    $material=DB::table('materie_prima')->get();
    foreach($material as $mat){
        if($val == $mat->id)
        {
            $pret=$mat->pret;
        }
       
    }
    return $pret;

}
function categorieId($val)
{
    $cat=0;
    $data=App\Models\Recipe::all();
    foreach($data as $categorie){
        if($val == $categorie->id_reteta)
        {
            $cat=$categorie->categorie_id;
        }
       
    }
    return $cat;
}


function updateRafflesStatus()
{          
    App\Models\Raffle::where('date_end','<',now())->update(['status'=>0]);
}