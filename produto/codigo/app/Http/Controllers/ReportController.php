<?php

namespace App\Http\Controllers;
use App\Register;
use Illuminate\Http\Request;
use Auth;
class ReportController extends Controller
{
   public function Seven($id){
    $registers = Register::with('registerFeeling')->where('user_id','=',$id)
    ->whereRaw("DATEDIFF(now(),created_at)  < 7")->get();

    return view('report',compact('registers'));
   }
   
   public function Fifteen($id){
    $registers = Register::with('registerFeeling')->where('user_id','=',$id)
    ->whereRaw("DATEDIFF(now(),created_at)  < 15")->get();

    return view('report',compact('registers'));
    }
    public function Thirty($id){
        $registers = Register::with('registerFeeling')->where('user_id','=',$id)
     ->whereRaw("DATEDIFF(now(),created_at)  < 30")->get();

     return view('report',compact('registers'));
    }
}
