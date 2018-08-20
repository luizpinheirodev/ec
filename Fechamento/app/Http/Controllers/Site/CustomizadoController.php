<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DateTime;
use Illuminate\Support\Facades\DB;
use Excel;

class CustomizadoController extends Controller
{
    public function index(){

        $empresas = \App\Empresa::orderBy('nome')->get();
        $gerencias = \App\Gerencia::orderBy('nome')->get();

        return view('site.customizado', compact('gerencias', 'empresas'));
    }

    public function empresa($id){

        $empresas = \App\Empresa::orderBy('nome')->get();
        $gerencias = \App\Gerencia::orderBy('nome')->get();
        $ultPeriodo = DB::table('periodos')->max('id'); 

        $relatorio = \App\Atividade_Periodo::whereIn('atividade_id', function($query) use ($id){
                $query->select('id')
                      ->from(with(new \App\Atividade)->getTable())
                      ->where('empresa_id', '=', $id);
                })
                ->where('periodo_id', '=', $ultPeriodo)
                ->get();

        return view('site.customizado', compact('relatorio', 'gerencias', 'empresas'));
    }

    public function gerencia($id){

        $empresas = \App\Empresa::orderBy('nome')->get();
        $gerencias = \App\Gerencia::orderBy('nome')->get();
        $ultPeriodo = DB::table('periodos')->max('id'); 
        

        $relatorio = \App\Atividade_Periodo::whereIn('atividade_id', function($query) use ($id){
                $query->select('id')
                      ->from(with(new \App\Atividade)->getTable())
                      ->where('gerencia_id', '=', $id);
                })
                ->where('periodo_id', '=', $ultPeriodo)
                ->get();

        return view('site.customizado', compact('relatorio', 'gerencias', 'empresas'));
    }

    public function dia($id){

        $empresas = \App\Empresa::orderBy('nome')->get();
        $gerencias = \App\Gerencia::orderBy('nome')->get();
        $ultPeriodo = DB::table('periodos')->max('id'); 
        

        $relatorio = \App\Atividade_Periodo::where([
                                            ['float', '=', $id],
                                            ['periodo_id', '=', $ultPeriodo],
                                            ])->get();

        return view('site.customizado', compact('relatorio', 'gerencias', 'empresas'));
    }
    
}
