<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function __construct(){
        $this->middleware('auth:therapist');
    }
    public function index(){
        return view('therapist');
    }
}

