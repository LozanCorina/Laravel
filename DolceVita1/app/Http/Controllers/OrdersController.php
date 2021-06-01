<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use  Illuminate\Support\Facades\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\District;
use App\Models\Cart;
use App\Models\Stock;
use App\Models\PersonalOrder;
use Illuminate\Support\Facades\Mail;
use App\Notifications\Invoice;
use Illuminate\Support\Facades\File;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderPersonalProduct;
use PDF;

class OrdersController extends Controller
{
    public function index()
    {     
        $districts=District::all();

        $data=User::find(auth()->id());
        $reducere=0;
        $livrare=0;
        $finalPrice=0;

        $totalPriceItems=DB::table('cart')->where('user_id',auth()->id())->sum('totalprice');
        $pricePersonalProducts=PersonalOrder::where('ordered','0')->where('user_id',auth()->id())->sum('totalprice');
        $totalPrice=$pricePersonalProducts+$totalPriceItems;

        if($totalPrice>1800)
        {
            $reducere=($totalPrice*0.05);
        }
        $finalPrice=$totalPrice-$reducere; 
        //Calendar validation
        $date=now()->add(1,'day');
        
        return view('pages.finalizare_comanda',['districts'=>$districts,
        'products'=>$data,
        'totalPrice'=>$totalPrice,  
        'reducere'=>$reducere,
        'finalPrice'=> $finalPrice,
        'date'=>date_format($date,'Y-m-d'),
        'livrare'=>$livrare,]);
    }
    public function checkout(Request $request)
    {   
        $amount=$request->subtotal+$request->city-$request->product_discount; 
        $amountFormat= $amount;
        $this->validate($request, [
            'name'=> 'required',
            'email'=>'required|email',
            'phone'=>'required|digits:9',
            'date'=>'required|date',
            'city'=>'required',
            'home'=>'required', 
            ]);
            $data= array(
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'date'=>$request->date,
                'city'=>$request->city,
                'home'=>$request->home,
                'subtotal'=>$request->subtotal,
                'amount'=>$amount,   
                'note'=>$request->note,
                'discount'=>$request->product_discount,
                'delivery'=>$request->product_delivery, 
                'date_now'=>date_format(now(),'Y-m-d') ,
                'radio'=>$request->input('typecheck'),
            );

        $data1=User::find(auth()->id());    
        $personalOrder=DB::table('personal_order')->where(['user_id'=> auth()->id(),'ordered'=>0])->get();
        
        $meta='';

        $meta.='Produse comandate: ';
        foreach($data1->product as $product)
        {          
           $meta.= 'Denumire: '.$product->nume.' ';
           $meta.= 'Cantitate: '.$product->pivot->qty.' ';
           $meta.= 'Gramaj: '.$product->pivot->weight.' ';           
            $meta.= 'Pret final: '.returnPriceFormat($product->pivot->totalprice).' ';//?
                     
        }
        if($personalOrder->count())
        {
            foreach($personalOrder as $product)
            {
                $category=Category::find($product->categorie_id);

            $meta.= 'Denumire: '.$category->descriere.'Nr'.$product->id.' '; 
            $meta.= 'Cantitate: '.$product->qty.' '; 
            $meta.= 'Gramaj: '.$product->weight.' ';
            $meta.= 'Pret: '.returnPriceFormat($product->totalprice).' ';
            }   
            
        }
        
        //echo $meta;

        \Stripe\Stripe::setApiKey('sk_test_51IMs8sGodsiojyonNcHzeLo55HviG924yELMMbGfCz2CZd8p8KsBGVbT402tjAWhIUZI21c3z1EKrj7Nh34BGKBK00GGihKqDR');
        		
     
		$amount *= 100;
        $amount = (int) $amount;
        $address=$request->city.' '.$request->home;
        try
        {
            $payment_intent = \Stripe\PaymentIntent::create([
                'description' => 'Plata online pentru clientul '.$request->name,//to personalize with request
                'amount' => $amount,
                'currency' => 'RON',
                'description' => 'Plata online pentru clientul '.$request->name,
                'payment_method_types' => ['card'],
                'metadata'=>[
                    'contents'=>$meta,
                ]
                
            ]);
            $intent = $payment_intent->client_secret;  
                         
        }
        catch(\Exception $er)
        {
            return redirect()->route('finalizare.comanda')->with('success_message','Eroare!'.$er->getMessage());
        }	
        //echo  $amount;
        return view('pages.checkout',compact(['intent','amountFormat','data']));

    }  

