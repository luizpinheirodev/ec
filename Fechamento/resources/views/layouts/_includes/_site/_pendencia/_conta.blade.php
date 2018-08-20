<div class="col s12 m4 l8">
    <h4>Críticas do Fechamento</h4>
    SLA 4º dia útil as 12hs
</div>


<table id="conta" class="striped">
    <thead>
        <tr>
            <th hidden>Float</th>
            <th>Atividade</th>
            <th>Responsável</th>
            <!--<th>SLA</th>-->
            <th>Concluído</th>
            <th hidden>destaque</th>
        </tr>
    </thead>

    <tbody>
    {{ csrf_field() }}
    
        @foreach($contas as $conta)
            <tr>
                <td hidden>{{ $conta->atividade['float'] }}</td>
                <td>{{ $conta->atividade['nome'] }}</td>
                <td>{{ $conta->user['nome'] }}</td>
                <!--<td>{{ App\Http\Controllers\Site\TarefaController::getDiaDaSemana( $conta->periodo['nome'] , $conta['float'] ) }} ,às {{ $conta['float_hora'] }} -->
                <td>
                    @if( $conta->conclusao != 0)
                        <i class="fas fa-check"></i>
                        - {{ $conta->updated_at->format('d/m/Y') }} às {{ $conta->updated_at->format('H:i') }}, por {{ $conta->concUser['nome'] }}
                    @else
                        <i class="fas fa-times"></i> - Não concluído
                    @endif
                </td>
                <td hidden>{{ $conta->atividade['destaque'] }} </td>
            </tr>
        @endforeach
    </tbody>
</table>