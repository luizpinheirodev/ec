<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DateTime;
use Illuminate\Support\Facades\DB;
use Excel;

class PendenciaController extends Controller
{
    public function index($id = null){

        if (isset($id)){
            $pendencia = \App\Atividade_Periodo::where('periodo_id', '=', $id)->get();
        }else{
            $ultPeriodo = DB::table('periodos')->max('id');
            $pendencia = \App\Atividade_Periodo::where('periodo_id', '=', $ultPeriodo)->get();
        }
        $periodos = \App\Periodo::orderBy('id', 'desc')->get();

        $pendencias = $pendencia->sortBy(function($t){
            return sprintf('%-12s%s',  $t->atividade->float, $t->atividade->float_hora);
        });
        
        return view('site.pendencia', compact('pendencias', 'periodos'));
    }

    public function trocaPeriodo($id){

        $pendencias = \App\Atividade_Periodo::where('periodo_id', '=', $id)->get();
        $periodos = \App\Periodo::all();

        return view('site.pendencia', compact('pendencias', 'periodos'));

    }

    public static function emAtraso($Data1, $Hora1, $Data2, $Hora2){

        //dd($Data1." - ".$Hora1." - ".$Data2." - ".$Hora2);

        $partesSLAHora = explode(':',$Hora1);
        $partesSLAData = explode('/',$Data1);
        $horaIni = mktime($partesSLAHora[0], $partesSLAHora[1], $partesSLAHora[2], $partesSLAData[1], $partesSLAData[0], $partesSLAData[2]);
        
        $partesEntregueHora = explode(':',$Hora2);
        $partesEntregueData = explode('/',$Data2);
        $horaFim = mktime($partesEntregueHora[0], $partesEntregueHora[1], 0, $partesEntregueData[1], $partesEntregueData[0], $partesEntregueData[2]);
        
        $dif = $horaFim - $horaIni;

        if($dif > 0){
            return 1;
        }else{
            return 0;
        }
    }

}
