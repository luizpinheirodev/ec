<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $fillable = ['nome', 'resultado', 'periodo', 'diasfechamento'];
}