    public function procesat(Request $request)
    {      
        
        $data1=User::find(auth()->id());  
        //validate stock     
        foreach($data1->product as $product)
        {
            //check only auxiliar
            if(is_null($product->pivot->weight))
            {
                $stock=Stock::where('product_id',$product->id)->value('qty');
                if($product->pivot->qty > $stock)
                {
                    return redirect()->route('cos.index')
                    ->with('success_message','Produsul: '.$product->nume.' este disponibil la moment în valoare de '.$stock.' unități. Vă rugăm setați o valoare mai mică!');
                }else
                {
                    //decrease stock
                    Stock::where('product_id',$product->id)->decrement('qty',$product->pivot->qty);
                }

            }           
        }
            
         $this->validate($request, [
            'name'=> 'required',
            'email'=>'required|email',
            'phone'=>'required|digits:9',
            'date'=>'required|date',
            'city'=>'required',
            'home'=>'required',
            ]);
           $amount=$request->subtotal+$request->city-$request->product_discount;
            $data= array(
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,              
                'date'=>$request->date,
                'city'=>$request->city,
                'home'=>$request->home,
                'subtotal'=>$request->subtotal,
                'amount'=>$amount,   
                'note'=>$request->note,
                'discount'=>$request->product_discount,
                'delivery'=>$request->product_delivery, 
                'date_now'=>date_format(now(),'Y-m-d') ,
                'radio'=>$request->input('typecheck'),
              );
              $invoiceNumber=$this->Orders_to_DB($data,$data1);
              $this->HTLM_toPDF($data,$data1,$invoiceNumber);
              $filename = 'Invoice_'. auth()->user()->name . '.pdf';
            
            //send mail
            auth()->user()->notify(new Invoice());
            File::delete(storage_path($filename));           
       
        return view('pages.procesat');
    }  
    public function stripeProcesat(Request $request)
    {
        $data1=User::find(auth()->id());  
        //validate stock     
        foreach($data1->product as $product)
        {
            //check only auxiliar
            if(is_null($product->pivot->weight))
            {
                $stock=Stock::where('product_id',$product->id)->value('qty');
                if($product->pivot->qty > $stock)
                {
                    return redirect()->route('cos.index')
                    ->with('success_message','Produsul: '.$product->nume.' este disponibil la moment în valoare de '.$stock.' unități. Vă rugăm setați o valoare mai mică!');
                }else
                {
                    //decrese stock
                    Stock::where('product_id',$product->id)->decrement('qty',$product->pivot->qty);
                }

            }           
        }
        $data= array(
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,              
            'date'=>$request->date,
            'city'=>$request->city,
            'home'=>$request->home,
            'subtotal'=>$request->subtotal,
            'amount'=>$request->amount,   
            'note'=>$request->note,
            'discount'=>$request->discount,
            'delivery'=>$request->delivery, 
            'date_now'=>date_format(now(),'Y-m-d') ,
            'radio'=>$request->radio,
        );

        $invoiceNumber=$this->Orders_to_DB($data,$data1);
        $this->HTLM_toPDF($data,$data1,$invoiceNumber);
            $filename = 'Invoice_'. auth()->user()->name . '.pdf';
            
            //send mail
            auth()->user()->notify(new Invoice());
            File::delete(storage_path($filename));

           
       
        return view('pages.procesat');
    }
    public function Orders_to_DB($data,$data1)
    {

        if($data['radio'] =='cardBancar'){
            $status='achitat';
        }else
        $status='în aștepare';
        
       $order= Order::create([
            'user_id'=>auth()->id(),
            'email'=>$data['email'],
            'name'=>$data['name'],
            'region'=>returnCityValue($data['city']),
            'adress'=>$data['home'],
            'phone'=>$data['phone'],
            'delivery_date'=>$data['date'], 
            'discount'=>$data['discount'],
            'subtotal'=>$data['subtotal'],
            'delivery_tax'=>$data['city'],
            'total_amount'=>$data['amount'],
            'payment_method'=>$data['radio'],
            'payment_status'=>$status,
            'order_status'=>'pedding'
        ]);
        foreach($data1->product as $product){            

            OrderProduct::create([
                'order_id'=>$order->id,
                'product_id'=>$product->id,
                'qty'=>$product->pivot->qty,
                'weight'=>$product->pivot->weight,
                'price'=>$product->pivot->price,
                'totalprice'=>$product->pivot->totalprice,
            ]);
        }
        //insert into order_personal_product values
        $personalOrder=DB::table('personal_order')->where(['user_id'=> auth()->id(),'ordered'=>0])->get();
        if($personalOrder->count())
        {
            foreach($personalOrder as $product){
                OrderPersonalProduct::create([
                    'order_id'=>$order->id,
                    'personal_order_id'=>$product->id,
                    'qty'=>$product->qty,
                    'weight'=>$product->weight,
                    'price'=>$product->totalprice
                ]);
            }
        }
               

         DB::table('cart')->where('user_id','=',auth()->id())->delete(); 
         DB::table('personal_order')->where('user_id','=',auth()->id())->update(['ordered'=>1]); 
         return $order->id;

    }

