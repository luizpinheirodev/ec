
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<table class="striped bordered">
    <thead>
        <tr>
            <th>Período</th>
            <th>Atividade</th>
            <th>Empresa</th>
            <th>Gerência</th>
            <th>Responsável</th>
            <th>SLA</th>
            <th>Conclusão</th>
            <th>Previsão</th>
        </tr>
    </thead>

    <tbody>
    {{ csrf_field() }}
        @foreach($tarefas as $tarefa)
            <tr>
                <td>{{ $tarefa->periodo['nome'] }}</td>
                <td>{{ $tarefa->atividade['nome'] }}</td>
                <td>{{ $tarefa->atividade->empresa['nome'] }}</td>
                <td>{{ $tarefa->atividade->gerencia['nome'] }}</td>
                <td>{{ $tarefa->user['nome'] }}</td>
                <td>                
                
                {{ App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $tarefa->periodo['nome'] , $tarefa['float'] ) }} 

                , as {{ substr($tarefa['float_hora'], 0, 5) }}
                
                </td>
                <td>
                
                    @if ( $tarefa->conclusao  == 0 and count(App\Http\Controllers\Site\TarefaController::podeConcluir($tarefa->atividade_id))  >= 1 )
                        
                        <a class="waves-effect waves-light btn blue-grey darken-3" href="#pendent{{$tarefa->id}}">Pendencia</a>
                        <div id="pendent{{$tarefa->id}}" class="modalM">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Atividade</th>
                                        <th>Data acordada</th>
                                        <th>Responsável</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach(App\Http\Controllers\Site\TarefaController::podeConcluir($tarefa->atividade_id) as $pendencia)                
                                    <tr>
                                        <td> {{$pendencia->sigla}} - {{$pendencia->nome}} - {{$pendencia->empresa}} </td>
                                        <td> 
                                            {{ App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $tarefa->periodo['nome'] , $pendencia->float ) }}
                                            as {{$pendencia->floathora}}
                                        </td>
                                        <td> {{($pendencia->resp)}} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="modalM-footer">
                                <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Fechar</a>
                            </div>
                        </div>
                    @elseif ($tarefa->conclusao == 0 and count(App\Http\Controllers\Site\TarefaController::podeConcluir($tarefa->atividade_id)) == 0 )
                            <a class="waves-effect waves-light btn light-green accent-3" href="{{ route('tarefa.concluir',['tarefa'=>$tarefa->id, 'atividade'=>$tarefa->atividade_id]) }}" method="put">Concluir</a>

                    @else
                        {{ $tarefa->updated_at->format('d/m/Y') }}, as {{ $tarefa->updated_at->format('H:i') }}, por {{ $tarefa->concUser['nome'] }}
                        <!--<a class="waves-effect waves-light btn light-green accent-3" href="{{ route('tarefa.reabrir', $tarefa->id) }}" method="put">Reabrir</a>-->
                    @endif
                </td>

                <td>

                    @if ($tarefa->conclusao == 0)
                    
                        @if($tarefa->previsao <> null)
                            <div class="row"> {{ \Carbon\Carbon::parse($tarefa->previsao)->format('d/m/Y') }}, as {{ \Carbon\Carbon::parse($tarefa->previsao)->format('H:i') }} <a class="" href="#modalMPrev{{$tarefa->id}}"><i class="fa fa-edit"></i></a></div>
                        @else
                            <a class="waves-effect waves-light btn blue-grey darken-3" href="#modalMPrev{{$tarefa->id}}">Previsão</a>
                        @endif

                        <div id="modalMPrev{{$tarefa->id}}" class="modalM">
                            <div class="modalM-content">
                                <form action="{{route('tarefa.previsao', $tarefa->id)}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put">
                                    <div class="form-group col s6">
                                        <label for="data">Data</label>
                                        <input name="dataPrev" type="text"  class="datepicker" placeholder="Data" required/> 
                                    </div>
                                    <div class="form-group col s6">
                                        <label for="hora">Hora</label>
                                        <input name="horaPrev" type="text"  class="timepicker " placeholder="Hora" required/>
                                    </div>
                                    <div class="form-group col s12">
                                        <label for="texto">Motivo</label>
                                        <input type="textarea" name="texto" class="form-control" placeholder="Escreva o motivo" value="" required>
                                    </div>
                                    <button class="btn btn-info">Atualizar</button>
    
                                </form>
                                <div class="modalM-footer">
                                    <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Cancelar</a>
                                </div>
                            </div>
                        </div>

                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


                
         