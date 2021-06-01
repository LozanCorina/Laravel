<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
 
  public function Favorites()
  {
      return view('pages.favorites');
  }
  public function Cos()
  {
    return view('pages.cos');
  }
}
