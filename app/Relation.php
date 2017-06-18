<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Relation extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'from_id', 'to_id', 'request_type', 'seen_status', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
