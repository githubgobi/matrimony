<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use View;
use App\User;
use App\Relation;

class RelationsController extends Controller
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



 
            $relation = new Relation;
            $relation->from_id = Auth::user()->id;
            $relation->to_id = $user_id;
            $relation->request_type = 0;
            $relation->save();

        return  redirect()->back()->with('user',$user );
    }

    public function hasFriendRequestPending(User $user){
        return (bool) $this->firendRequestPending()->where('id', $user->id)->count();
    }

    public function isUser($user_id){
      return User::findOrFail($user_id);
    }

}
