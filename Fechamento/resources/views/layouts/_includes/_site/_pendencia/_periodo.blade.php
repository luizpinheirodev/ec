<div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">

    <div class="divider"></div>
    <div class="cabecalhos_home">
        <div class="section notificacaoTitulo">
            <h5>Períodos - Históricos</h5>
        </div>
    </div>
</div>



<!--COMMENT AREA -->
<div class="divider"></div>
<div class="divider"></div>
<div class="divider"></div>

@foreach ($periodos as $periodo)
<div class="card horizontal">
    <div class="card-image">
        <img src="{{asset('img/site/documento_check_verde.png')}}" width="100" height="100" class="foto-contato">
    </div>
   
    <div class="card-stacked">
        <div class="card-content">
            <p class="titulo-comentario">
                <span class="left"><b>{{ $periodo['nome'] }}</b></span>
                <a class="">Fechamento: {{ $periodo->diasfechamento }}º dia útil </a>  | <a>Atingimento: {{ $periodo->atingimento }}%</a> | 
            </p> 
            <div class="divider"></div>
            <p class="comentario">@php echo $periodo['comentario'] @endphp </p>
        </div>
        
    </div>
</div>

@endforeach




