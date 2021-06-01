<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Stock;
use App\Models\Cart;
use App\Models\PersonalOrder;
use App\Models\Characteristic;
use  Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $data=User::find(auth()->id());
        $ordersItems=$data->orders->count();
        $reducere=0;
        $finalPrice=0;
        $items=DB::table('cart')
        ->where('user_id',auth()->id())->get();  

        $countData=PersonalOrder::where('ordered','0')->where('user_id',auth()->id())->count();
        $totalPriceItems=DB::table('cart')->where('user_id',auth()->id())->sum('totalprice');
        $pricePersonalProducts=PersonalOrder::where('ordered','0')->where('user_id',auth()->id())->sum('totalprice');
        $totalPrice=$pricePersonalProducts+$totalPriceItems;
        
        if($totalPrice>1800)
        {
            $reducere=($totalPrice*0.05);
        }
        $finalPrice=$totalPrice-$reducere;
        
        return view('pages.cos',['products'=>$data,
        'items'=>$items,
        'totalPrice'=>$totalPrice,  
        'reducere'=>$reducere,
        'finalPrice'=> $finalPrice,
        'orders'=>$ordersItems,
        'countData'=> $countData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {          
        $prod_id= $request->prod_id;                    
        $product= Product::find($prod_id);
     
        if($product->categories->id == 4 or $product->categories->id== 5 or $product->categories->id == 1)
        {
            if($product->promo == 1)
            {
                $pret=pricePromo($product->pret);
                $product_price=request('quantity')*request('gramaj')*$pret; //calculate price with promo
            }else{
                $pret=$product->pret;
                $product_price=request('quantity')*request('gramaj')*$pret;
            }
            
        }
        else
        {    if($product->promo == 1)
            {
                $pret=pricePromo($product->pret);
                $product_price=request('quantity')*$pret;//calculate price with promo
            } 
            else{
                $pret=$product->pret;
                $product_price=request('quantity')*$pret;
            }    
           
        }     

        DB::table('cart')->updateOrInsert(
            ['user_id'=>auth()->id(), 'product_id'=>$prod_id,'weight'=>request('gramaj'),
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(), ], 
            ['qty'=>request('quantity'), 'weight'=>request('gramaj'),'price'=>$pret,'totalprice'=>$product_price, 
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(), ]);

      return back()->with('success_message','Produsul a fost adăugat în coș!');
        

    }
    public function favoriteCart($prod_id)
    {
        $data=DB::table('product_user')
        ->where([
            ['product_id',$prod_id],
            ['user_id',auth()->id()]
            ])->get();    

            if($data->isNotEmpty())           
            {
               DB::table('product_user')->where('product_id',$prod_id)->delete(); 
                            
            }                     
      
       return back()->with('success_message','Produsul a fost adăugat în coș!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      

        $cart=Cart::find($id);    
        $product= Product::find($cart->product_id);

        if($product->categories->id == 4 or $product->categories->id== 5 or $product->categories->id == 1)
        {
            $this->validate($request,['quantity'=>'required|min:1|max:10','gramaj'=>'required|min:0.2|max:10']);
            
            $product_price=request('quantity')*request('gramaj')*$cart->price;
  
        }
        else
        {    
            $this->validate($request,['quantity'=>'required|min:1|max:10']);
            $product_price=request('quantity')*$cart->price;                     
        }       

           DB::table('cart')->where('id',$id)
           ->update(['weight'=>request('gramaj'),'qty'=>request('quantity'),'totalprice'=> $product_price]);

        return redirect()->route('cos.index')->with('success_message','Produsul a fost modificat!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $cart=Cart::find($id);
        $product=Product::find($cart['product_id']);

        if($product->id_cat == 7)
        {
            //increment stock auxiliar
            Stock::where('product_id',$product->id)->increment('qty',request('quantity'));    
          
        }        
        DB::table('cart')
        ->where([
            ['id',$id],
            ['user_id',auth()->id()]
            ])->delete();    

       return redirect()->route('cos.index')->with('success_message','Produsul a fost șters!');
    }
   
}
