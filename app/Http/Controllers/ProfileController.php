<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use View;
use App\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($user_id = null)
    { 
        $user_id = isset($user_id) ? $user_id : Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        if(!$user){
            $user = User::where('email', $user_id)->first();   
        }

        if(!$this->isUser($user_id)){
            return redirect()->route('error')->with('info', "No User Found");
        }

        return View::make('profile')->with('user',$user);

    }

    public function isUser($user_id){
      return User::where('id', $user_id)->first();
    }
}
