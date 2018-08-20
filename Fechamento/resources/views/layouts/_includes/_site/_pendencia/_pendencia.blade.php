<div class="row">
    <div class="col s12 m4 l2">
            Selecionar Período
    <select id="selecPend">
        
        @foreach ($periodos as $periodo)
            <option value="{{ $periodo->id }}" > {{ $periodo->nome }}  </option>
        @endforeach
    </select>


    </div>
    <div class="col s12 m4 l8">
    <center><h4>PERÍODO: {{ $pendencias[0]->periodo['nome'] }}</h4></center>
    </div>

    @can('relatorio')
    <div class="col s12 m4 l2">
    <a href="{{ route('relatorio.index')}}" class="waves-effect waves-light btn"><i class="fas fa-file-excel"></i> Exportar</a>
    </div>
    @endcan

</div>

<table id="pendencia" class="striped">
    <thead>
        <tr>
            <th hidden>Float</th>
            <th>Período</th>
            <th>Atividade</th>
            <th>Empresa</th>
            <th>Gerência</th>
            <th>Responsável</th>
            <th>SLA</th>
            <th>Concluído</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
    {{ csrf_field() }}
    
        @foreach($pendencias as $pendencia)
            <tr>
                <td hidden>{{ $pendencia->atividade['float'] }}</td>
                <td>{{ $pendencia->periodo['nome'] }}</td>
                <td>{{ $pendencia->atividade['nome'] }}</td>
                <td>{{ $pendencia->atividade->empresa['nome'] }}</td>
                <td>{{ $pendencia->atividade->gerencia['nome'] }}</td>
                <td>{{ $pendencia->user['nome'] }}</td>
                <td>{{ App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $pendencia->periodo['nome'] , $pendencia['float'] ) }} 
                       ,às {{ $pendencia['float_hora'] }}
                <td>
                    @if( $pendencia->conclusao != 0)
                        {{ $pendencia->updated_at->format('d/m/Y') }} às {{ $pendencia->updated_at->format('H:i') }}, por {{ $pendencia->concUser['nome'] }}
                    @endif
                </td>
                <td>

                    @if( $pendencia->conclusao != 0)
                        @if( (App\Http\Controllers\Site\PendenciaController::emAtraso(
                            App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $pendencia->periodo['nome'], $pendencia['float']),   
                            $pendencia->atividade['float_hora'],
                            $pendencia->updated_at->format('d/m/Y'), 
                            $pendencia->updated_at->format('H:i'))
                        ) == 1 and $pendencia->conclusao  != 0)
                        Concluído em atraso 

                            @if($pendencia->comentario <> null)
                                <a class="mais" href="#modalMPrev{{$pendencia->id}}"><i class="fas fa-plus"></i></a>
                                <div id="modalMPrev{{$pendencia->id}}" class="modalM" >
                                    <div class="modalM-content">

                                        @foreach($pendencia->comentario as $userP)
                                        <div class="card horizontal">
                                            <div class="card-stacked">
                                                <p class="titulo-comentario"><b>{{ ($userP->usuarioPend->nome) }}</b> | {{$userP->created_at->format('d/m/Y')}} as {{$userP->created_at->format('H:i')}} |</p> 
                                                <div class="card-content">
                                                    <div class="divider"></div>
                                                </div>
                                                <p class="comentario"> {{$userP->texto}} </p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                        <div class="modalM-footer">
                                            <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Sair</a>
                                        </div>
                                </div>
                            @endif
                        @endif
                    @elseif($pendencia->previsao <> null)

                    Previsto para {{ \Carbon\Carbon::parse($pendencia->previsao)->format('d/m/Y')}}, as {{ \Carbon\Carbon::parse($pendencia->previsao)->format('H:i')}}

                    @if($pendencia->comentario <> null)
                        <a class="mais" href="#modalMPrev{{$pendencia->id}}"><i class="fas fa-plus"></i></a>
                        <div id="modalMPrev{{$pendencia->id}}" class="modalM"  >
                            <div class="modalM-content">
                                @foreach($pendencia->comentario as $userP)
                                <div class="card horizontal">
                                    <div class="card-stacked">
                                        <p class="titulo-comentario"><b>{{ ($userP->usuarioPend->nome) }}</b> | {{$userP->created_at->format('d/m/Y')}} as {{$userP->created_at->format('H:i')}} |</p> 
                                        <div class="card-content">
                                            <div class="divider"></div>
                                        </div>
                                        <p class="comentario"> {{$userP->texto}} </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                                    <div class="modalM-footer">
                                        <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Sair</a>
                                    </div>
                        </div>
                    @endif

                    @elseif(App\Http\Controllers\Site\PendenciaController::emAtraso(
                        App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $pendencia->periodo['nome'], $pendencia['float']),   
                        $pendencia->atividade['float_hora'],
                        date('d/m/Y'), 
                        date('H:i'))
                        == 1)
                        Em atraso
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>