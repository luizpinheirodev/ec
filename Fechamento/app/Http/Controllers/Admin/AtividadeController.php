<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AtividadeController extends Controller
{
    public function index(){

        $usuario_id = \Auth::id();
        $usuario = \App\User::find($usuario_id);
        if ($usuario->nivel > 2){
            return redirect()->route('home.index');
        }
        $atividades = \App\Atividade::orderBy('nome')->paginate(40);
        $usuarios = \App\User::orderBy('nome')->get();
        $gerencias = \App\Gerencia::orderBy('nome')->get();
        $empresas = \App\Empresa::orderBy('nome')->get();

        $usuariosEd = \App\User::orderBy('nome')->get();
        $gerenciasEd = \App\Gerencia::orderBy('nome')->get();
        $empresasEd = \App\Empresa::orderBy('nome')->get();



        //BACKUP APENAS USUARIO DA MESMA GERENCIA DA ATIVIDADE
        //$atividadesBack = \App\User::orderBy('nome')->where('gerencia_id', '=', $usuario->gerencia_id)->get();
        

        return view('admin.cadastros.atividade.index', compact('atividades','usuarios','gerencias','empresas',
                                                                'usuariosEd','gerenciasEd','empresasEd'));
    }

    public static function ativBackup($id){
        $atividadesBack = \App\User::orderBy('nome')->where('gerencia_id', '=', $id)->get();
        $options = null;
        foreach ($atividadesBack as $ativBack) {
            $options = $options. '<option value="'.$ativBack->id.'">' .$ativBack->nome. '</option>' ;
        }
        
        echo $options;
    }

    public function salvar(Request $request){

        \App\Atividade::create($request->all());


        \Session::flash('flash_message', [
            'msg'=>"Atividade adicionada com sucesso",
            'class'=>"alert-success"
        ]);

        return redirect()->route('atividade.index');
    }

    public function atualizar(Request $request, $id){

        //dd($request);

        \App\Atividade::find($id)->update($request->all());
        
        \Session::flash('flash_message', [
        'msg'=>"Atividade atualizada!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('atividade.index');
    }

    public function backup(Request $request, $id){
        $atividade = \App\Atividade::find($id);
        $dados = $request->all();

        //dd($dados);
        
        $atividade->backup_id = $dados['backup_id'];
        $atividade->save();
        return redirect()->route('atividade.index');
    }

    public function deletar($id){
        $atividade = \App\Atividade::find($id);

        $atividade->delete();

        \Session::flash('flash_message', [
        'msg'=>"Atividade deletada com sucesso!",
        'class'=>"alert-success"
        ]);
        return redirect()->route('atividade.index');
    }
}
