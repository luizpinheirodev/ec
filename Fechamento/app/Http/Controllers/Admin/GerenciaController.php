<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GerenciaController extends Controller
{
    public function index(){

        $usuario_id = \Auth::id();
        $usuario = \App\User::find($usuario_id);
        if ($usuario->nivel > 2){
            return redirect()->route('home.index');
        }
        
        $gerencias = \App\Gerencia::all();
        return view('admin.cadastros.gerencia.index', compact('gerencias'));
    }

    public function salvar(Request $request){
        \App\Gerencia::create($request->all());

        \Session::flash('flash_message', [
            'msg'=>"Gerência adicionado com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('gerencia.index');
    }

    /*
    public function editar($id){
        $gerencia = \App\Gerencia::find($id);
        if(!$gerencia){
            \Session::flash('flash_message', [
            'msg'=>"Gerencia não encontrada!",
            'class'=>"alert-danger"
            ]);
            return redirect()->route('admin.cadastros.gerencia.index');
        }
        return view('admin.cadastros.gerencia.index', compact('gerencia'));
    }
    */

    public function atualizar(Request $request, $id){
        \App\Gerencia::find($id)->update($request->all());
        
        \Session::flash('flash_message', [
        'msg'=>"Gerencia atualizada!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('gerencia.index');
    }

    public function deletar($id){
        $gerencia = \App\Gerencia::find($id);

        $gerencia->delete();

        \Session::flash('flash_message', [
        'msg'=>"Cliente deletado com sucesso!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('gerencia.index');
    }

}
