<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class CommentsController extends Controller
{
   public function add($id)
   {

    if(request('comment') )
    {
        DB::table('comments')->insert([
       'user_id'=>auth()->id(),
       'name'=>auth()->user()->name,
       'product_id'=>$id,
       'comment'=>request('comment'),
       "created_at" => now(), 
       "updated_at" => \Carbon\Carbon::now(), 
       ]);
    }
    else
    {
        return back()->with('success_message','Introduce-ti un comentariu!');
    }
       
 

    return back()->with('success_message','Comentariul a fost adăugat cu succes!');

   }
}
