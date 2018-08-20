@include('layouts._includes._site._pendencia._customizadoNav')


@if(isset($relatorio))


<table id="" class="">
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
    
        @foreach($relatorio as $rel)
            <tr>
                <td hidden>{{ $rel->atividade['float'] }}</td>
                <td>{{ $rel->periodo['nome'] }}</td>
                <td>{{ $rel->atividade['nome'] }}</td>
                <td>{{ $rel->atividade->empresa['nome'] }}</td>
                <td>{{ $rel->atividade->gerencia['nome'] }}</td>
                <td>{{ $rel->user['nome'] }}</td>
                <td>{{ App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $rel->periodo['nome'] , $rel['float'] ) }} 
                        ,às {{ $rel['float_hora'] }}
                <td>
                    @if( $rel->conclusao != 0)
                        {{ $rel->updated_at->format('d/m/Y') }} às {{ $rel->updated_at->format('H:i') }}, por {{ $rel->concUser['nome'] }}
                    @endif
                </td>
                <td>

                    @if( $rel->conclusao != 0)
                        @if( (App\Http\Controllers\Site\PendenciaController::emAtraso(
                            App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $rel->periodo['nome'], $rel['float']),   
                            $rel->atividade['float_hora'],
                            $rel->updated_at->format('d/m/Y'), 
                            $rel->updated_at->format('H:i'))
                        ) == 1 and $rel->conclusao  != 0)
                        Concluído em atraso 

                            @if($rel->comentario <> null)
                                <a class="mais" href="#modalMPrev{{$rel->id}}"><i class="fas fa-plus"></i></a>
                                <div id="modalMPrev{{$rel->id}}" class="modalM">
                                    <div class="modalM-content">

                                        @foreach($rel->comentario as $userP)
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
                                        <div class="modalM-footer">
                                            <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Sair</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @elseif($rel->previsao <> null)

                    Previsto para {{ \Carbon\Carbon::parse($rel->previsao)->format('d/m/Y')}}, as {{ \Carbon\Carbon::parse($rel->previsao)->format('H:i')}}

                    @if($rel->comentario <> null)
                        <a class="mais" href="#modalMPrev{{$rel->id}}"><i class="fas fa-plus"></i></a>
                        <div id="modalMPrev{{$rel->id}}" class="modalM" >
                            <div class="modalM-content">
                                @foreach($rel->comentario as $userP)
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
                                <div class="modalM-footer">
                                    <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Sair</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @elseif(App\Http\Controllers\Site\PendenciaController::emAtraso(
                        App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $rel->periodo['nome'], $rel['float']),   
                        $rel->atividade['float_hora'],
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

@endif