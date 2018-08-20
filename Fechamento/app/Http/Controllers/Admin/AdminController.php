<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){

        $usuario_id = \Auth::id();
        $usuario = \App\User::find($usuario_id);
        if ($usuario->nivel > 2){
            return redirect()->route('home.index');
        }

        $ultPeriodo = DB::table('periodos')->max('id');
        $periodos = \App\Periodo::find($ultPeriodo);    
        return view('admin.home', compact('periodos'));

    }


    public function resultadoSwitch($id){
        //$id = 1;
        $periodo = \App\Periodo::find($id);
        
        if ($periodo->resultado == 0) {
            $periodo->resultado = 1;
        } else {
            $periodo->resultado = 0;
        }
        $periodo->save();
        return redirect()->route('admin.index');
    }

    
    public function periodoSwitch($id){
        //$id = 1;
        $periodo = \App\Periodo::find($id);

        //dd($periodo);
        
        if ($periodo->periodo == 0) {
            $periodo->periodo = 1;
        } else {
            $periodo->periodo = 0;
        }
        $periodo->save();
        return redirect()->route('admin.index');
    }
    
}
