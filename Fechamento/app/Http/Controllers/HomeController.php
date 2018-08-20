<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \DateTime;
//use TarefaController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


/*    public function __construct()
    {
        $this->middleware('auth');
    }
*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ultPeriodo = DB::table('periodos')->max('id');
        $periodos = \App\Periodo::find($ultPeriodo);
        
        $logs = \App\Log::orderBy('created_at', 'desc')->take(5)->get();
        $feriados = \App\Feriado::orderBy('data', 'desc')->take(5)->get();
        $totais = HomeController::getStatus($periodos['id'], $periodos['nome']);

        $ativConc = DB::table('atividade__periodos as ap')
        ->select('e.nome', DB::raw('count(*) as qtd, sum(ap.conclusao) as qtdConc'))
        ->join('atividades as a', 'a.id', '=', 'ap.atividade_id')
        ->join('empresas as e', 'e.id', '=', 'a.empresa_id')
        ->where('periodo_id', '=', $ultPeriodo)
        ->groupBy('e.nome')
        ->orderBy('e.nome', 'asc')
        ->get();

        $usuario_id = \Auth::id();
        $usuario = \App\User::find($usuario_id);

        $dadosAero = \App\Atividade_Periodo::where([
            ['periodo_id',$ultPeriodo],
            ['conclusao', '=', 0]])->get();
            
        $painelAeros = HomeController::painelAero($dadosAero, $periodos['nome']);

        $contasCriticas = DB::table('atividade__periodos as ap')
        ->select(DB::raw('count(*) as qtd, sum(ap.conclusao) as qtdConc'))
        ->join('atividades as a', 'a.id', '=', 'ap.atividade_id')
        ->where([
            ['periodo_id', '=', $ultPeriodo],
            ['a.destaque', '=', 1]
            ])
        ->get();

        //dd($painelAeros);
        //dd(substr($painelAeros[0][0], 0, 10));
            
        if ($usuario->email == 'TV'){
            return view('tv.tv', compact('totais', 'periodos', 'ativTotal', 'ativConc', 'statusTotal', 'painelAeros'));
        }
        $painelJson = json_encode($painelAeros);

        //dd($painelAeros);

        return view('site.home', compact('totais', 'periodos', 'ativTotal', 'ativConc', 'statusTotal', 'logs', 'feriados', 'painelAeros', 'painelJson', 'contasCriticas'));
    }

    public static function buscaTempoLog($dataHora){

        //$dataHora = "2017-10-26 15:55:05";
        $agora = date('Y-m-d H:i:s');

        $date_time = new DateTime($agora);
        $dif = $date_time->diff(new DateTime($dataHora));

        if($dif->y > 0){
            if($dif->y == 1){
                return $dif->y ." ano";
            }else{
                return $dif->y ." anos";
            }
        }elseif($dif->m > 0){
            if($dif->m == 1){
                return $dif->m ." mês";
            }else{
                return $dif->m ." meses";
            }
        }elseif($dif->d > 0){
            if($dif->d == 1){
                return $dif->d ." dia";
            }else{
                return $dif->d ." dias";
            }
        }elseif($dif->h > 0){
            if($dif->h == 1){
                return $dif->h ." hora";
            }else{
                return $dif->h ." horas";
            }
        }elseif($dif->i > 0){
            if($dif->i == 1){
                return $dif->i ." minuto";
            }else{
                return $dif->i ." minutos";
            }
        }elseif($dif->s > 0){
            if($dif->s == 1){
                return $dif->s ." segundo";
            }else{
                return $dif->s ." segundos";
            }
        }
    }

    private function getStatus($ultPeriodo, $mesAno){

        $statusOnTime = \App\Atividade_Periodo::where('periodo_id', '=', $ultPeriodo)->get();
        
        $tarefas = [];
        for ($i=0; $i < count($statusOnTime); $i++) { 
            $data2 = date('d/m/Y');
            $hora2 = date('H:i');
            $concluidoP=0; $concluidoA=0; $emAtraso=0; $nConcluido=0;
            $qtdDay = $statusOnTime[$i]->atividade['float'];
            $data1 = Site\TarefaController::getDiaDaSemana($mesAno, $qtdDay);
            $hora1 = $statusOnTime[$i]->atividade['float_hora'];
            
            if ($statusOnTime[$i]['conclusao'] == 0){
                $concluidoP = 0; $concluidoA = 0; $nConcluido = 1;
                $emAtraso = Site\PendenciaController::emAtraso($data1, $hora1, $data2, $hora2);
            }else{
                $emAtraso = 0; $nConcluido = 0; $concluidoP = 1;
                $data2 = $statusOnTime[$i]['updated_at']->format('d/m/Y');
                $hora2 = $statusOnTime[$i]['updated_at']->format('H:i');
                $concluidoA = Site\PendenciaController::emAtraso($data1, $hora1, $data2, $hora2);
            }
            $tarefas[$i] = new \App\Tarefa($statusOnTime[$i]->atividade['nome'], $statusOnTime[$i]->atividade->empresa['nome'], $concluidoP, $concluidoA, $emAtraso, $nConcluido);
        }

        $totais = \App\Tarefa::contaTotais($tarefas);
        return $totais;
    }

    public function painelAero($dadosAero, $mesAno){

        $painel = array();
        
        for ($i=0; $i < count($dadosAero); $i++) { 
            for ($j=0; $j <= 5; $j++) { 
                $painel[$i][$j] = 0;
            }
        }

        $data2 = date('d/m/Y');
        $hora2 = date('H:i');

        //dd(($dadosAero[0]->atividade->usuario->nome));

        for ($i=0; $i < count($dadosAero); $i++) { 
            
            $painel[$i][2] = $dadosAero[$i]->atividade->gerencia->sigla. " - " .$dadosAero[$i]->atividade->nome;
            $painel[$i][3] = $dadosAero[$i]->atividade->usuario->nome;
            $painel[$i][4] = $dadosAero[$i]->atividade->empresa->nome;
            $data1 = Site\TarefaController::getDiaDaSemana($mesAno, $dadosAero[$i]->atividade->float);
            $data = explode("/", $data1);
            $data = $data[2]."-".$data[1]."-".$data[0]." ".$dadosAero[$i]->atividade->float_hora;
            $painel[$i][0] = $data;
            $painel[$i][1] = $dadosAero[$i]->previsao;

            //dd($data1);
            //dd($dadosAero[$i]->atividade->float_hora);
            //$data2 = date('d/m/Y');
            //$hora2 = date('H:i');

            // "01/03/2018 - 18:00:00 - 06/03/2018 - 11:30"
            $atraso = Site\PendenciaController::emAtraso($data1, $dadosAero[$i]->atividade->float_hora, $data2, $hora2);
            //dd($atraso);
            $painel[$i][5] = $atraso;

        }

        sort($painel);
        
        return $painel;
        

    }
}
