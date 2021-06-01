<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\PersonalRecipe;
use Illuminate\Support\Facades\File;
use PDF;
use App\Models\PersonalOrder;
use App\Models\CategoryRecipe;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Characteristic;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;

class PersonalOrderController extends Controller
{
    public function index(){
        $category=Category::all();

       return view('pages.recipe',['categorie'=>$category]);
    }  
    public function Test(){   
        $categories=Category::all();   
        $products=CategoryRecipe::all();
        $recipes=Recipe::all();
        $char=Characteristic::all();
        
        // foreach($prod_cat as $product)
        // {
        //     foreach($char as $ch)
        //     {
        //         foreach($recipes as $recipe)
        //         {
        //             if($product->category_id==$recipe->category_recipe_id and $recipe->characteristic_id==$ch->id)
        //             {
        //                 $product_name=Category::find($product->category_id);
        //                 echo $product_name->descriere.' '.$ch->characteristic.' '.$recipe->value.' '.$recipe->price.'<br>' ;
        //                 echo '---------------------------'.'<br>';
        //             }
 
        //         }
        //     }            
        // }


        //$products=array(1,2,4,6);
        // foreach($prod_cat as $prod_id)
        // {
        //     echo  $prod_id->name.'<br>';               
        //     foreach($prod_id->recipes as $ch)
        //     {   
        //         foreach($ch as $c)
        //         {           
        //             if($loop->first)
        //             {
        //                 echo $ch->characteristic.'<br>--------';
        //             }
                    
        //             echo $ch->pivot->value.''.$ch->pivot->price.'<br>';         
        //         }
                    
        //     }
        //     echo '<br>--------';
               
        // }

        // }
        // foreach($prod_cat as $prod_id)
        // {
        //   echo  $prod_id->name.'<br>';
        //   $ch=Characteristic::find($prod_id->recipes);
        //   foreach($ch as $c)
        //   {
        //      echo $c->characteristic.'<br>';
        //      foreach($c->recipes as $recipes)
        //      {
        //         echo $recipes->pivot->value.''.$recipes->pivot->price.'<br>';
        //      }
        //   }
        //  // echo $ch->characteristic.'<br>--------';
        // //   foreach($prod_id->recipes as $ch)
        // //   {
        // //    // echo $ch->characteristic.'<br>--------';
        // //     echo $ch->pivot->value.''.$ch->pivot->price.'<br>';
        // //   }
        // }

       return view('pages.recipe_test',compact(['products','categories']));
    }

    public function update($id){

        $product=PersonalOrder::find($id);     

        if($product->categorie_id == 4 or  $product->categorie_id == 1)
        {
            $product_price=request('quantity')*request('gramaj')*$product->price;
        }
        else
        {          
            $product_price=request('quantity')*$product->price;
        }      
 
        PersonalOrder::where('id',$id)
           ->update(['weight'=>request('gramaj'),'qty'=>request('quantity'),'totalprice'=> $product_price]);

        return redirect()->route('cos.index')->with('success_message','Produsul a fost modificat!');

    }
    public function destroy($id){

        //first delete from child tlb     
       DB::table('recipe')->where('personal_order_id',$id)->delete();
        //after parrent 
       PersonalOrder::where('id',$id)->delete();    


        return redirect()->route('cos.index')->with('success_message','Produsul a fost șters!');
    }
    
