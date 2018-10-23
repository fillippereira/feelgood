<?php

namespace App\Http\Controllers;
use Auth;
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
        $user = Auth::User();
        $user->permission = $request->email;
        $user->update();
        return redirect()->back()->with('message', 'Permisão concedida com sucesso!');
    }
}

