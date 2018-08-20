<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable = ['atividade', 'empresa', 'sla', 'concluido'];
    
    private $atividade;
    private $empresa;
    private $concluidoP;
    private $concluidoA;
    private $emAtraso;
    private $nConcluido;

    function __construct($atividade, $empresa, $concluidoP, $concluidoA, $emAtraso, $nConcluido){
        $this->atividade = $atividade;
        $this->empresa = $empresa;
        $this->concluidoP = $concluidoP;
        $this->concluidoA = $concluidoA;
        $this->emAtraso = $emAtraso;
        $this->nConcluido = $nConcluido;
    }

    public function setAtividade($atividade){        $this->atividade = $atividade;    }
    public function getAtividade(){        return $this->atividade;    }
    public function setEmpresa($empresa){        $this->empresa = $empresa;    }
    public function getEmpresa(){        return $this->$empresa;    }
    public function setConcluidoP($concluidoP){        $this->concluidoP = $concluidoP;    }
    public function getConcluidoP(){        return $this->$concluidoP;    }
    public function setConcluidoA($concluidoA){        $this->concluidoA = $concluidoA;    }
    public function getConcluidoA(){        return $this->$concluidoA;    }
    public function setEmAtraso($emAtraso){             $this->emAtraso = $emAtraso;    }
    public function getEmAtraso(){        return $this->$emAtraso;    }
    public function setNConcluido($nConcluido){        $this->nConcluido = $nConcluido;    }
    public function getNConcluido(){        return $this->$nConcluido;    }

    public static function contaTotais($tarefas){
        $totais = array();

        for ($l=0; $l <= 14; $l++) { 
            for ($j=0; $j <= 3; $j++) { 
                $totais[$l][$j] = 0;
            }
        }

        for ($l=0; $l < count($tarefas); $l++) { 

            $totais[0][0] = $totais[0][0] + $tarefas[$l]->concluidoP; 
            $totais[0][1] = $totais[0][1] + $tarefas[$l]->concluidoA;
            $totais[0][2] = $totais[0][2] + $tarefas[$l]->emAtraso;
            $totais[0][3] = $totais[0][3] + $tarefas[$l]->nConcluido;

            switch ($tarefas[$l]->empresa) {

                case 'Cooperativas':
                    $totais[1][0] = $totais[1][0] + $tarefas[$l]->concluidoP; 
                    $totais[1][1] = $totais[1][1] + $tarefas[$l]->concluidoA;
                    $totais[1][2] = $totais[1][2] + $tarefas[$l]->emAtraso;
                    $totais[1][3] = $totais[1][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Centrais':
                    $totais[2][0] = $totais[2][0] + $tarefas[$l]->concluidoP; 
                    $totais[2][1] = $totais[2][1] + $tarefas[$l]->concluidoA;
                    $totais[2][2] = $totais[2][2] + $tarefas[$l]->emAtraso;
                    $totais[2][3] = $totais[2][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Confederação':
                    $totais[3][0] = $totais[3][0] + $tarefas[$l]->concluidoP; 
                    $totais[3][1] = $totais[3][1] + $tarefas[$l]->concluidoA;
                    $totais[3][2] = $totais[3][2] + $tarefas[$l]->emAtraso;
                    $totais[3][3] = $totais[3][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Corretora':
                    $totais[4][0] = $totais[4][0] + $tarefas[$l]->concluidoP; 
                    $totais[4][1] = $totais[4][1] + $tarefas[$l]->concluidoA;
                    $totais[4][2] = $totais[4][2] + $tarefas[$l]->emAtraso;
                    $totais[4][3] = $totais[4][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Consórcio':
                    $totais[5][0] = $totais[5][0] + $tarefas[$l]->concluidoP; 
                    $totais[5][1] = $totais[5][1] + $tarefas[$l]->concluidoA;
                    $totais[5][2] = $totais[5][2] + $tarefas[$l]->emAtraso;
                    $totais[5][3] = $totais[5][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Cartões':
                    $totais[6][0] = $totais[6][0] + $tarefas[$l]->concluidoP; 
                    $totais[6][1] = $totais[6][1] + $tarefas[$l]->concluidoA;
                    $totais[6][2] = $totais[6][2] + $tarefas[$l]->emAtraso;
                    $totais[6][3] = $totais[6][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Banco':
                    $totais[7][0] = $totais[7][0] + $tarefas[$l]->concluidoP; 
                    $totais[7][1] = $totais[7][1] + $tarefas[$l]->concluidoA;
                    $totais[7][2] = $totais[7][2] + $tarefas[$l]->emAtraso;
                    $totais[7][3] = $totais[7][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Fundação':
                    $totais[8][0] = $totais[8][0] + $tarefas[$l]->concluidoP; 
                    $totais[8][1] = $totais[8][1] + $tarefas[$l]->concluidoA;
                    $totais[8][2] = $totais[8][2] + $tarefas[$l]->emAtraso;
                    $totais[8][3] = $totais[8][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Fundos':
                    $totais[9][0] = $totais[9][0] + $tarefas[$l]->concluidoP; 
                    $totais[9][1] = $totais[9][1] + $tarefas[$l]->concluidoA;
                    $totais[9][2] = $totais[9][2] + $tarefas[$l]->emAtraso;
                    $totais[9][3] = $totais[9][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Adm. de Bens':
                    $totais[10][0] = $totais[10][0] + $tarefas[$l]->concluidoP; 
                    $totais[10][1] = $totais[10][1] + $tarefas[$l]->concluidoA;
                    $totais[10][2] = $totais[10][2] + $tarefas[$l]->emAtraso;
                    $totais[10][3] = $totais[10][3] + $tarefas[$l]->nConcluido;
                break;
                
                case 'SicrediPar':
                    $totais[11][0] = $totais[11][0] + $tarefas[$l]->concluidoP; 
                    $totais[11][1] = $totais[11][1] + $tarefas[$l]->concluidoA;
                    $totais[11][2] = $totais[11][2] + $tarefas[$l]->emAtraso;
                    $totais[11][3] = $totais[11][3] + $tarefas[$l]->nConcluido;
                break;

                case 'SFG':
                    $totais[12][0] = $totais[12][0] + $tarefas[$l]->concluidoP; 
                    $totais[12][1] = $totais[12][1] + $tarefas[$l]->concluidoA;
                    $totais[12][2] = $totais[12][2] + $tarefas[$l]->emAtraso;
                    $totais[12][3] = $totais[12][3] + $tarefas[$l]->nConcluido;
                break;

                case 'Condomínio':
                    $totais[13][0] = $totais[13][0] + $tarefas[$l]->concluidoP; 
                    $totais[13][1] = $totais[13][1] + $tarefas[$l]->concluidoA;
                    $totais[13][2] = $totais[13][2] + $tarefas[$l]->emAtraso;
                    $totais[13][3] = $totais[13][3] + $tarefas[$l]->nConcluido;
                break;
                                
                default:
                    # code...
                    break;
            }

        }

        //dd($totais[2]);

        return $totais;
    }

}

