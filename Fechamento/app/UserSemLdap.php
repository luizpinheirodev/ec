<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSemLdap extends Model
{
    protected $fillable = [
        'email'
    ];

    

}