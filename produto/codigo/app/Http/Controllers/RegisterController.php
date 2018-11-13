<?php

namespace App\Http\Controllers;
use App\Register;
use App\RegisterFeeling;
use App\RegisterThought;
use App\Humor;
use App\Feeling;
use Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{


    public function index()
    {

        $registers = Register::where('user_id','=',Auth::user()->id)->get();
 
        return view('home',compact('registers'));
        
    }
    public function store(request $request)
    {
        $humor  = Humor::where('id',$request->humor)->first();
        $register = new Register;
        $register->user_id =  Auth::user()->id;
        $register->humor()->associate($humor);
        
        $register->situation = $request->situacao;
        $register->comportament = $request->comportamento;
        $register->save();

        for($i=0; $i<count($_POST['sentimentos']);$i++)
        {
           
            $feeling = Feeling::where('id',$_POST['sentimentos'][$i])->first();
            $register_feeling = new RegisterFeeling;
            $register_feeling->register()->associate($register);
            $register_feeling->feeling()->associate($feeling);
            $register_feeling->intensity_feeling = $_POST['qtd_sentimento'][$i];
            $register_feeling->save();
        }

        
        for($i=0; $i<count($_POST['pensamento']);$i++)
        { 
            $register_thought = new RegisterThought;
            $register_thought->register()->associate($register);
            $register_thought->thought = $_POST['pensamento'][$i];
            $register_thought->qualification_thought = $_POST['qualificacao_pensamento'][$i];
            $register_thought->save();
        }
      
      
      
        return redirect()->route('home')->with('message', 'Registro realizado com sucesso!');
    }
}
