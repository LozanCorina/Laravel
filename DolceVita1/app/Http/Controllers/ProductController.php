<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\PersonalRecipe;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Http\Request;
use App\Models\PersonalOrder;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function detail($category_name, $product_name){

        $stock=1;
        $category=Category::where('descriere',$category_name)->first();
        if($category!=[])
        {          
            $data=Product::where('id_cat',$category->id)->where('nume',"$product_name")->first();
            if($data==[])
            {
                abort(404,'Pagina nu a fost gasita');
            }
            else if($data->id_cat == 7)
            {
                $data_stock= Product::find($data->id)->stock;
                if(is_null($data_stock->qty))
                {
                    $stock=0;
                }
                else{
                    $stock= $data_stock->qty;
                }
            }
            

             $comments=Comment::where('commentable_id','=',$data->id)->get();
        } else
        {
            abort(404,'Pagina nu a fost gasita');
        }
    
        return view('pages.categories.product_detail',['category'=>$category,
        'data'=>$data,
        'stock'=>$stock,
        'comments'=>$comments
        ]);
    }
    
    public function pdf_Macarons($data)
    {
        $filename = 'Recipe_'. auth()->user()->name. '.pdf';
        $pdf = \App::make('dompdf.wrapper');
        $output='<!DOCTYPE html>
        <html lang="ro">
        <html>
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="robots" content="noindex">
        
            <title>Rețetă</title>
        
        
            <style>
                
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
        
        <h4>Rețetă personalizată DolceVita
                </h4>
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
                                        <p>Data creare: 01/01/2021</p>
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
                                    </thead>
                                    <tr class="bcr">
                                        <td>
                                        Culoare
                                        </td>
                                        <td>
                                        '.$data['culoare'].'
                                        </td>
                                    </tr>
                                    <tr class="bcr">
                                        <td>
                                        Crema
                                        </td>
                                        <td>
                                        '.$data['crema'].'
                                        </td>
                                    </tr>
                                    <tr class="bcr">
                                        <td>
                                        Decor
                                        </td>
                                        <td>
                                        '.$data['decor'].'
                                        </td>
                                    </tr>    
                                </table>  
        
                                
                            <span style="margin-top:50px; background-color:#ff704d; height:50px;"> 
                                Auxiliar: '.$data['decor_p'].'
                            </span>            
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
    public function pdf_Torturi($data)
    {
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
        
        <h4>Rețetă personalizată DolceVita
                    <img  src="https://img.huffingtonpost.com/asset/58dd25a42c00002000ff1525.jpeg?ops=scalefit_720_noupscale&format=webp" style=" border-radius: 20%; height: 100px; float:right;" alt="logo">
                </h4>
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
                                        <p>Data creare: 01/01/2021</p>
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
                                    </thead>
                                    <tr class="bcr">
                                        <td>
                                        Umplutura
                                        </td>
                                        <td>
                                        '.$data['umplutura'].'
                                        </td>
                                    </tr>
                                    <tr class="bcr">
                                        <td>
                                        Supliment
                                        </td>
                                        <td>
                                        '.$data['supliment'].'
                                        </td>
                                    </tr>
                                    <tr class="bcr">
                                        <td>
                                        Decor
                                        </td>
                                        <td>
                                        '.$data['decor'].'
                                        </td>
                                    </tr>    
                                </table>  
        
                                
                            <span style="margin-top:50px; background-color:#ff704d; height:50px;"> 
                                Auxiliar: '.$data['decor_p'].'
                            </span>            
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
    public function pdf_Croissant($data)
    {
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
        
        <h4>Rețetă personalizată DolceVita
                    <img  src="https://img.huffingtonpost.com/asset/58dd25a42c00002000ff1525.jpeg?ops=scalefit_720_noupscale&format=webp" style=" border-radius: 20%; height: 100px; float:right;" alt="logo">
                </h4>
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
                                        <p>Data creare: 01/01/2021</p>
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
                                    </thead>
                                    <tr class="bcr">
                                        <td>
                                        Umplutura
                                        </td>
                                        <td>
                                        '.$data['umplutura'].'
                                        </td>
                                    </tr>
                                    <tr class="bcr">
                                        <td>
                                        Exterior
                                        </td>
                                        <td>
                                        '.$data['exterior'].'
                                        </td>
                                    </tr>
                                    <tr class="bcr">
                                        <td>
                                        Glazura
                                        </td>
                                        <td>
                                        '.$data['glazura'].'
                                        </td>
                                    </tr>    
                                </table>  
        
                                
                            <span style="margin-top:50px; background-color:#ff704d; height:50px;"> 
                                Auxiliar: '.$data['auxiliar'].'
                            </span>            
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
  

    public function test (){
        $f= date_format(now(),'H:i');
       echo  date('H:i');

        if($f<date('15:00',strtotime('H:i'))){
            $date=now();
        }
        else{
            $date=now()->add(1,'day');
        }
        echo $date;
    }  
  
}
