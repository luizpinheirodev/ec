<div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

    <div class="divider"></div>
    <div class="cabecalhos_home">
        <div class="section notificacaoTitulo">
            <h5>Feriados</h5>
        </div>
    </div>
    @foreach ($feriados as $feriado)
    <div id="">
        <div class="section notificacao">
            <img src="{{asset('img/site/calendario.png')}}" class="calendar_calendario"><span style="padding-left:10px;"><i><b>{{ \Carbon\Carbon::parse($feriado['data'])->format('d/m/Y') }}</b> - {{$feriado['nome']}}</i></span>
        </div>
    </div>
    @endforeach
    <br>
    <div class="divider"></div>
</div>       