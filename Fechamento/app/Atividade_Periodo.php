<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atividade_Periodo extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'conclusao', 'user_id', 'previsao'
    ];
    protected $dates = ['dob'];

    public function periodo (){
        $periodo = $this->belongsTo('App\Periodo'); 
        return $periodo;
    }

    public function atividade (){
        $atividade = $this->belongsTo('App\Atividade', 'atividade_id')
                           //->orderBy('float_hora')
                           //->orderBy('float')
                           ->withTrashed(); 
        
        return $atividade;
    }

   
    public function user (){
        $user = $this->belongsTo('App\User', 'user_id')->withTrashed();
        return $user;
    }

    public function concUser (){
        $concUser = $this->belongsTo('App\User', 'concluido_user_id')->withTrashed();
        return $concUser;
    }

    public function comentario (){
        $comentario = $this->hasMany('App\Comentario', 'atividade_periodo_id', 'id'); 
        return $comentario;
    }

    
}
