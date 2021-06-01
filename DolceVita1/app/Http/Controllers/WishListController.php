<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class WishListController extends Controller
{
    public function wishList($id)
    {       
        $item=DB::table('cart')->where(['user_id'=>auth()->id(),'product_id'=>$id])->get();
      

        if($item->isNotEmpty())
        {          
            DB::table('cart')->where(['user_id'=>auth()->id(),'product_id'=>$id])->delete();
        }

        $dublicates=DB::table('product_user')->where(['user_id'=>auth()->id(),'product_id'=>$id])->get();
        if($dublicates->isNotEmpty())
        {
            return back()->with('success_message','Produsul deja există în lista Favorite!');
        }else
        {
            DB::table('product_user')->updateOrInsert(['user_id' => auth()->id(),'product_id' => $id],);
        
            return back()->with('success_message','Produsul a fost adăugat în lista Favorite!');
        }
       
    }


    public function show()
    {      
        $data=User::find(auth()->id());
       
        // foreach($data->products as $product){          
        //     echo $product->pivot->product_id;
        //     echo $product->categories->descriere;
        // }
      
        return view('pages.favorites',['data'=>$data]);
    }
    public function destroy($prod_id){
        
        $data=DB::table('product_user')
        ->where([
            ['product_id',$prod_id],
            ['user_id',auth()->id()]
            ])->get();    

            if($data->isNotEmpty())           
            {
               DB::table('product_user')->where('product_id',$prod_id)->delete(); 
                         
            }                        
        return  back()->with('success_message','Produsul a fost șters din lista Favorite!');

    }
}
