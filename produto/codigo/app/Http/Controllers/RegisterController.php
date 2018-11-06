<?php

namespace App\Http\Controllers;
use App\Register;
use App\RegisterFeeling;
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
        $register = new Register;
        $register->user_id =  Auth::user()->id;
        $register->thoughts = $request->pensamento;
        $register->qualification_thoughts = $request->pensamento_forte;
        $register->situation = $request->situacao;
        $register->comportament = $request->comportamento;
        $register->save();

        for($i=0; $i<count($_POST['sentimentos']);$i++)
        {
            $register_feeling = new RegisterFeeling;
            $register_feeling->register()->associate($register);
            $register_feeling->feeling_id = $_POST['sentimentos'][$i];
            $register_feeling->intensity_feeling = $_POST['qtd_sentimento'][$i];
            $register_feeling->save();
        }
      
      
      
        return redirect()->route('home')->with('message', 'Registro realizado com sucesso!');
    }
}
