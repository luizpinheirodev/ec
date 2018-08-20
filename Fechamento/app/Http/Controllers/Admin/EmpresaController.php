<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    public function index(){

        $usuario_id = \Auth::id();
        $usuario = \App\User::find($usuario_id);
        if ($usuario->nivel > 2){
            return redirect()->route('home.index');
        }
        
        $empresas = \App\Empresa::all();
        return view('admin.cadastros.empresa.index', compact('empresas'));
    }

    public function salvar(Request $request){
        \App\Empresa::create($request->all());

        \Session::flash('flash_message', [
            'msg'=>"Empresa adicionado com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('empresa.index');
    }

    public function atualizar(Request $request, $id){
        \App\Empresa::find($id)->update($request->all());
        
        \Session::flash('flash_message', [
        'msg'=>"Empresa atualizada!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('empresa.index');
    }

    public function deletar($id){
        $empresa = \App\Empresa::find($id);

        $empresa->delete();

        \Session::flash('flash_message', [
        'msg'=>"Empresa deletada com sucesso!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('empresa.index');
    }
}
