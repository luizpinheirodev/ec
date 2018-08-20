<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeriodoController extends Controller
{
    public function index(){

        $usuario_id = \Auth::id();
        $usuario = \App\User::find($usuario_id);
        if ($usuario->nivel > 2){
            return redirect()->route('home.index');
        }
        
        $periodos = \App\Periodo::all();
        return view('admin.cadastros.periodo.index', compact('periodos'));
    }

    public function salvar(Request $request){

        \App\Periodo::create($request->all());

        \Session::flash('flash_message', [
            'msg'=>"Periodo adicionado com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('periodo.index');
    }

    public function atualizar(Request $request, $id){

        $dados = $request->all();
        
        $periodo = \App\Periodo::find($id);

        $periodo->diasfechamento = $dados['diasfechamento'];
        $periodo->comentario = nl2br($dados['comentario']);
        $periodo->atingimento = $dados['atingimento'];


        //dd(nl2br($periodo->comentario));
        
        $periodo->save();
        
        \Session::flash('flash_message', [
        'msg'=>"Periodo atualizada!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('periodo.index');
    }

    public function deletar($id){
        $periodo = \App\Periodo::find($id);

        $periodo->delete();

        \Session::flash('flash_message', [
        'msg'=>"Periodo deletada com sucesso!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('periodo.index');
    }
}
