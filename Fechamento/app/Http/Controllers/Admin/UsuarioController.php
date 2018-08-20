<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index(){

        $usuario_id = \Auth::id();
        $usuarioAut = \App\User::find($usuario_id);
        if ($usuarioAut->nivel > 2){
            return redirect()->route('home.index');
        }
        
        $usuarios = \App\User::orderBy('nome')->paginate(40);
        $usuariosG = \App\User::where('nivel', '<=', 3)->orderBy('nome')->get();
        $usuariosBack = \App\User::orderBy('nome')->get();
        $gerencias = \App\Gerencia::orderBy('nome')->get();
        $gerenciasE = \App\Gerencia::orderBy('nome')->get();
        return view('admin.cadastros.usuario.index')->with(compact('usuarioAut', 'usuarios','usuariosG', 'gerencias', 'gerenciasE'));
    }

    public function salvar(Request $request){

        $dados = $request->all();
        $usuario = new \App\User();

        $usuario->nome = $dados['nome'];
        $usuario->email = $dados['email'];
        $usuario->password = bcrypt($dados['password']);
        $usuario->ramal = $dados['ramal'];
        if (isset($dados['gerente_id'])) {
            $usuario->gerente_id = $dados['gerente_id'];
        }
        else{
             $usuario->gerente_id = 1;
        } 
        $usuario->nivel = $dados['nivel'];
        $usuario->gerencia_id = $dados['gerencia_id'];
        
        $usuario->save();

        \Session::flash('flash_message', [
            'msg'=>"Usuario adicionado com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('usuario.index');
    }

    public function atualizar(Request $request, $id){
        $usuario = \App\User::find($id);
        $dados = $request->all();

        $usuario->nome = $dados['nome'];
        $usuario->email = $dados['email'];
        if(isset($dados['password'])){
            $usuario->password = bcrypt($dados['password']);
        }
        $usuario->ramal = $dados['ramal'];
        $usuario->gerencia_id = $dados['gerencia_id'];
        if (isset($dados['gerente_id'])) {
            $usuario->gerente_id = $dados['gerente_id'];
        }
         else{
            $usuario->gerente_id = 1;
        } 
        $usuario->nivel = $dados['nivel'];
        $usuario->save();

        \Session::flash('flash_message', [
        'msg'=>"Usuario atualizado!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('usuario.index');
    }

    public function backup(Request $request, $id){
        $usuario = \App\User::find($id);
        $dados = $request->all();

        $usuario->backup_id = $dados['backup_id'];
        $usuario->save();
        return redirect()->route('usuario.index');
    }

    public function deletar($id){
        
        $atividadesUsuario = \App\Atividade::where('usuario_id', '=', $id)->get();
        //dd(($atividadesUsuario));
        if (count($atividadesUsuario) > 0) {
            \Session::flash('message1', 'Usuario possui atividades em seu nome. Verificar!');
            
            return redirect()->route('usuario.index');
        }
        
        $usuario = \App\User::find($id);
        $usuario->delete();

        \Session::flash('message', [
        'msg'=>"Usuario deletado com sucesso!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('usuario.index');
    }

}
