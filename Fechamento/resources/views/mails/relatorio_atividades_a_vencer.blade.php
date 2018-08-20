<div>
    <h2>Olá, </h2>
    <p>As atividades abaixo estarão vencendo na próxima hora:</p>
    <table border="2"  style="border: 1px solid black; border-collapse: collapse; padding: 5px; width:80%">
        <tr>
            <th>Nome</th>
            <th>Atividade</th>
            <th>Gerencia</th>
            <th>Empresa</th>
            <th>Data</th>
            <th>Horário</th>
            <th>Previsão</th>
        </tr>
        @foreach($dados as $dt)
        <tr>
            <td> {{ $dt['nome'] }} </td>
            <td> {{ $dt['atividade'] }} </td>
            <td> {{ $dt['gerencia'] }} </td>
            <td> {{ $dt['empresa'] }} </td>
            <td> {{ $dt['data'] }} </td>
            <td> {{ $dt['horario'] }} </td>
            <td> 
                @if($dt['previsao'] != null) 
                    {{ \Carbon\Carbon::parse($dt['previsao'])->format('d/m/Y')}} as {{\Carbon\Carbon::parse($dt['previsao'])->format('H:i')}}hs 
                @endif
            </td>
        </tr>
        @endforeach

    </table>
</div>
<br>
    <p>Acesse a ferramenta <a href="http:\\encerramentocontabil.sicredi.net">Encerramento Contábil</a> para concluir suas atividades</p>
    <br>

    <p>Gerência Contábil - GCT</p>
    <p>Superintendência de Controladoria - SUC</p>

    <p>CAS-Confederação Sicredi-Porto Alegre</p>
