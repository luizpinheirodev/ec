<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use \DateTime;

class SendDailyTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:dailyTask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de email referente as tarefas diarias';

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
        //dd($day);
        
        // Não rodar final de semana
        if($day > 5){
            exit();
        }

        
        $qtdDay = app('App\Http\Controllers\Site\TarefaController')->getFloat($today);
        //dd($qtdDay);
        
        //$qtdDay = 2; //Teste Chumbado
        

        
        foreach ($users as $user) {
            //dd($user->id);
            $atividades = DB::table('users as u')
                ->join('atividade__periodos as ap', 'u.id', '=', 'ap.user_id')
                ->join('atividades as at', 'at.id', '=', 'ap.atividade_id')
                ->join('gerencias as ger', 'ger.id', '=', 'at.gerencia_id')
                ->join('empresas as emp', 'emp.id', '=', 'empresa_id')
                ->join('periodos as p', 'p.id', '=', 'ap.periodo_id')
                ->where([
                    ['ap.periodo_id', '=', $periodo],
                    ['ap.conclusao', '=', 0],
                    ['ap.user_id', '=', $user->id],
                    ['at.float', '<=', $qtdDay]
                ])
                ->select('u.nome as nome', 'u.email as email', 'at.nome as atividade', 'at.float as float', 
                         'at.float_hora as hora', 'p.nome as periodo', 'ger.nome as gerencia', 'emp.nome as empresa')
                ->get();


            if (count($atividades) > 0){
                $data = array();
                foreach ($atividades as $ativ) {
                    $day = app('App\Http\Controllers\Site\TarefaController')->getDiaDaSemana($ativ->periodo, $ativ->float);
                    $data[] = ['nome' => $ativ->nome, 
                            'atividade' => $ativ->atividade,
                            'gerencia' => $ativ->gerencia,
                            'empresa' => $ativ->empresa,
                            'data' => $day,
                            'horario' => $ativ->hora];
                }

                $template_path = 'mails.relatorio_diario_atividades';
                Mail::send(['html'=> $template_path ], ['dados' => $data], function($message) use ($user) {
                    // Set the receiver and subject of the mail.
                    $message->to($user->email."@sicredi.com.br", $user->nome)->subject('Tarefas diárias de encerramento!');
                    // Set the sender
                    $message->from('noreply@sicredi.com.br', 'No-Reply');
                });
        
            }
        }
    }
}
