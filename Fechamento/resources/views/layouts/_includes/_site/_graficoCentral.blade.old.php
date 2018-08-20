<!--AVISO DE PERIODO ENCERRADO-->

@if($periodos[0]->resultado == 1)
    <div class="alert alert-danger" role="alert">ATENÇÃO! Não está permitido realizar lançamentos em resultado</div>
@endif
@if($periodos[0]->periodo == 1)
<div class="alert alert-success" role="alert">ATENÇÃO! Período encerrado para lançamentos</div>
@endif


<center>
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m6">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">STATUS FECHAMENTO</h5>
                    </div>
                    <div id="canvas-holder2" style="width:40%">
                        <canvas id="chart-area" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> 40% Concluído</p>
                        </div>
                    </footer>
                </div>
                <div class="col s12 m6">
                    <div class="perc-grafico">
                        <div class="grafico-header2">
                            <h5 class="titu-grafico">STATUS PROCESSOS</h5>
                        </div>
                        @foreach ($ativConc as $ativEmpr)
                            <p class="statusProcessos"><i class="fa fa-check"></i> {{ $ativEmpr->nome }}: {{ $ativEmpr->qtdConc }}/{{ $ativEmpr->qtd }} concluídas</p>
                        @endforeach
                        <p class="statusProcessos"><i class="fa fa-check"></i> Cooperativas: 10/30 concluídas.</p>
                        <p class="statusProcessos"><i class="fa fa-check"></i> Banco: <span id="bancoConc"> {{ $bancoConcluida }}</span>/<span id="bancoTotal">{{ $bancoTotal }}</span> concluídas.</p>
                        <p class="statusProcessos"><i class="fa fa-check"></i> Confederação: 10/30 concluídas.</p>
                        <p class="statusProcessos"><i class="fa fa-check"></i> Cartões: 10/30 concluídas.</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>
<center>
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="card-content">
            <div class="row">

                @for ($i=0; $i <= 3; $i++)

                    <div class="col s12 m3">
                        <div class="grafico-header2">
                            <h5 class="titu-grafico">{{ $ativConc[$i]->nome }}</h5>
                        </div>
                        <div id="canvas-holder2" style="width:50%">
                            <canvas id="chart-area2" />
                        </div>
                        <footer>
                            <div class="perc-grafico">
                                <p><i class="fa fa-hdd-o"></i> {{ ($ativConc[$i]->qtdConc/$ativConc[$i]->qtd)*100 }}% Concluído</p>
                            </div>
                        </footer>
                    </div>

                @endfor




                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Cooperativas</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart-area2" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> 40% Concluído</p>
                        </div>
                    </footer>
                </div>
        
                <div class="col s12 m3">
                    <div class="grafico-header">
                        <h5 class="titu-grafico">Centrais</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart-area3" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> 40% Concluído</p>
                        </div>
                    </footer>
                </div>

                <div class="col s12 m3">
                    <div class="grafico-header">
                        <h5 class="titu-grafico">Banco</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart-area4" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> {{ $bancoPercent }}% Concluído</p>
                        </div>
                    </footer>
                </div>
                <div class="col s12 m3">
                    <div class="grafico-header">
                        <h5 class="titu-grafico">Confederação</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart-area5" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> 40% Concluído</p>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</center>
<center>
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Corretora</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart-area6" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> 40% Concluído</p>
                        </div>
                    </footer>
                </div>
        
                <div class="col s12 m3">
                    <div class="grafico-header">
                        <h5 class="titu-grafico">Consórcio</h5>
                    </div>
                    <div id="canvas-holder" style="width:50%">
                        <canvas id="chart-area7" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> 40% Concluído</p>
                        </div>
                    </footer>
                </div>

                <div class="col s12 m3">
                    <div class="grafico-header">
                        <h5 class="titu-grafico">Cartões</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart-area8" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> 40% Concluído</p>
                        </div>
                    </footer>
                </div>
                <div class="col s12 m3">
                    <div class="grafico-header">
                        <h5 class="titu-grafico">Outros</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart-area9" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o"></i> 40% Concluído</p>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</center>    













novo

<center>
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="card-content">
            <div class="row">

            
                @for ($i=4; $i <= 7; $i++)

                    <div class="col s12 m3">
                        <div class="grafico-header2">
                            <h5 class="titu-grafico">{{ $ativConc[$i]->nome }}</h5>
                        </div>
                        <div id="canvas-holder2" style="width:50%">
                            <canvas id="chart{{$i}}" />
                        </div>
                        <footer>
                            <div class="perc-grafico">
                                <p><i class="fa fa-hdd-o"></i>
                                    <span id="var{{$i}}Conc" hidden>{{ $ativConc[$i]->qtdConc }}</span>
                                    <span id="var{{$i}}Tot" hidden>{{ $ativConc[$i]->qtd }}</span> 

                                    {{ ($ativConc[$i]->qtdConc/$ativConc[$i]->qtd)*100 }}% Concluído
                                    
                                </p>
                            </div>
                        </footer>
                    </div>
                @endfor

            </div>
        </div>
    </div>
</center>
