<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class StudentLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:student');
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

        $authOK = Auth::guard('student')->attempt($credentials, $request->renember);

        if($authOK){
            return redirect()->intended(route('student.dashboard'));
        }
            return redirect()->back->withInputs($request->only('email','renember'));
        
    }

    public function index(){
        return view('auth.student-login');
    }
}
