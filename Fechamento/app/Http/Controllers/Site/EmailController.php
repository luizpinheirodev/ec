<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\EnviarEmailTarefa;
use Illuminate\Support\Facades\Mail;
//use Mail;
use View;

class EmailController extends Controller
{
    public function index($ativ){

        foreach($ativ as $at){
            $data = array('nome'=>$at->ativNome, 'nomeAtivConc'=>$at->ativNomeConc);
            // Path or name to the blade template to be rendered
            //$nome = $at->ativNome; 
            //$template_path = view('mails.email_template', compact('nome'));
            //$template_path = new EnviarEmailTarefa($nome);
            //dd($template_path);

            $template_path = 'mails.email_template';
            Mail::send(['html'=> $template_path ], $data, function($message) {
                // Set the receiver and subject of the mail.
                $message->to('luizpinheiro.rs@gmail.com', 'Luiz')->subject('Aviso de tarefa antecessora concluída');
                // Set the sender
                $message->from('luizao_jj@hotmail.com','NoReply');
            });

            //echo $at->userEmail;
        }
        

    }

    


}
