<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;
use \DateTime;
use Validator;
//use App\Http\Controllers\Site\TarefaController;


class TarefaController extends Controller
{

    public function index(){
        $usuario_id = \Auth::id();

        $usuario = \App\User::find($usuario_id);
        $ultPeriodo = DB::table('periodos')->max('id');
        //dd($usuario->backup['nome']);

        if ($usuario->nivel <= 2){
            //CASO USUARIO ADMIN OU DEV, TRAZER TODAS ATIVIDADES DO PERIODO
            
            $tarefa = \App\Atividade_Periodo::where('periodo_id', '=', $ultPeriodo)
            //->where('id', '=', '3461')
            ->get();
            
        }elseif ($usuario->nivel == 3){
            //CASO USUARIO SEJA GESTOR, PESQUISAR AS SUAS TAREFAS E AS TAREFAS DOS SEUS SUBORDINADOS
            $tarefa = \App\Atividade_Periodo::whereIn('user_id', function($query){
                $query->select('id')
                      ->from(with(new \App\User)->getTable())
                      ->where(function($query2){
                          $query2->where('id', '=', \Auth::id())
                                 ->orWhere('gerente_id', '=', \Auth::id());
                      });
            })
            ->where('periodo_id', '=', $ultPeriodo)
            ->get();

        }else{
            //CASO USUARIO SEJA ANALISTA E BACKUP, PESQUISAR AS SUAS TAREFAS E AS TAREFAS DE QUEM É BACKUP
            
            $tarefa = \App\Atividade_Periodo::whereIn('atividade_id', function($query) use ($usuario_id) {
                $query->select('id')
                      ->from(with(new \App\Atividade)->getTable())
                        ->where(function($query2) use ($usuario_id){
                            $query2->where('user_id', '=', $usuario_id)
                                    ->orWhere('backup_id', '=', $usuario_id);
                      });
            })
            ->where('periodo_id', '=', $ultPeriodo)
            ->get();
        }

        $tarefas = $tarefa->sortBy(function($t){
            return sprintf('%-12s%s',  $t->atividade->float, $t->atividade->float_hora);
        });

        return view('site.tarefa', compact('tarefas'));
    }

    public static function podeConcluir($id){

        $periodo = DB::table('periodos')->max('id');

        $ativ = DB::table('atividade__periodos AS ap')
            ->select(
                'ativ.nome as nome', 'ativ.float as float', 'ativ.float_hora as floathora',
                'emp.nome as empresa', 'ger.sigla as sigla', 'users.nome as resp'
            )
            ->join('dependencias as dep', 'ap.atividade_id', '=', 'dep.atividade_id1')
            ->join('atividade__periodos as ap2', 'ap2.atividade_id', '=', 'dep.atividade_id2')
            ->join('atividades as ativ', 'ativ.id', '=', 'ap2.atividade_id')
            ->join('empresas as emp', 'emp.id', '=', 'ativ.empresa_id')
            ->join('gerencias as ger', 'ger.id', '=', 'ativ.gerencia_id')
            ->join('users as users', 'users.id', '=', 'ativ.usuario_id')
            
            ->where('ap.atividade_id', '=', $id)
            ->where('ap2.conclusao', '=', '0')
            ->where('ap.periodo_id', '=', $periodo)
            ->where('ap2.periodo_id', '=', $periodo)
            ->get();
        
        return $ativ;
    }

    public function concluir($idTarefa, $idAtiv){   

        $ativ = DB::table('dependencias as dep')
            ->select('ativ.nome as ativNome', 'users.nome as userNome', 'users.email as userEmail', 'ativ2.nome as ativNomeConc')
            
            ->join('atividades as ativ', 'dep.atividade_id1', '=', 'ativ.id')
            ->join('users as users', 'ativ.usuario_id', '=', 'users.id')
            ->join('atividades as ativ2', 'dep.atividade_id2', '=', 'ativ2.id')

            ->where('dep.atividade_id2', '=', $idAtiv)
            ->get();
            
        
        //VERIFICAR SE ATIVIDADE ESTA EM ATRASO PARA SOLICITAR JUSTIFICATIVA
        $atividade_periodo = \App\Atividade_Periodo::find($idTarefa);
        $ultPeriodo = DB::table('periodos')->max('id');
        $periodo = \App\Periodo::find($ultPeriodo);

        $data1 = TarefaController::getDiaDaSemana($periodo['nome'], $atividade_periodo->float);
        $hora1 = $atividade_periodo->float_hora;
        $data2 = date('d/m/Y');
        $hora2 = date('H:i');
        $emAtraso = PendenciaController::emAtraso($data1, $hora1, $data2, $hora2);
        
        
        if ($emAtraso == 1) {
            return view('site.tarefaJust', compact('atividade_periodo'));
        }
        
        
        //Função Funcionando - Ativar para enviar email  
        if (count($ativ) > 0){
            //app('App\Http\Controllers\Site\EmailController')->index($ativ);
        }
        $concluidoPor = \Auth::id();

        //--- GRAVA LOG --//
        $log = new \App\Log();
        $log->nome = 'ativ-perio';
        $log->user_id = $concluidoPor;
        $log->atividade_periodo_id = $idTarefa;
        $log->tipo = 'concluiu tarefa';
        $log->save();

        $atividade_periodo->conclusao = 1;
        $atividade_periodo->concluido_user_id = $concluidoPor;
        $atividade_periodo->save();

        

        return redirect()->route('tarefa.index');
    }



