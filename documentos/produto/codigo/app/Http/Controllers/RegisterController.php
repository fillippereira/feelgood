<?php

namespace App\Http\Controllers;
use App\Register;
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
        $register->feelings = $request->sentimentos;
        $register->quantification_feelings = $request->qtd_sentimento;
        $register->thoughts = $request->pensamento;
        $register->qualification_thoughts = $request->pensamento_forte;
        $register->situation = $request->situacao;
        $register->comportament = $request->comportamento;
       
        $register->save();
        return redirect()->route('home')->with('message', 'Registro realizado com sucesso!');
    }
}