    public function store(Request $request){
        if(is_null($request->result))
        {
            return redirect()->route('recipe')->with('success_message','Trimitere eșuată!');;
        }
         else
        {
            $val=$request->result;
            echo $val;
            switch($val){
            case 'ciocolată':
                $data=array(
                    'client'=>$request->client,
                    'mail'=>$request->mail,
                    'product'=>'Ciocolată',
                    'categorie_id'=>$request->categorie_id,
                    'date'=>date_format(now(),'Y-m-d'),
                    'tip'=>$request->input('tip_ciocolata'), 
                    'supliment'=>implode(', ',$request->input('supliment')),
                    'auxiliar'=>$request->auxiliar,
                    'qty'=>$request->qty,
                    'weight'=>$request->gramaj,
                    'price'=>$request->price,
                    'pretUnitar'=>$request->pretUnitarCio,
                );               
                $personalOrder=$this->insertBDCiocolata($data);
                $this->convertPDF($data,$personalOrder); 
                break;
            case  'macarons':
                $data=array(
                    'client'=>$request->client,
                    'mail'=>$request->mail,
                    'product'=>'Macarons',
                    'categorie_id'=>4,
                    'date'=>date_format(now(),'Y-m-d'),
                    'culoare'=>$request->culoare,
                    'crema'=>$request->crema,
                    'decor'=>$request->decor,
                    'auxiliar'=>$request->auxiliar,
                    'qty'=>$request->qty,
                    'weight'=>$request->gramaj,
                    'price'=>$request->price,
                    'pretUnitar'=>$request->pretUnitarMa,
                );
                $personalOrder=$this->insertBDMacaron($data);
                $this->convertPDF($data,$personalOrder); 
                break;
            case  'torturi':
                $data=array(
                    'client'=>$request->client,
                    'mail'=>$request->mail,
                    'product'=>'Tort',
                    'categorie_id'=>1,
                    'date'=>date_format(now(),'Y-m-d'),
                    'umplutura'=>$request->umplutura,
                    'supliment'=>implode(', ',$request->input('supliment')),
                    'decor'=>$request->decor,
                    'auxiliar'=>$request->decor_p,
                    'qty'=>$request->qty,
                    'weight'=>$request->gramaj,
                    'price'=>$request->price,
                    'pretUnitar'=>$request->pretUnitarTort,
                );
                $personalOrder=$this->insertBDTort($data);
                $this->convertPDF($data,$personalOrder); 
                break;
            case  'croissant':
                $data=array(
                    'client'=>$request->client,
                    'mail'=>$request->mail,
                    'product'=>'Croissant',
                    'categorie_id'=>6,
                    'date'=>date_format(now(),'Y-m-d'),
                    'umplutura'=>$request->umplutura,
                    'exterior'=>$request->ex,
                    'glazura'=>$request->glazura,
                    'auxiliar'=>$request->auxiliar,
                    'qty'=>$request->qty,
                    'weight'=>$request->gramaj,
                    'price'=>$request->price,
                    'pretUnitar'=>$request->pretUnitarCro,
                );
                $personalOrder=$this->insertBDCroissant($data);
                $this->convertPDF($data,$personalOrder);  
                break;
            }
        }
 
        return redirect()->route('recipe')->with('success_message','Rețeta a fost trimisă spre validare!');
    }  
    public function insertBDCiocolata($data)
    {

        $po=PersonalOrder::create([
            'categorie_id'=> $data['categorie_id'],
            'user_id'=>auth()->id(),
            'qty'=> $data['qty'],
            'weight'=>$data['weight'],
            'price'=>$data['pretUnitar'],
            'totalprice'=>$data['price'],
        ]);
            //should be foreach
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>7,
            'value'=>$data['tip'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>3,
            'value'=>$data['supliment'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>6,
            'value'=>$data['auxiliar'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        return $po->id;
    }

    public function insertBDMacaron($data)
    {

        $po=PersonalOrder::create([
            'categorie_id'=> $data['categorie_id'],
            'user_id'=>auth()->id(),
            'qty'=> $data['qty'],
            'weight'=>$data['weight'],
            'price'=>$data['pretUnitar'],
            'totalprice'=>$data['price'],
        ]);
            //should be foreach
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>8,
            'value'=>$data['culoare'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>9,
            'value'=>$data['crema'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>4,
            'value'=>$data['decor'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>6,
            'value'=>$data['auxiliar'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        return $po->id;
    }
    public function insertBDTort($data)
    {

        $po=PersonalOrder::create([
            'categorie_id'=> $data['categorie_id'],
            'user_id'=>auth()->id(),
            'qty'=> $data['qty'],
            'weight'=>$data['weight'],
            'price'=>$data['pretUnitar'],
            'totalprice'=>$data['price'],
        ]);
            //should be foreach
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>2,
            'value'=>$data['umplutura'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>3,
            'value'=>$data['supliment'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>4,
            'value'=>$data['decor'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>6,
            'value'=>$data['auxiliar'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        return $po->id;
    }
    public function insertBDCroissant($data)
    {

        $po=PersonalOrder::create([
            'categorie_id'=> $data['categorie_id'],
            'user_id'=>auth()->id(),
            'qty'=> $data['qty'],
            'weight'=>$data['weight'],
            'price'=>$data['pretUnitar'], 
            'totalprice'=>$data['price'],
        ]);
            //should be foreach
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>2,
            'value'=>$data['umplutura'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>11,
            'value'=>$data['exterior'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>10,
            'value'=>$data['glazura'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        DB::table('recipe')->insert([
            'personal_order_id'=>$po->id,
            'characteristic_id'=>6,
            'value'=>$data['auxiliar'],
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        return $po->id;
    }
    public function convertPDF($data,$po)
    {
        $product=PersonalOrder::find($po);
        $filename = 'Recipe_'. auth()->user()->name. '.pdf';
        $pdf = \App::make('dompdf.wrapper');
        $output='<!DOCTYPE html>
            <html lang="ro">         
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="robots" content="noindex">     
            <title>Rețetă</title>  

            <style>
                 *{ font-family: DejaVu Sans; font-size: 12px;}
                
                .w{
                    width: 100%;
                    margin-bottom: 20px;
                    margin-top: 50px;
                }
                .l{
                    float: left;
                }
                .r{
                    float: right;
                }
                .bcn{
                    background-color:#b8b894
                }
                .bcp{
                    text-align:center; background-color:  MistyRose
                }
            </style>
        
        </head>
        <body class="login-page" style="background: white">
        
        <h3>Rețetă personalizată DolceVita</h3>
                    <strong>DolceVita SRL</strong>
                    <small> <p>infoDolceVita@gmail.com| saleDolceVita@gmail.com
                        <br> Bucure&#351;ti, 8003655 Rom&#226;nia | + 40 075887324</p>
                    </small>
                    </header>
                        <h4>Rețeta pentru &nbsp;'.$data['product'].'</h4>
                        <br>
                            <table class="w">
                                <tr>
                                    <td class="l">
                                        <p>Data creare: '.$data['date'].'</p>
                                    </td>
                                    <td class="r">
                                        <p>Clientul: '.$data['client'].'
                                            <br>
                                            Email: '.$data['mail'].'
                                        </p>
                                    </td>
                                </tr>
                                </table>
                                <table  class="w">
                                    <thead class="bcn"> 
                                        <tr>                                  
                                            <th  scope="col"> Structura:
                                            </th>
                                            <th  scope="col"> Compoziția:
                                            </th>  
                                        </tr>
                                    </thead>';
                                foreach($product->characteristic as $p)
                                $output.='
                                    <tr class="bcr">
                                        <td>
                                        '.$p->characteristic.'
                                        </td>
                                        <td>
                                        '.$p->pivot->value.'
                                        </td>
                                    </tr>';                                  
                                    $output.='
                                    </table>                                        
                        <div class="bcn" style="width: 200px;">
                            <p> Cantitate: '.$data['qty'].'</p>
                            <p> Gramaj: '.$data['weight'].'</p>
                            <p> Preț unitar: '.returnPriceFormat($data['pretUnitar']).'</p>
                            <p> Preț total: '.returnPriceFormat($data['price']).'</p>
                        </div>

                        <span>
                            <h4>Mul&#355;umim pentru rețetă! 
                            </h4>
                            <h4>Termeni și condi&#355;ii</h4>
                            
                            <p> 
                                Datorit&#259; naturii artizanale a produselor noastre, nu putem oferi ramburs&#259;ri sau schimb&#259;m produse de panifica&#355;ie și patiserie.
                                Odat&#259; ce un tort a fost luat de dvs. sau de o parte desemnat&#259;, acesta este considerat "acceptat". Toate produsele sunt responsabilitatea clientului dup&#259; ce acesta p&#259;r&#259;sește magazinul nostru sau dup&#259; primirea de la șoferi. Restituirile solicitate datorit&#259; stilului de decorare, nuan&#355;ei de culoare sau designului general de decorare nu vor fi onorate.
                                Dac&#259; ave&#355;i nevoie s&#259; am&#226;na&#355;i tortul pentru o alt&#259; dat&#259;, avem nevoie de o notificare de cel pu&#355;in 48 de ore &#238;n avans. Putem &#355;ine comanda am&#226;nat&#259; pentru o perioada nelimitat&#259; sau v&#259; putem reprograma comanda pentru alt&#259; dat&#259; (&#238;n func&#355;ie de disponibilitate).
                            </p>
                        </span>
            </span>     
        
            </body>
            </html>';
            
                $pdf->loadHTML($output);
                $pdf->save(storage_path($filename));
                auth()->user()->notify(new PersonalRecipe($data));
                File::delete(storage_path($filename));

    }
}