    public function concluirAtraso(Request $request, $idTarefa){
        $dados = $request->all();
        $comentario = new \App\Comentario();
        $atividade_periodo = \App\Atividade_Periodo::find($idTarefa);

        switch ($dados['group1']) {
            case 'um':
                $comentario->texto = "Atraso de dependência. ".$dados['texto'];
                break;
            case 'dois':
                $comentario->texto = "Erro de sistema. ".$dados['texto'];
                break;
            default:
                $comentario->texto = $dados['texto'];
                break;
        }

        $user = \Auth::id();

        $comentario->usuario_id = $user;
        $comentario->atividade_periodo_id = $idTarefa;
        $comentario->conclusao = 1; // Conclusao 1 para relatório em excel
        $comentario->save();

        
        $log = new \App\Log();
        $log->nome = 'ativ-perio';
        $log->user_id = $user;
        $log->atividade_periodo_id = $idTarefa;
        $log->tipo = 'concluiu tarefa';
        $log->save();
        
        $atividade_periodo->conclusao = 1;
        $atividade_periodo->concluido_user_id = $user;
        $atividade_periodo->save();

        return redirect()->route('tarefa.index');
    }


    public function reabrir($id){
        
        $atividade_periodo = \App\Atividade_Periodo::find($id);

        $atividade_periodo->conclusao = 0;
        $atividade_periodo->save();

        return redirect()->route('tarefa.index');
    }

    protected function validarPrevisao($request){
        $validator = Validator::make($request->all(),[
            'dataPrev' => 'required',
            'horaPrev' => 'required',
            'texto' => 'required',
            ]);
        return $validator;
    }

    public function previsao(Request $request, $id){

        //--- GRAVA PREVISÃO NA TABELA ATIVIDADE_PERIODO --//
        $validator = $this->validarPrevisao($request);
        if($validator->fails()){
            $errors = "Campo não preenchido";
            return redirect()->route('tarefa.index')->withErrors($errors);
        }

        //--- GRAVA PREVISÃO --//
        $atividade_periodo = \App\Atividade_Periodo::find($id);
        $dados = $request->all();
        $usuario = $atividade_periodo->user_id;
        $dia = TarefaController::convData($dados['dataPrev'], '/', '-');
        $hora = $dados['horaPrev'];
        $previsao = $dia.' '.$hora.':00';
        $atividade_periodo->previsao = $previsao;
        $atividade_periodo->save();

        //--- GRAVA MOTIVO NA TABELA COMENTARIOS --//
        $comment = new \App\Comentario();
        $comment->texto = $dados['texto'];
        $comment->usuario_id = \Auth::id();
        $comment->atividade_periodo_id = $atividade_periodo->id;
        $comment->save();

        //--- GRAVA LOG --//
        $log = new \App\Log();
        $log->nome = 'ativ-perio';
        $log->user_id = \Auth::id();
        $log->atividade_periodo_id = $id;
        $log->tipo = 'postergou';
        $log->save();
        
        return redirect()->route('tarefa.index');
    }

    function convData($data, $se, $ss){
        return implode($ss, array_reverse(explode($se, $data)));
    }


