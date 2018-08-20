<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Requests;

class ComentarioController extends Controller
{
    public function index(){
        $comentarios = \App\Comentario::where('resposta_id', '=', null)
            ->orderby('created_at', 'desc')
            ->get();
        $respostas = \App\Comentario::where('resposta_id', '!=', null)
            ->orderby('created_at', 'desc')
            ->get();
        $tarefas = \App\Atividade_Periodo::all();

        $logs = \App\Log::orderBy('created_at', 'desc')->get();

        return view('site.comentario', compact('comentarios', 'respostas', 'tarefas', 'logs'));
    }

    public function salvar(Request $request){

        $dados = $request->all();
        $comentadoPor = \Auth::id();
        
        $comentario = new \App\Comentario();
        $comentario->texto = $dados['texto'];
        $comentario->usuario_id = $comentadoPor;
        if (isset($dados['atividade_periodo_id'])) {
            $comentario->atividade_periodo_id = $dados['atividade_periodo_id'];
        }
         else{
            $comentario->atividade_periodo_id = null;
        } 

        if (isset($dados['anexo'])){
            $file = $request->file('anexo');
            $destinationPath = 'uploads\comentarios';
            $anexoNome = $comentadoPor. " " . date('Y-m-d H-i-s') . " arquser " . $file->getClientOriginalName();
            $file->move($destinationPath,$anexoNome);
            $comentario->anexo = $anexoNome;
        }

        $comentario->save();

        \Session::flash('flash_message', [
            'msg'=>"Comentário adicionada com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('comentario.index');
    }

    public function responder(Request $request, $id){

        $dados = $request->all();
        $respondidoPor = \Auth::id();

        $resposta = new \App\Comentario();
        $resposta->texto = $dados['text-resposta'];
        $resposta->usuario_id = $respondidoPor;
        $resposta->resposta_id = $id;

        $resposta->save();

        \Session::flash('flash_message', [
            'msg'=>"Resposta adicionada com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('comentario.index');
    }


    // corrigir a função para esconder a url de download no view
    /*
    public static function baixar(){
        $id = 9;
        $anexo = \App\Comentario::find($id);
        $anexo = ($anexo->anexo);

        //public_path()

        $anexo = public_path('uploads/comentarios/' . $anexo);
        //$anexo= "/uploads/comentarios/" . $anexo;

        //dd($anexo);
        return response()->download($anexo);

        //URL::to( '/uploads/comentarios/' . $comentario->anexo)  
    }
    */

}
