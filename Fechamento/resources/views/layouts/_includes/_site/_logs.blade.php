<div class="cardlogs card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

    <div class="divider"></div>
    <div class="cabecalhos_home">
        <div class="section  notificacaoTitulo">
            <h5>Notificações</h5>
        </div>
    </div>

    
    @foreach($logs as $log)

           
        <div class="divider"></div>
        @if ($log->tipo == "alterou o responsavel")

            <div class="section notificacao">
                <p><img src="{{asset('img/site/clock.png')}}" class="clock-log"><small><i> {{ App\Http\Controllers\HomeController::buscaTempoLog( \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s')    ) }} atrás</i></small></p>
                <p> <img src="{{asset('img/site/pessoa_verde_verde.png')}}" class="foto-log"> O responsável da atividade {{ $log->atividade_periodo->atividade['nome'] }} foi alterado para <a class="lognome" href="#{{ $log->id }}">{{ $log->usuario['nome'] }}</a>.</p>
            </div>
            <div id="{{ $log->id }}" class="modalMNotify">
                <div class="modalM-content">
                    <h4>{{ $log->usuario['nome'] }}</h4>
                    <p><label>Ramal: {{ $log->usuario['ramal'] }} </label></p>
                    <p><label>Gerencia: {{ $log->usuario->gerencia['nome'] }} </label></p>
                    <p><label>E-mail: {{ $log->usuario['email'] }} </label></p>
                    <!-- <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat modalM-footer">Fechar</a> -->
                </div>
            </div>

        @elseif ($log->tipo == "postergou")

            <div class="section notificacao">
                <p><img src="{{asset('img/site/clock.png')}}" class="clock-log"> {{ App\Http\Controllers\HomeController::buscaTempoLog( \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s')    ) }} atrás</i></small></p>
                <p><img src="{{asset('img/site/pessoa_verde_verde.png')}}" class="foto-log"><a class="lognome" href="#{{ $log->id }}"> {{ $log->usuario['nome'] }}</a> postergou {{ $log->atividade_periodo->atividade['nome'] }}.</p>
            </div>
            <div id="{{ $log->id }}" class="modalMNotify">
                <div class="modalM-content">
                    <h4>{{ $log->usuario['nome'] }}</h4>
                    <p><label>Ramal: {{ $log->usuario['ramal'] }} </label></p>
                    <p><label>Gerencia: {{ $log->usuario->gerencia['nome'] }} </label></p>
                    <p><label>E-mail: {{ $log->usuario['email'] }} </label></p>
                    <!-- <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat modalM-footer">Fechar</a> -->
                </div>
            </div>

        @else
            <div class="section notificacao">
                <p><img src="{{asset('img/site/clock.png')}}" class="clock-log"><small><i> {{ App\Http\Controllers\HomeController::buscaTempoLog( \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i:s')) }} atrás</i></small></p>
                <p> <img src="{{asset('img/site/pessoa_verde_verde.png')}}" class="foto-log"><a class="lognome" href="#{{ $log->id }}"> {{ $log->usuario['nome'] }}</a> concluiu {{ $log->atividade_periodo->atividade['nome'] }}.</p>
            </div>
            <div id="{{ $log->id }}" class="modalMNotify">
                <div class="modalM-content">
                    <h4>{{ $log->usuario['nome'] }}</h4>
                    <p><label>Ramal: {{ $log->usuario['ramal'] }} </label></p>
                    <p><label>Gerencia: {{ $log->usuario->gerencia['nome'] }} </label></p>
                    <p><label>E-mail: {{ $log->usuario['email'] }} </label></p>
                    <!-- <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat modalM-footer">Fechar</a> -->
                </div>
            </div>

        @endif

    @endforeach

    <div class="divider"></div>
</div>





