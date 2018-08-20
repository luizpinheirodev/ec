<?php

/**
 * Example of JSON data for calendar
 *
 * @package zabuto_calendar
 */
//$_REQUEST['year'] = '2018';
//$_REQUEST['month'] = '04';

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \DateTime;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Requests;

class CalendarioController{

    public function index(){

             
        $ultPeriodo = DB::table('periodos')->max('id');
        $periodos = \App\Periodo::find($ultPeriodo);

        $dates = array();
        
        $dia = -2;
        //$dia = 4;

        $ind = 0;
        for($d = 0; $d < 20; $d++){
            $dadosAero = \App\Atividade_Periodo::where([
                ['periodo_id',$ultPeriodo],
                ['conclusao', '=', 0],
                ['float', '=', $dia],
                ])->get();
            
            $p = app('App\Http\Controllers\HomeController')->painelAero($dadosAero, $periodos['nome']);
                
            //dd(isset($p[0]));

            if(isset($p[0])) {

                $date = substr($p[0][0], 0, 10);
                $dados = '<table><thead><tr><th>Atividade</th><th>Empresa</th><th>Responsável</th><th>Hora</th><th>Previsão</th></tr></thead><tbody>';
                for ($i = 0; $i < count($p); $i++) {
                    if($p[$i][1] == null){
                        $previsao = "";
                    }else{
                        $previsao = \Carbon\Carbon::parse($p[$i][1])->format('d/m - H:i');
                    }
                    $dados = $dados. '<tr><td>'.$p[$i][2].'</td><td>'.$p[$i][4].'</td><td>'.$p[$i][3].'</td><td>'.\Carbon\Carbon::parse($p[$i][0])->format('H:i').'</td><td>'.$previsao.'</td></tr>';
                }    
                $dados = $dados. '</tbody></table>';
                $footer = '<a href='. route('customizado.dia', $dia). ' class="modalM-action modalM-close waves-effect waves-green btn-flat">Todos</a>';

                $dates[$ind] = array(
                    'date' => $date,
                    'badge' => false,
                    'title' => 'Atividades de ' . \Carbon\Carbon::parse($p[0][0])->format('d/m/Y'),
                    'body' => $dados,
                    'footer' => $footer,
                );
                $ind++;
                
            }
            $dia++;

        }

            //dd($dates);
            echo json_encode($dates);
           
    }


}