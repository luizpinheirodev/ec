<div>
    <h2>Olá, </h2>
    <p>Essas são suas tarefas referente ao fechamento para hoje:</p>
    <table border="2"  style="border: 1px solid black; border-collapse: collapse; padding: 5px; width:80%">
        <tr>
            <th>Nome</th>
            <th>Atividade</th>
            <th>Gerencia</th>
            <th>Empresa</th>
            <th>Data</th>
            <th>Horário</th>
        </tr>
        @foreach($dados as $dt)
        <tr>
            <td> {{ $dt['nome'] }} </td>
            <td> {{ $dt['atividade'] }} </td>
            <td> {{ $dt['gerencia'] }} </td>
            <td> {{ $dt['empresa'] }} </td>
            <td> {{ $dt['data'] }} </td>
            <td> {{ $dt['horario'] }} </td>
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


    
