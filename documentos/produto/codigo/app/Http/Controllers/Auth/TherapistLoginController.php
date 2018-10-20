<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TherapistLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:therapist');
    }
    public function login(Request $request){
        $this->validate($request, [
          'email' => 'required|string',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' =>$request->password
        ];

        $authOK = Auth::guard('therapist')->attempt($credentials, $request->renember);

        if($authOK){
            return redirect()->intended(route('therapist.dashboard'));
        }
            return redirect()->back->withInputs($request->only('email','renember'));
        
    }
    public function index(){
        return view('auth.therapist-login');
    }
}
