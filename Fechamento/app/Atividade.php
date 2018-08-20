<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atividade extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nome', 'float', 'float_hora','duracao', 'usuario_id', 'gerencia_id', 'empresa_id', 'destaque', 'deleted_at' //completar
    ];

    public function usuario(){
        $usuario = $this->belongsTo('App\User')->withTrashed();;
        return $usuario;
    }

    public function gerencia (){
        $gerencia = $this->belongsTo('App\Gerencia'); 
        //dd($gerente);
        return $gerencia;
    }

    public function empresa(){
        $empresa = $this->belongsTo('App\Empresa');
        return $empresa;
    }

    public function backup (){
        $backup = $this->belongsTo('App\User')->withTrashed(); 
        return $backup;
    }

}