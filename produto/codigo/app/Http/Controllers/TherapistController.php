<?php

namespace App\Http\Controllers;
use App\User;
use App\Register;
use App\Conclusion;
use App\Strategy;
use auth;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function __construct(){
        $this->middleware('auth:therapist');
    }
    public function index(){

       return view('therapist');
    }
    public function Seven($id){
        $registers = Register::with('registerFeeling')->where('user_id','=',$id)
        ->whereRaw("DATEDIFF(now(),created_at)  < 7")->get();
        $conclusions = Conclusion::where('user_id','=',$id)->first();
        $strategies = Strategy::where('user_id','=',$id)->first();
        return view('conclusion',compact('registers','id','conclusions','strategies'));
       }
       
       public function Fifteen($id){
        $registers = Register::with('registerFeeling')->where('user_id','=',$id)
        ->whereRaw("DATEDIFF(now(),created_at)  < 15")->get();
    
        $conclusions = Conclusion::where('user_id','=',$id)->first();
        $strategies = Strategy::where('user_id','=',$id)->first();
        return view('conclusion',compact('registers','id','conclusions','strategies'));
        }
        public function Thirty($id){
            $registers = Register::with('registerFeeling')->where('user_id','=',$id)
         ->whereRaw("DATEDIFF(now(),created_at)  < 30")->get();
    
          $conclusions = Conclusion::where('user_id','=',$id)->first();
          $strategies = Strategy::where('user_id','=',$id)->first();
          return view('conclusion',compact('registers','id','conclusions','strategies'));
        }

        public function conclusion(request $request){
            $res=Conclusion::where('user_id',$request->user_id)->delete(); 

            $conclusion = new Conclusion;
            $conclusion->user_id =  $request->user_id;
            $conclusion->therapist_id =Auth::guard("therapist")->user()->id;
            
            $conclusion->conclusion = $request->conclusao;
            
            $conclusion->save();
            return redirect()->back()->with('message', 'Conclusoes salvas com sucesso!');
        }
        public function strategy(request $request){
            $res=strategy::where('user_id',$request->user_id)->delete(); 

            $strategy = new Strategy;
            $strategy->user_id =  $request->user_id;
            $strategy->therapist_id =Auth::guard("therapist")->user()->id;
            
            $strategy->strategy = $request->estrategia;
            
            $strategy->save();
            return redirect()->back()->with('message', 'Estratégias salvas com sucesso!');
        }
}

