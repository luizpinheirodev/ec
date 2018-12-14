<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use \DateTime;

class SendNoPrevision extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:noPrevision';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = \App\User::all();
        $periodo = DB::table('periodos')->max('id');

        
        $today = new DateTime( date('Y-m-d') );
        $day = $today->format('N');
        
        // Não rodar final de semana
        if($day > 5){
            exit();
        }
        $qtdDay = app('App\Http\Controllers\Site\TarefaController')->getFloat($today);
        //$qtdDay = 2;

        //dd($qtdDay);

        $hour = new DateTime( date('Y-m-d H:i:s') );

        if($hour->format('H') > 20 || $hour->format('H') < 8){
            exit();
        }

        $hourIni = $hour->format('H').":".($hour->format('i') - 15).":00";
        //$hourFim = $hour->format('H').":".($hour->format('i') + 44).":00";

        //$hourIni = "11:00:00";
        //dd($hourIni);
        //"14:12:00"

        $prev = new DateTime( date('Y-m-d H:i:s') );
        //dd($prev->format('Y-m-d H:i:s'));

        //2018-03-02 13:00:00

        
        foreach ($users as $user) {
            
            $atividades = DB::table('users as u')
                ->join('atividade__periodos as ap', 'u.id', '=', 'ap.user_id')
                ->join('atividades as at', 'at.id', '=', 'ap.atividade_id')
                ->join('gerencias as ger', 'ger.id', '=', 'at.gerencia_id')
                ->join('empresas as emp', 'emp.id', '=', 'empresa_id')
                ->join('periodos as p', 'p.id', '=', 'ap.periodo_id')
                ->where(function ($query) use($qtdDay, $hourIni) {
                    $query->where([
                                ['at.float', '=', $qtdDay],
                                ['at.float_hora', '<=', $hourIni]
                                ])
                          ->orWhere('at.float', '<', $qtdDay);
                        })
                ->where(function ($query2) use ($hourIni, $prev) {
                    $query2->whereNull('ap.previsao')
                          ->orWhere('ap.previsao', '<', $prev);
                })
                ->where([
                    ['ap.periodo_id', '=', $periodo],
                    ['ap.conclusao', '=', 0],
                    ['ap.user_id', '=', $user->id],
                    ['at.float', '<=', $qtdDay]
                ])
                ->select('u.nome as nome', 'u.email as email', 'at.nome as atividade', 'at.float as float', 
                         'at.float_hora as hora', 'p.nome as periodo', 'ger.nome as gerencia', 'emp.nome as empresa',
                         'ap.previsao as previsao')
                //->toSql();
                ->get();

            //echo $atividades;
            
            if (count($atividades) > 0){
                $data = array();
                foreach ($atividades as $ativ) {
                    $day = app('App\Http\Controllers\Site\TarefaController')->getDiaDaSemana($ativ->periodo, $ativ->float);
                    $data[] = ['nome' => $ativ->nome, 
                            'atividade' => $ativ->atividade,
                            'gerencia' => $ativ->gerencia,
                            'empresa' => $ativ->empresa,
                            'data' => $day,
                            'horario' => $ativ->hora,
                            'previsao' => $ativ->previsao];
                }

                //$to = $user->email."@sicredi.com.br";
                //$toName = $user->nome;
                //dd($to);
                //dd($atividades);

                //dd($user->gerente->email);
                
                $template_path = 'mails.relatorio_atividades_sem_prev';
                Mail::send(['html'=> $template_path ], ['dados' => $data], function($message) use ($user) {
                    // Set the receiver and subject of the mail.
                    $message->to($user->email."@sicredi.com.br", $user->nome)->subject('Tarefas de encerramento sem previsão!');
                    //$message->cc($user->gerente->email."@sicredi.com.br");
                    //Set the sender
                    $message->from('noreply@sicredi.com.br', 'No-Reply');
                });
            }
        }
    }
}
