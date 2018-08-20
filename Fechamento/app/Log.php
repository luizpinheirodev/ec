<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['nome'];

    /*
    private $nome;
    private $usuario;
    private $atividade;
    private $tipo;

    function __construct($nome, $usuario, $atividade, $tipo){
        $this->nome = $nome;
        $this->usuario = $usuario;
        $this->atividade = $atividade;
        $this->tipo = $tipo;
    }
*/


    
    public function usuario(){
        $usuario = $this->belongsTo('App\User', 'user_id')->withTrashed();
        return $usuario;
    }

    public function atividade_periodo(){
        $atividade_periodo = $this->belongsTo('App\Atividade_Periodo'); 
        return $atividade_periodo;
    }

    public function logss(){
        $logss = $this->belongsTo('App\Log'); 
        return $logss;
    }

}

