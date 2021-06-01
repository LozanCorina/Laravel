<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUs;
use App\Mail\Contestatie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Raffle;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Comment;
use App\Models\Characteristic;
use App\Models\PersonalOrder;
use PDF;



class PagesController extends Controller
{
  public function Pages($pages)
  {
    return view('pages.'.$pages);
  }

  public function index()
  {
    $tombole=Raffle::where('status','=',1)->get();
    $NrTomb= $tombole->count();
    if( $tombole->count())
    {
      foreach($tombole as $tombola)
      {
        $raffle_id=$tombola->id;
        $numeTombola=$tombola->name;
        $startDate=$tombola->date_start;
        $endDate=$tombola->date_end;
      }
    }
    else{
        $raffle_id=0;
        $numeTombola=0;
        $startDate=0;
        $endDate=0;

    }
        
  return view('pages.tutoriale')->with(['tombole'=>$NrTomb,'raffle_id'=>$raffle_id,'numeTombola'=>$numeTombola,'startDate'=>$startDate,'endDate'=>$endDate]);
  }
  
  public function send(Request $request)
  {
    $this->validate($request, [
      'name'=> 'required',
      'email'=>'required|email',
      'sbj'=>'required',
      'message'=>'required',
      ]);

      $data= array(
        'name'=>$request->name,
        'email'=>$request->email,
        'sbj'=>$request->sbj,
        'message'=>$request->message,
           
      );
      Mail::to('infoDolceVita@gmail.com')->send(new ContactUs($data));
      return back()->with('success_message','Mail-ul a fost trimis cu succes!');
  }

  public function contestatie(Request $request){
    $this->validate($request, [
      'name'=> 'required',
      'email'=>'required|email',
      'phone'=>'required|numeric',
      'subject'=>'required',
      'message'=>'required',
      ]);

      $data= array(
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'subject'=>$request->subject,
        'message'=>$request->message,
           
      );
      Mail::to('infoDolceVita@gmail.com')->send(new Contestatie($data));
      //insert DB 
      DB::table('litigations')->insert([
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'subject'=>$request->subject,
        'message'=>$request->message,
        'created_at'=> now(),
        'updated_at'=> now(),
      ]);

      return back()->with('success_message','Contestația a fost trimisă spre procesare!');
  }

  public function istoric(){
  $user=User::find(auth()->id()); 
  $orders=$user->orders()->orderBy('created_at','desc')->get();
 
  return view('pages.history')->with(['user'=>$user,'orders'=>$orders]);
    
  }

  public function upload()
  {
    $dublicates=DB::table('raffle_user')->where(['user_id'=>auth()->id(),'raffle_id'=>request('raffle_id')])->get();

    if($dublicates->isEmpty())
    {
      DB::table('raffle_user')->insert([
        'raffle_id'=>request('raffle_id'),
        'user_id'=>auth()->id(),
        'photo'=>request('upload')->store('raffles','public'),
        'created_at'=> now(),
        'updated_at'=> now(),
      ]);
      return back()->with('success_message','Ați încărcat cu succes imaginea!');
    }      
      else

      return back()->with('success_message','Ați încărcat deja imaginea!');
     
  }

  public function test(){

    //
      
    }
        
      
    
  }

 
 

}
