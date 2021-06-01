<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Raffle;
use App\Models\FinalPrice;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $category= Category::all();
        $materie=DB::table('materie_prima')
        ->orderBy('denumire','asc')
        ->get();
        $recipes= DB::table('product_recipe')->select('id_reteta')->distinct()->get();
       

        return view('pages.add_recipes', compact(['category','materie','recipes']));
    }

    public function tombola()
    {
        $raffles=Raffle::all();

        return view('pages.istoric_tombola',compact(['raffles']));
    }
    public function store(Request $request)
    {

        if($request->action == 'r_existenta')
        {
            // $categorie=Recipe::where('id_reteta',$request->recipe_id)
            // ->get();
            // echo $categorie;
            $this->validate($request, [                
                'gramaj'=>'required|numeric',
                ]);
            $categorie=categorieId($request->recipe_id);
        } 
        else if($request->action == 'r_noua')
        {   $this->validate($request, [   
            'recipe_id'=> 'required|string',       
            'gramaj'=>'required|numeric',
            ]);
            
            $categorie=$request->categorie;
            $existRecipe=Recipe::where('id_reteta',$request->recipe_id)->first();
            if(!is_null($existRecipe)){
              
                return redirect()->route('add.recipe')->with('success_message','Aceasta rețetă există în baza de date, introduceți altă denumire!');
            }
        }


        if($request->action == 'r_existenta' or $request->action == 'r_noua' )
        {
            $pret_mat=materialPrice($request->materie);

            $price=$request->gramaj*$pret_mat;
            Recipe::insert([
                'id_reteta'=>$request->recipe_id,
                'categorie_id'=>$categorie,
                'material_id'=>$request->materie,
                'gramaj' =>$request->gramaj,
                'pret'=>$price,
                'created_at'=>now(),
                'updated_at'=> now(),
                ]);

            return redirect()->route('add.recipe')->with('success_message','Ingredientul a fost adăugat!');
        }
        else if($request->action == 'mat_prima')
        {
            $this->validate($request, [    
                'denumire'=>'required|string',             
                'gramaj'=>'required|numeric',
                'pret'=>'required|numeric',
                ]);
            DB::table('materie_prima')->insert([
                'denumire'=>$request->denumire,
                'um'=>$request->um,
                'gramaj'=>$request->gramaj,
                'pret'=>$request->pret,
            ]);
            return redirect()->route('add.recipe')->with('success_message','Materia primă a fost adăugată!');
        }        

        
    }

    public function finalPrice()
    {
        $recipes= Recipe::distinct()->get('id_reteta');
        foreach($recipes as $recipe)
        {
            $sal=0;
            $ch_indirecte=0;
            $CAS=0;
            $costNet=0;
            $adaos=0;
            $final_price=0;

           //echo $recipe->id_reteta.'<br>';
            $categorie=categorieId($recipe->id_reteta);
            $price1=DB::table('product_recipe')->where('id_reteta', $recipe->id_reteta)->sum('pret');
                if($categorie == 4)
            {
                $sal=8;
                $ch_indirecte=25;
                $CAS=8*0.2954;
                $costNet= $price1+$sal+$CAS+$ch_indirecte;
                $adaos=$costNet*0.05;//5%n adaos
                $final_price=$adaos+$costNet;
            }
            else if($categorie == 6)
            {
                $sal=5; //chelt cu salariatii
                $ch_indirecte=25;
                $CAS=5*0.2954 ;//fondului de salarii  29,54 %
                //contributiile la bugetul asigurarilor
                // Cost complet = Cheltuieli cu materiile prime si materiale +
                //  Salarii directe + CAS + cotizatii ajutor de somaj + Alte cheltuieli
                $costNet= $price1+$sal+$CAS+$ch_indirecte;
                $adaos=$costNet*0.05;//5%n adaos
                $final_price=$adaos+$costNet;      
            }
            else if($categorie == 1)
            {
                $sal=10;
                $ch_indirecte=25;
                $CAS=8*0.2954;
                $costNet= $price1+$sal+$CAS+$ch_indirecte;
                $adaos=$costNet*0.05;//5%n adaos
                $final_price=$adaos+$costNet;
            }
            else if($categorie == 2)
            {
                $sal=5;
                $ch_indirecte=8;
                $CAS=8*0.2954;
                $costNet= $price1+$sal+$CAS+$ch_indirecte;
                $adaos=$costNet*0.05;//5%n adaos
                $final_price=$adaos+$costNet;
            }
            else if($categorie == 5)
            {
                $sal=10;
                $ch_indirecte=25;
                $CAS=8*0.2954;
                $costNet= $price1+$sal+$CAS+$ch_indirecte;
                $adaos=$costNet*0.05;//5%n adaos
                $final_price=$adaos+$costNet;
            }
           // insert DB, if exist,update
            DB::table('final_price')->upsert(
                ['id_reteta' => $recipe->id_reteta, 
                'pret_mat' => $price1, 
                'c_salarii' => $sal,
                'CAS'=> $CAS,
                'c_indirecte'=> $ch_indirecte ,
                'pret_net'=>$costNet,
                'adaos'=>$adaos,
                'pret_final'=> $final_price,
                'created_at'=>now(),
                'updated_at'=>now()],
                ['id_reteta'], ['pret_mat', 'c_salarii', 'CAS', 'c_indirecte', 'pret_net', 'adaos', 
                'pret_final','created_at', 'updated_at']);
         
        }
        $content=FinalPrice::all();
        
        return view('pages.final_price',compact(['content']));
       
    }
}
