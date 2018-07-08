<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
   public function index(Request $request)
   {  
       $points = $request->get('points');
        
      if($request->get('operation') == 'increment')
      {
         \Auth::user()->skillometer += $points;
         \Auth::user()->games_won += 1;
          
  
      } else if($request->get('operation') == 'decrement') {
  
        \Auth::user()->skillometer -= $points;
        \Auth::user()->games_lost += 1;
        
  
      } else {
        \Auth::user()->games_drawn += 1;
      }
      
      \Auth::user()->save();
   }
}
