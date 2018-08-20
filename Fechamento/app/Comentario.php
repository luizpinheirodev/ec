<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comentario extends Model
{
    protected $fillable = [
        'texto', 'usuario_id', 'atividade_periodo_id', 'resposta_id', 'anexo' //completar
    ];

    public function usuario(){
        $usuario = $this->belongsTo('App\User')->withTrashed();
        return $usuario;
    }

    public function atividade_periodo(){
        $atividade_periodo = $this->belongsTo('App\Atividade_Periodo');
        return $atividade_periodo;
    }
    
    public function usuarioPend(){
        $usuarioPend = $this->belongsTo('App\User', 'usuario_id', 'id')->withTrashed();
        return ($usuarioPend);
    }
    
}

