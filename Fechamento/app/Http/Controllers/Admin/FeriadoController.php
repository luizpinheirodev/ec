<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeriadoController extends Controller
{
    public function index(){

        $usuario_id = \Auth::id();
        $usuario = \App\User::find($usuario_id);
        if ($usuario->nivel > 2){
            return redirect()->route('home.index');
        }
        
        $feriados = \App\Feriado::all();
        return view('admin.cadastros.feriado.index', compact('feriados'));
    }

    public function salvar(Request $request){

        $dados = $request->all();
        $feriado = new \App\Feriado();
        $dia = FeriadoController::convData($dados['data'], '/', '-');

        $feriado->nome = $dados['nome'];
        $feriado->data = $dia;

        $feriado->save();
        
        \Session::flash('flash_message', [
            'msg'=>"Feriado adicionado com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('feriado.index');
    }

    public function atualizar(Request $request, $id){

        $dados = $request->all();
        $feriado = \App\Feriado::find($id);
        
        $dia = FeriadoController::convData($dados['data'], '/', '-');

        $feriado->nome = $dados['nome'];
        $feriado->data = $dia;
        
        $feriado->save();

        \Session::flash('flash_message', [
        'msg'=>"Feriado atualizado!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('feriado.index');
    }

    public function deletar($id){
        $feriado = \App\Feriado::find($id);

        $feriado->delete();

        \Session::flash('flash_message', [
        'msg'=>"Feriado deletado com sucesso!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('feriado.index');
    }

    function convData($data, $se, $ss){
        return implode($ss, array_reverse(explode($se, $data)));
    }
    
}