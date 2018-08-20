<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use \DateTime;

class Send5minLate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:lateTasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio das tarefas atrasadas';

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

        $hour = new DateTime(date('H:i:s'));
        
        
        $hourIni = $hour->format('H').":".($hour->format('i') - 10).":00";
        $hourFim = $hour->format('H').":".($hour->format('i') - 1).":00";

        //$hourIni = "10:00:00";
        //dd($hourFim);
        
        foreach ($users as $user) {
            
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
                    ['at.float', '=', $qtdDay]
                    //['at.float_hora', '=', $hourIni]
                ])
                ->whereBetween('at.float_hora', [$hourIni, $hourFim])
                ->select('u.nome as nome', 'u.email as email', 'at.nome as atividade', 'at.float as float', 
                         'at.float_hora as hora', 'p.nome as periodo', 'ger.nome as gerencia', 'emp.nome as empresa',
                         'ap.previsao as previsao')
                ->get();

            //dd($atividades);
            
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

                //dd($user->gerente->nome);
                
                $template_path = 'mails.relatorio_atividades_vencidas';
                Mail::send(['html'=> $template_path ], ['dados' => $data], function($message) use ($user) {
                    // Set the receiver and subject of the mail.
                    $message->to($user->email."@sicredi.com.br", $user->nome)
                            ->cc($user->gerente->email."@sicredi.com.br", $user->gerente->nome)
                            ->subject('Tarefa de encerramento atrasada!');
                    //Set the sender
                    $message->from('noreply@sicredi.com.br', 'No-Reply');
                });
                
            }
        }
    }
}
