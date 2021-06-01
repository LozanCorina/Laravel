<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request){
        
        $query=$request->input('query');

        $request->validate([
            'query'=>'required',
        ]);

        $results=Product::search($query)->paginate(12);

        return view('pages.search-result',['results'=>$results,]);
    }
}
