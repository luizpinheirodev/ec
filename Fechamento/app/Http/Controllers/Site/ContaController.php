<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DateTime;
use Illuminate\Support\Facades\DB;

class ContaController extends Controller
{
    public function index(){

        $ultPeriodo = DB::table('periodos')->max('id');
        
        $contas = \App\Atividade_Periodo::whereIn('atividade_id', function($query){
            $query->select('id')
                    ->from(with(new \App\Atividade)->getTable())
                    //->orderBy('destaque')
                      ->where(function($query2){
                          $query2->where('destaque', '=', 1);
                      });
            })
            ->where('periodo_id', '=', $ultPeriodo)
            ->get();

        return view('site.conta', compact('contas'));
    }


}
