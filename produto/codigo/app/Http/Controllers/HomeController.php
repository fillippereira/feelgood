<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Humor;
use App\Feeling;
use App\Activity;
use App\Register;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registers = Register::with('registerFeeling')->where('user_id','=',Auth::user()->id)->get();
        

        $humors = Humor::whereNotIn('id', function($query) {
            $query->select('humor_id')
            ->from('humor_exceptions')
            ->where('user_id','=',Auth::user()->id);
        })->where(function ($query) {
            $query->where('owner','=',Auth::user()->id)
                ->orWhere('owner', '=', 0);
        })->get();

        
        $feelings = Feeling::whereNotIn('id', function($query) {
            $query->select('feeling_id')
            ->from('feeling_exceptions')
            ->where('user_id','=',Auth::user()->id);
        })->where(function ($query) {
            $query->where('owner','=',Auth::user()->id)
                ->orWhere('owner', '=', 0);
        })->get();


        $activities = Activity::whereNotIn('id', function($query) {
            $query->select('Activity_id')
            ->from('Activity_exceptions')
            ->where('user_id','=',Auth::user()->id);
    })->where(function ($query) {
        $query->where('owner','=',Auth::user()->id)
              ->orWhere('owner', '=', 0);
    })->get();

        return view('home',compact('humors','feelings','activities','registers'));
    }
}
