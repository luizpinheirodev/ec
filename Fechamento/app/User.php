<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    //protected $table = 'user';
    public function gerente (){
        $gerente = $this->belongsTo('App\User')->withTrashed(); 
        //dd($gerente);
        return $gerente;
    }

    public function gerencia (){
        $gerente = $this->belongsTo('App\Gerencia'); 
        //dd($gerente);
        return $gerente;
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome', 'email', 'password','email', 'ramal', 'gerente_id', 'nivel', 'gerencia_id' //completar
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password', 
        'remember_token',
    ];
}