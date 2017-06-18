<?php

namespace App;
/*
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
*/

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function details(){
        return $this->hasOne('App\UserDetails');
    }

    public function relations(){
        return $this->hasMany('App\Relation','from_id');
    }

    public function friendsOfMine(){
        return $this->belongsToMany('App\User','relations','from_id','to_id');
    }


    public function friendOf(){
        return $this->belongsToMany('App\User','relations','to_id','from_id');
    }

    public function friends(){
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasfriendRequestPending(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function hasfriendRequestReceived(User $user){
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function friendRequestsAccepted(){
        return $this->friendsOfMine()->wherePivot('accepted', true)->get();
    }

    public function friendRequestsPendingAccepted(){
        return $this->friendOf()->wherePivot('accepted', true)->get();
    }

    public function isFriends(User $user){
        return (bool) $this->friendRequestsAccepted()->where('id', $user->id)->count()+$this->friendRequestsPendingAccepted()->where('id', $user->id)->count();
    }


}
