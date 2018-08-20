<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    
    protected $fillable = [
        'atividade_id1', 'atividade_id2', 'is_deleted'
    ];
    
    public function atividade (){
        $atividade = $this->belongsTo('App\Atividade'); 
        return $atividade;
    }

    public function atividade1 (){
        $atividade1 = $this->belongsTo('App\Atividade', 'atividade_id1'); 
        return $atividade1;
    }

    public function atividade2 (){
        $atividade2 = $this->belongsTo('App\Atividade', 'atividade_id2'); 
        return $atividade2;
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

}
