<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserDetails extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id', 'profile_for', 'gender', 'dob', 'religion_id', 'mother_tongue', 'country_id', 'mobile_number', 'created_at', 'updated_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function religion(){
        return $this->belongsTo('App\Religion');
    }

    public function country(){
        return $this->belongsTo('App\Country');
    }

}
