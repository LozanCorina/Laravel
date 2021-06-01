<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $best=Product::from('products as p')
        ->join('order_product  as o','p.id','=','o.product_id')
        ->select('p.*')
        ->join('categories as c','c.id','=','p.id_cat')
        ->where('c.id','<>',7)      
        ->get();
        foreach($best as $product)
        {
            Product::where(['id'=>$product->id,'promo'=>1])->update(['promo'=>0]); //update promo for products
        }
        //afisarea de promotii pentru saptaman X
      
        if(now() == date_format(date_create("2021-05-31"),'Y-m-d') )
       {
            $promo=Product::inRandomOrder()
            ->where('id_cat','<>',7)
            ->whereNotIn('id',$best)
            ->take(10)
            ->get();
            foreach($promo as $product)
            {
                Product::where('id',$product->id)->update(['promo'=>1]); //update promo for products
            }
       }
       else{
        $promo=Product::inRandomOrder()
        ->where('id_cat','<>',7)
        ->where('promo',1)
        ->take(10)
        ->get();
       }
        
        
        //update raffles dates
        updateRafflesStatus();
        updateDeliveryStatus();

        $result=Product::inRandomOrder()
        ->where('id_cat','<>',7)
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();

        return view('acasa', ['results'=>$result,
        'promo'=>$promo,
        ]);
    }

}