    public function HTLM_toPDF($data,$data1, $invoiceNumber){
            //atch pdf
            $personalOrder=DB::table('personal_order')->where(['user_id'=> auth()->id(),'ordered'=>0])->get();
            $filename = 'Invoice_'. auth()->user()->name . '.pdf';           
            $pdf = \App::make('dompdf.wrapper');
                $output='<!DOCTYPE html>
            <html lang="ro">         
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="robots" content="noindex">
        
            <title>Invoice</title>
        
        
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
        <h4>Factur&#259; DolceVita</h4>       
                    <strong>SC. DolceVita SRL</strong>
                    <small> <p>infoDolceVita@gmail.com| saleDolceVita@gmail.com
                        <br> Bucure&#351;ti, 8003655 Rom&#226;nia | + 40 075887324</p>
                    </small>
                    </header>
                        <h4>Factura nr#'.$invoiceNumber.'</h4>
                        <br>
                            <table class="w">
                                <tr>
                                    <td class="l">
                                        <p>Data facturare:'.$data['date_now'].'
                                            <br>
                                            Data Livrare: '.$data['date'].'
                                            <br>
                                            Valuta: RON
                                        </p>
                                    </td>
                                    <td class="r">
                                        <p>Clientul: '.$data['name'].'
                                            <br>
                                            Email: '.$data['email'].'
                                            <br>
                                            Adresa: '.returnCityValue($data['city']).'&nbsp;'.$data['home'].'
                                            <br>
                                            Contacte: (+40)'.$data['phone'].'
                                            <br>
                                        </p>
                                    </td>
                                </tr>
                                </table>
                                <table  class="w">
                                    <thead class="bcn"> 
                                        <tr>
                                            <th  scope="col"> Produse comandate:
                                            </th>
                                            <th  scope="col"> Cantitate:
                                            </th>
                                            <th  scope="col"> Gramaj:
                                            </th>
                                            <th  scope="col"> Pre&#355;:
                                            </th>
                                            <th  scope="col"> Subtotal:
                                            </th>
                                        </tr>
                                    </thead>';
                                foreach($data1->product as $product)
                                    $output.=('
                                    <tr class="bcr">
                                        <td>
                                       '.$product->nume.'
                                        </td>
                                        <td>
                                        '.$product->pivot->qty.' 
                                        </td>
                                        <td>
                                        '.$product->pivot->weight.'
                                        </td>
                                        <td>
                                        '.returnPriceFormat($product->pivot->price).'
                                        </td>  
                                        <td>
                                        '.returnPriceFormat($product->pivot->totalprice).'
                                        </td>
                                    </tr>
                                    ');
                                    if($personalOrder->count())
                                    {
                                        foreach($personalOrder as $product)
                                        {

                                        $category=Category::find($product->categorie_id);
                                        $output.=('
                                        <tr class="bcr">
                                            <td>
                                        '.$category->descriere.'Nr'.$product->pivot->id.'
                                            </td>
                                            <td>
                                            '.$product->pivot->qty.' 
                                            </td>
                                            <td>
                                            '.$product->pivot->weight.'
                                            </td>
                                            <td>
                                            '.returnPriceFormat($product->pivot->price).'
                                            </td>  
                                            <td>
                                            '.returnPriceFormat($product->pivot->totalprice).'
                                            </td>
                                        </tr>
                                        ');
                                        }
                                    }
                                    
                                    $output.=('
                                </table>  
        
                                <table class=" w">
                                    <tr style="background-color:  MistyRose">
                                        <td class="l">
                                        Subtotal:
                                        </td>
                                        <td class="r">
                                        '.returnPriceFormat($data['subtotal']).'
                                        </td>
                                    </tr>
                                    <tr style="background-color:  MistyRose">
                                    <td class="l"> Reducere: 
                                    </td>
                                    <td class="r"> '.returnPriceFormat($data['discount']).' 
                                    </td>
                                </tr>
                                    <tr style="background-color:  MistyRose">
                                        <td class="l"> Livrare: 
                                        </td>
                                        <td class="r"> '.returnPriceFormat($data['city']).' 
                                        </td>
                                    </tr>
                                    <tr class="bcn">
                                        <td style="float:left;"> Total: 
                                        </td>
                                        <td class="r"> <strong>'.returnPriceFormat($data['amount']).' </strong>
                                        </td>
                                    </tr>
                                </table>
                            <span style="margin-top:50px; background-color:#ff704d; height:50px;"> 
                                Noti&#355;e: '.$data['note'].'
                            </span>            
                        <span>
                            <h4>Mul&#355;umim pentru comand&#259;! 
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
            </html>
            '); 
            
            $pdf->loadHTML($output);
            $pdf->save(storage_path($filename));
    }
   
   
}
