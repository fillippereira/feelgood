<?php

namespace App\Http\Controllers;
use Auth;
use App\Therapist;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:web');
    }
    public function index(){
        return view('home');
    }
    public function AutorizarAcesso(request $request)
    { 
        $hasTherapist = Auth::User()->therapist;
        $therapist = Therapist::where('email',$request->email)->first();
        
       
        
        if(!$therapist) 
        {
            return redirect()->back()->with('error', 'Terapeuta não encontrado!Verifique o email e tente novamente.');
        }
        $user = Auth::User();
        $user->therapist()->associate($therapist);
        $user->update();
        if($hasTherapist){
            return redirect()->back()->with('message', 'Terapeuta atualizado com sucesso! Agora seu terapeuta pode visualizar seus registros :)');
        }else
        {
            return redirect()->back()->with('message', 'Permisão concedida com sucesso! Agora seu terapeuta pode visualizar seus registros :)');
        }
    }
}

