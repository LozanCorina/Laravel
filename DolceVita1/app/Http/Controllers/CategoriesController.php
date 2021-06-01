<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
   
  public function Category(){
    

    if(request()->categorie)
    {
       $category=Category::where('descriere',request()->categorie)->first();
       if($category!=[]){
        $products=Product:: where('id_cat', '=', $category->id)
        ->orderBy('created_at', 'DESC')
        ->orderBy('updated_at','DESC')
        ->paginate(12);
        $p_Min=Product::min('pret');
        $p_Max=Product::max('pret');
       }else
       {
         abort(404,'Pagina nu a fost gasita');
       }
      
    }
    $best=Product::from('products as p')
          ->join('order_product  as o','p.id','=','o.product_id')
          ->select('p.*')
          ->join('categories as c','c.id','=','p.id_cat')
          ->where('c.id','<>',7)
          ->whereDate('o.created_at','<=',now())
          ->whereDate('o.created_at', '>=',now()->subDays(30))
          ->get();
          foreach($best as $product)
          {
            Product::where(['id'=>$product->id,'promo'=>1])->update(['promo'=>0]); //update promo for products
          }

    $totalData=$products->count();
    $priceMin="Min";
    $priceMax="Max";
    $compozit="Compoziție";
    $filterBy="-";
    return view('pages.categories.categories',['category'=>$category,
    'products'=>$products,
    'priceMax'=> $priceMax,
    'priceMin'=> $priceMin,
    'p_Min'=>$p_Min,
    'p_Max'=>$p_Max,
    'best'=>$best,
    'total'=>$totalData,
    'compozit'=>$compozit,
    'filterBy'=>$filterBy,
    ]);
   }


   public function filter(Request $request)
  {   
    if(empty($request->priceMin))
    {
     $priceMin=Product::min('pret');
     
    }
    else{
     $priceMin=$request->priceMin;  
    }

    if(empty($request->priceMax))
    {
     $priceMax=Product::max('pret');
     
    }else{
     $priceMax=$request->priceMax;   
    }
   $category=Category::where('descriere',$request->categorie)->first();

    if($request->compozit !='Compoziție' && $request->filterBy !='-')
    {
      if($request->filterBy == 'Top vânzări')
      {
        $products=Product::from('products as p')
        ->join('order_product  as o','p.id','=','o.product_id')
        ->select('p.*')
        ->distinct()
        ->join('categories as c','c.id','=','p.id_cat')
        ->where('c.id','=',$category->id)
        ->where('p.pret','>=',$priceMin)
        ->where('p.pret','<=',$priceMax)
        ->where('p.nume','like','%'.$request->compozit.'%')
        ->where('p.descriere','like','%'.$request->compozit.'%')
        ->whereDate('o.created_at','<=',now())
        ->whereDate('o.created_at', '>=',now()->subDays(60))
        ->paginate(12);
        
      }
      else if($request->filterBy == 'Cele mai ieftine')
      {
        $products=Product:: where('id_cat', '=', $category->id)
        ->where('nume','like','%'.$request->compozit.'%')
        ->where('descriere','like','%'.$request->compozit.'%')
        ->where('pret','>=',$priceMin)
        ->where('pret','<=',$priceMax)
        ->orderBy('pret','asc')
        ->paginate(12);
        
      }
      else if($request->filterBy == 'Cele mai scumpe')
      {
        $products=Product:: where('id_cat', '=', $category->id)
        ->where('nume','like','%'.$request->compozit.'%')
        ->where('descriere','like','%'.$request->compozit.'%')
        ->where('pret','>=',$priceMin)
        ->where('pret','<=',$priceMax)
        ->orderBy('pret','desc')
        ->paginate(12);
        
      }
      else if($request->filterBy == 'Noi apărute')
      {
        $products=Product:: where('id_cat', '=', $category->id)
        ->where('nume','like','%'.$request->compozit.'%')
        ->where('descriere','like','%'.$request->compozit.'%')
        ->where('pret','>=',$priceMin)
        ->where('pret','<=',$priceMax)
        ->orderBy('created_at', 'DESC')
        ->orderBy('updated_at','DESC')
        ->paginate(12);
        
      }
      else if($request->filterBy == 'Top recenzii')
      {
        $products=Product::from('products as p')
        ->join('comments  as c','p.id','=','c.commentable_id')
        ->select('p.*')
        ->distinct()
        ->join('categories as ca','ca.id','=','p.id_cat')
        ->where('ca.id','=',$category->id)
        ->where('p.pret','>=',$priceMin)
        ->where('p.pret','<=',$priceMax)
        ->where('p.nume','like','%'.$request->compozit.'%')
        ->where('p.descriere','like','%'.$request->compozit.'%')
        ->paginate(12);
      }

    }
    else if($request->filterBy !='-')
    {
      if($request->filterBy == 'Top vânzări')
      {
        $products=Product::from('products as p')
        ->join('order_product  as o','p.id','=','o.product_id')
        ->select('p.*')
        ->distinct()
        ->join('categories as c','c.id','=','p.id_cat')
        ->where('c.id','=',$category->id)
        ->where('p.pret','>=',$priceMin)
        ->where('p.pret','<=',$priceMax)
        ->whereDate('o.created_at','<=',now())
        ->whereDate('o.created_at', '>=',now()->subDays(60))
        ->paginate(12);
        
      }
      else if($request->filterBy == 'Cele mai ieftine')
      {
        $products=Product:: where('id_cat', '=', $category->id)
        ->where('pret','>=',$priceMin)
        ->where('pret','<=',$priceMax)
        ->orderBy('pret','asc')
        ->paginate(12);
       
      }
      else if($request->filterBy == 'Cele mai scumpe')
      {
        $products=Product:: where('id_cat', '=', $category->id)
        ->where('pret','>=',$priceMin)
        ->where('pret','<=',$priceMax)
        ->orderBy('pret','desc')
        ->paginate(12);
        
      }
      else if($request->filterBy == 'Noi apărute')
      {
        $products=Product:: where('id_cat', '=', $category->id)
        ->where('pret','>=',$priceMin)
        ->where('pret','<=',$priceMax)
        ->orderBy('created_at', 'DESC')
        ->orderBy('updated_at','DESC')
        ->paginate(12);
        
      }
      else if($request->filterBy == 'Top recenzii')
      {
        $products=Product::from('products as p')
        ->join('comments  as c','p.id','=','c.commentable_id')
        ->select('p.*')
        ->distinct()
        ->join('categories as ca','ca.id','=','p.id_cat')
        ->where('ca.id','=',$category->id)
        ->where('p.pret','>=',$priceMin)
        ->where('p.pret','<=',$priceMax)
        ->paginate(12);
      }
    }
    else if($request->compozit !='Compoziție' )
    {
      $products=Product:: where('id_cat', '=', $category->id)
        ->where('pret','>=',$priceMin)
        ->Where('pret','<=',$priceMax)
        ->orderBy('pret','asc')
        ->paginate(12);
      
    }
    else if($priceMin && !empty($priceMin) or $priceMax && !empty($priceMax))
    {
      $products=Product:: where('id_cat', '=', $category->id)
      ->where('pret','>=',$priceMin)
      ->where('pret','<=',$priceMax)
      ->orderBy('pret','asc')
      ->paginate(12);
     
    }
    else{
      $products=Product:: where('id_cat', '=', $category->id)
        ->orderBy('created_at', 'DESC')
        ->orderBy('updated_at','DESC')
        ->paginate(12);
       
    }

    $best=Product::from('products as p')
    ->join('order_product  as o','p.id','=','o.product_id')
    ->select('p.*')
    ->join('categories as c','c.id','=','p.id_cat')
    ->where('c.id','<>',7)
    ->whereDate('o.created_at','<=',now())
    ->whereDate('o.created_at', '>=',now()->subDays(30))
    ->get();
//echo $request->filterBy;
    $p_Min=Product::min('pret');
    $p_Max=Product::max('pret');
   $totalData=$products->count();
   //return Min/Max ifis not selected
   if(empty($request->priceMin))
    {
     $priceMin='Min';
     
    }
    if(empty($request->priceMax)){
      $priceMax='Max';
    }


    return view('pages.categories.categories',['category'=>$category,
   'products'=>$products,
   'priceMax'=> $priceMax,
   'priceMin'=> $priceMin,
   'p_Min'=>$p_Min,
   'p_Max'=>$p_Max,
   'best'=>$best,
   'total'=>$totalData,
   'compozit'=>$request->compozit,
   'filterBy'=>$request->filterBy,
   ]);
  }
}
