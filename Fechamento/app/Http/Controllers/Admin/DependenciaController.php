<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DependenciaController extends Controller
{
    public function index(){

        $usuario_id = \Auth::id();
        $usuario = \App\User::find($usuario_id);
        if ($usuario->nivel > 2){
            return redirect()->route('home.index');
        }
        
        $dependencias = \App\Dependencia::all();
        $atividades = \App\Atividade::all();
        $atividades1 = \App\Atividade::all();
        $atividades2 = \App\Atividade::all();
        $gerencias = \App\Gerencia::all();
        $empresas = \App\Empresa::all();
        return view('admin.cadastros.dependencia.index', compact('dependencias', 'atividades', 'gerencias', 'empresas', 'atividades1', 'atividades2'));
    }

    public function salvar(Request $request){
        \App\Dependencia::create($request->all());

        \Session::flash('flash_message', [
            'msg'=>"Dependencia adicionada com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('dependencia.index');
    }

    public function atualizar(Request $request, $id){
        \App\Dependencia::find($id)->update($request->all());
        
        \Session::flash('flash_message', [
        'msg'=>"Dependencia atualizada!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('dependencia.index');
    }

    public function deletar($id){
        $dependencia = \App\Dependencia::find($id);

        $dependencia->delete();

        \Session::flash('flash_message', [
        'msg'=>"Dependencia deletada com sucesso!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('dependencia.index');
    }
}
