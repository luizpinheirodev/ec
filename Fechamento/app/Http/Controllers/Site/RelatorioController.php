<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;

class RelatorioController extends Controller
{

    public function index(){

        $periodos = \App\Periodo::orderBy('id', 'desc')->get();
        $gerencias = \App\Gerencia::orderBy('nome', 'desc')->get();
        $empresas = \App\Empresa::orderBy('nome', 'desc')->get();
        $users = \App\User::orderBy('nome', 'desc')->get();
        $gestores = \App\User::orderBy('nome', 'desc')->where('nivel', '=', '3')->get();
        return view('site.relatorio', compact('periodos', 'gerencias', 'empresas', 'users', 'gestores'));
    }

    public function gerarRelatorio($idRel, Request $request){
        $dados = $request->all();
        $where = [];

        switch ($idRel) {
            case 1:
                $where[] = array("periodo_id", "=", $dados['periodo']);
                $where[] = array("ger.id", "like", $dados['gerencia']);
                $where[] = array("emp.id", "like", $dados['empresa']);
                $where[] = array("user.id", "like", $dados['user']);
                break;
            case 2:
                $where[] = array("periodo_id", "=", $dados['periodo']);
                $where[] = array("user.gerente_id", "like", $dados['gestor']);
                break;
            case 3:
                $where[] = array("periodo_id", "=", $dados['periodo']);
                $where[] = array("ap.conclusao", "=", 1);
                break;

            default:
                # code...
                break;
        }
        RelatorioController::consultaBD($where, $idRel);

        return redirect()->route('relatorio.index');
    }

    public function consultaBD($where, $idRel){

        $relatorio = DB::table('atividade__periodos as ap')
                    ->join('atividades as ativ', 'ativ.id', '=', 'ap.atividade_id')
                    ->join('gerencias as ger', 'ger.id', '=', 'ativ.gerencia_id')
                    ->join('empresas as emp', 'emp.id', '=', 'ativ.empresa_id')
                    ->join('users as user', 'user.id', '=', 'ativ.usuario_id')
                    ->join('periodos as p', 'p.id', '=', 'ap.periodo_id')
                    ->leftjoin('comentarios as coment', function ($join) {
                        $join->on('coment.atividade_periodo_id', '=', 'ap.id')
                             ->where('coment.conclusao', '=', 1);
                    })
                    ->where($where)
                    ->select('p.nome as PERIODO', 'ativ.nome as ATIVIDADE', 'emp.nome as EMPRESA', 
                             'ger.nome as GERENCIA', 'user.nome as RESPONSÁVEL', 
                             'ap.float as DATA', 'ap.float_hora as HORA',
                             'ap.updated_at as CONCLUIDO', 'ap.conclusao as CONCLUSAO',
                             'coment.texto as JUSTIFICATIVA')
                    ->get();

        //dd($relatorio);
        
        foreach ($relatorio as $tag => $rel) {
            $data2 = \Carbon\Carbon::parse($rel->CONCLUIDO)->format('d/m/Y');
            $hora2 = \Carbon\Carbon::parse($rel->CONCLUIDO)->format('H:i');

            $rel->DATA = TarefaController::getDiaDaSemana($rel->PERIODO, $rel->DATA);
            $status = PendenciaController::emAtraso($rel->DATA, $rel->HORA, $data2, $hora2);
            
            
            if($rel->CONCLUSAO == 1){
                if ($status == 1){
                    $rel->STATUS = "Concluído em atraso";
                }else{
                    $rel->STATUS = "Concluído";
                }
                $rel->CONCLUIDO_DATA = $data2;
                $rel->CONCLUIDO_HORA = $hora2;
            }else{
                $rel->STATUS = "Em aberto";
            }

            $tempo = RelatorioController::tempo($rel->DATA, $rel->HORA, $data2, $hora2);

            //dd($tempo);
            if($tempo<1.9 && $tempo>-1.9){
                $rel->TEMPO_HORAS = 0;
            }else{
                $rel->TEMPO_HORAS = $tempo;
            }
            
            /*
            if ($tempo<1.9 && $tempo>-1.9){
                $rel->TEMPO_HORAS = $tempo. " h";
            }else{
                $rel->TEMPO_HORAS = $tempo. " hs";
            }*/


            //"29/03/2018 - 14:00:00 - 29/03/2018 - 14:26"

            //dd($rel);

            


            unset($rel->CONCLUIDO);
            unset($rel->CONCLUSAO);

            if($idRel == 3 && $status == 0){
                unset($relatorio[$tag]);
            }
        }
        
        RelatorioController::excel($relatorio);

        return true;
    }

    public static function tempo($Data1, $Hora1, $Data2, $Hora2){

        //dd($Data1." - ".$Hora1." - ".$Data2." - ".$Hora2);

        //$Data1='06/04/2018'; $Hora1='20:59:00'; $Data2='06/04/2018'; $Hora2='20:48';

        $partesSLAHora = explode(':',$Hora1);
        $partesSLAData = explode('/',$Data1);
        $horaIni = mktime($partesSLAHora[0], $partesSLAHora[1], $partesSLAHora[2], $partesSLAData[1], $partesSLAData[0], $partesSLAData[2]);
        
        $partesEntregueHora = explode(':',$Hora2);
        $partesEntregueData = explode('/',$Data2);
        $horaFim = mktime($partesEntregueHora[0], $partesEntregueHora[1], 0, $partesEntregueData[1], $partesEntregueData[0], $partesEntregueData[2]);
        
        $dif = $horaFim - $horaIni;

            //dia = 86400
            //hora = 3600
        
        //dd($dif/3600 % 24);

        return ($dif/3600 % 24);
        
        
    }

   
    public function excel($dados) {

        $dados= json_decode( json_encode($dados), true);
        $tam = count($dados) + 1;
        
        Excel::create('Relatório', function($excel) use ($dados, $tam) {
    
            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Relatório Encerramento');
            $excel->setCreator('Encerramento Contábil')->setCompany('Confederação Sicredi');
            

            // Build the spreadsheet, data in the data array
            $excel->sheet('Relatório', function($sheet) use ($dados, $tam) {
                $sheet->fromArray($dados);
                $sheet->setStyle([
                    'borders' => [
                        'allborders' => [
                            'color' => [
                                'rgb' => '#000000'
                            ]
                        ]
                    ]
                ]);
                $sheet->row(1, function($row) {
                    // call cell manipulation methods
                    $row->setBackground('#808080');
                    $row->setFontWeight('bold');
                    //$row->setBorder('solid','solid','solid','solid');

                });
                //$sheet->setAllBorders('thin');
                $sheet->setBorder('A1:L'.$tam, 'thin');
                //$sheet->setAutoFilter();
                $sheet->setAutoSize(true);

                
                //dd($sheet);
            });
            
        })->download('xls');

        return true;
    }

}