    public static function getDiaDaSemana($mesAno, $qtdDay){ 
        
        $dia = 86400;
        $mes = substr($mesAno, 0, 2);
        $ano = substr($mesAno, 3, 4);

        //dd($qtdDay);
        
        /*
        if ($qtdDay <= -15){

            //NÃO ESTA TRATADO O FERIADO para 15 e 20 dias
            $lastDay = date('m/d/Y', mktime(0, 0, 0, $mes, -$qtdDay, $ano));
            $weekDay = date('N', mktime(0, 0, 0, $mes, -$qtdDay, $ano));
            if ($weekDay > 5){
                $firstDay = strtotime($lastDay . ' +1 Weekday');
            }else{
                $firstDay = strtotime($lastDay);
            }
            return date('d/m/Y', $firstDay);
        }*/
        
        $mes = $mes + 1;
        
        //dd($qtdDay);
        
        if ($qtdDay > 0){
            $lastDay = date('m/d/Y', mktime(0, 0, 0, $mes, 0, $ano));
            $firstDay = strtotime($lastDay . ' +'.$qtdDay.' Weekday');
        }else{
            $lastDay = date('m/d/Y', mktime(0, 0, 0, $mes, 1, $ano));
            $firstDay = strtotime($lastDay . ' +'.$qtdDay.' Weekday');
        }

        
        //dd(($lastDay));

        //dd(strtotime($lastDay));
        //dd(date('d/m/Y H:i:s', $firstDay));
        //dd($firstDay);
        

        //dd(date('d/m/Y', $firstDay));
        /*if (date('d', mktime(0, 0, 0, $mes, 0, $ano)) == "31" && $qtdDay < 0){
            $qtdDay = $qtdDay + 1;
        }*/
        
        
        //$lastDay = date('m/d/Y', mktime(0, 0, 0, $mes, 0, $ano));
        //$firstDay = strtotime($lastDay . ' +'.$qtdDay.' Weekday');

        $feriados = \App\Feriado::all();
        //dd($feriados);

        if($qtdDay > 0){
            //dd($qtdDay);
            /*foreach($feriados as $f){
                echo $f->data ." -> ". strtotime($f->data)."\n";
            }*/


            while (strtotime($lastDay) < ($firstDay)){
                //echo date('Y-m-d', $firstDay);
                foreach($feriados as $feriado){
                    //echo "  ----------------------------------      ";
                    //echo $feriado->data. " - ";
                    if ((($feriado->data)) == date('Y-m-d', $firstDay) ){
                        //dd("oi");
                        $qtdDay++;
                        $firstDay = $firstDay - $dia;
                    }
                }
                $firstDay = $firstDay - $dia;
            }
        }else{
            //dd(date('d/m/Y', $firstDay));
            //dd(date('d/m/Y', strtotime($lastDay)));
            while (($firstDay) < strtotime($lastDay)){
                foreach($feriados as $feriado){
                    if ( strtotime($feriado->data) == ($firstDay) ){
                        $qtdDay--;
                        $firstDay = $firstDay + $dia;
                    }
                }
                $firstDay = $firstDay + $dia;
            }
        }
        //dd($qtdDay);

        $firstDay = strtotime($lastDay . ' +'.$qtdDay.' Weekday');
        //dd(date('d/m/Y H:i:s', $firstDay));
        return date('d/m/Y', $firstDay);
    }



    public function getFloat($today){

        $day = $today->format('d');
        $month = $today->format('m');
        $year = $today->format('Y');

        if ($day >= 15){
            $month = $month + 1;
        }

        $startDate = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year)); // "2018-04-01"; //First day of month
        $endDate = $today->format('Y-m-d'); // "2018-04-03"; //current day

        $qtdDay = TarefaController::getWorkingDays($startDate, $endDate);
        //dd($qtdDay);

        return $qtdDay;

    }

    function getWorkingDays($startDate, $endDate){
        $begin = strtotime($startDate);
        $end   = strtotime($endDate);
        //dd($end);
        $beginF = $begin; //1517450400
        $endF = $end;   //1517623200

        $feriados = \App\Feriado::all();
        $temp = 1;
        if ($begin > $end) {
            $temp = $begin; $begin = $end; $end = $temp; $temp = -1;

            $tempF = $beginF; $beginF = $endF; $endF = $tempF;
        } 
        $no_days  = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends;

      
        while ($endF >= $beginF){
            foreach($feriados as $feriado){
                if ( strtotime($feriado->data) == ($endF) ){
                    $working_days--;
                    $endF = $endF - 86400;
                    //dd($working_days);
                }
            }
            $endF = $endF - 86400;
        }

        return $working_days * $temp;

    }

    


}
