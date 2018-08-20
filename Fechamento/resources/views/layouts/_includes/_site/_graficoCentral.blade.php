<!--AVISO DE PERIODO ENCERRADO-->

@if($periodos['resultado'] == 1)
    <div class="alert alert-danger" role="alert">ATENÇÃO! Não está permitido realizar lançamentos em resultado</div>
@endif
@if($periodos['periodo'] == 1)
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
                    <div id="canvas-holder2" style="width:60%">
                        <canvas id="grafTotal" />
                    </div>
                    <footer>
                        <div class="perc-grafico">

                                <span id="concPrazo" hidden>{{ $totais[0][0] }}</span>
                                <span id="concAtraso" hidden>{{ $totais[0][1] }}</span> 
                                <span id="naoConcAtraso" hidden>{{ $totais[0][2] }}</span>
                                <span id="naoConc" hidden>{{ $totais[0][3] }}</span> 
                                
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento"><span style="font-size:20px;" > {{ number_format( ($totais[0][0]/($totais[0][0] + $totais[0][3]))*100, 2, ',', '') }}% Concluído</span></p>
                        </div>
                    </footer>
                </div>
                <div class="col s12 m6">
                    <div class="perc-grafico">
                        <div class="grafico-header2">
                            <h5 class="titu-grafico">STATUS PROCESSOS</h5>
                        </div>
                        @foreach ($ativConc as $ativEmpr)
                            <p class="statusProcessos"><img src="{{asset('img/site/check.png')}}" class="status_seta"> {{ $ativEmpr->nome }}: {{ $ativEmpr->qtdConc }}/{{ $ativEmpr->qtd }} concluídas</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</center>



<!-- GRAFICOS DAS EMPRESAS -->
<center>
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="card-content">
            <div class="row">

                <!-- COOPERATIVAS -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Cooperativas</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart1" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo1" hidden>{{ $totais[1][0] }}</span>
                                <span id="concAtraso1" hidden>{{ $totais[1][1] }}</span> 
                                <span id="naoConcAtraso1" hidden>{{ $totais[1][2] }}</span>
                                <span id="naoConc1" hidden>{{ $totais[1][3] }}</span> 
                                {{ number_format( ($totais[1][0]/($totais[1][0] + $totais[1][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>

                <!-- CENTRAIS -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Centrais</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart2" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo2" hidden>{{ $totais[2][0] }}</span>
                                <span id="concAtraso2" hidden>{{ $totais[2][1] }}</span> 
                                <span id="naoConcAtraso2" hidden>{{ $totais[2][2] }}</span>
                                <span id="naoConc2" hidden>{{ $totais[2][3] }}</span> 
                                {{ number_format( ($totais[2][0]/($totais[2][0] + $totais[2][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>

                <!-- CONFEDERAÇÃO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Confederação</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart3" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo3" hidden>{{ $totais[3][0] }}</span>
                                <span id="concAtraso3" hidden>{{ $totais[3][1] }}</span> 
                                <span id="naoConcAtraso3" hidden>{{ $totais[3][2] }}</span>
                                <span id="naoConc3" hidden>{{ $totais[3][3] }}</span> 
                                {{ number_format( ($totais[3][0]/($totais[3][0] + $totais[3][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>
                
                <!-- CORRETORA -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Corretora</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart4" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo4" hidden>{{ $totais[4][0] }}</span>
                                <span id="concAtraso4" hidden>{{ $totais[4][1] }}</span> 
                                <span id="naoConcAtraso4" hidden>{{ $totais[4][2] }}</span>
                                <span id="naoConc4" hidden>{{ $totais[4][3] }}</span> 
                                {{ number_format( ($totais[4][0]/($totais[4][0] + $totais[4][3]))*100, 2, ',', '') }}% Concluído
                            </p>
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

                <!-- CONSORCIO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Consórcio</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart5" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo5" hidden>{{ $totais[5][0] }}</span>
                                <span id="concAtraso5" hidden>{{ $totais[5][1] }}</span> 
                                <span id="naoConcAtraso5" hidden>{{ $totais[5][2] }}</span>
                                <span id="naoConc5" hidden>{{ $totais[5][3] }}</span> 
                                {{ number_format( ($totais[5][0]/($totais[5][0] + $totais[5][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>

                <!-- CARTÕES -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Cartões</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart6" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo6" hidden>{{ $totais[6][0] }}</span>
                                <span id="concAtraso6" hidden>{{ $totais[6][1] }}</span> 
                                <span id="naoConcAtraso6" hidden>{{ $totais[6][2] }}</span>
                                <span id="naoConc6" hidden>{{ $totais[6][3] }}</span> 
                                {{ number_format( ($totais[6][0]/($totais[6][0] + $totais[6][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>

                <!-- BANCO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Banco</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart7" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo7" hidden>{{ $totais[7][0] }}</span>
                                <span id="concAtraso7" hidden>{{ $totais[7][1] }}</span> 
                                <span id="naoConcAtraso7" hidden>{{ $totais[7][2] }}</span>
                                <span id="naoConc7" hidden>{{ $totais[7][3] }}</span> 
                                {{ number_format( ($totais[7][0]/($totais[7][0] + $totais[7][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>
                
                <!-- FUNDAÇÃO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Fundação</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart8" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo8" hidden>{{ $totais[8][0] }}</span>
                                <span id="concAtraso8" hidden>{{ $totais[8][1] }}</span> 
                                <span id="naoConcAtraso8" hidden>{{ $totais[8][2] }}</span>
                                <span id="naoConc8" hidden>{{ $totais[8][3] }}</span> 
                                {{ number_format( ($totais[8][0]/($totais[8][0] + $totais[8][3]))*100, 2, ',', '') }}% Concluído
                            </p>
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
                <!-- ADM. DE BENS -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Adm. de Bens</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart10" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo10" hidden>{{ $totais[10][0] }}</span>
                                <span id="concAtraso10" hidden>{{ $totais[10][1] }}</span> 
                                <span id="naoConcAtraso10" hidden>{{ $totais[10][2] }}</span>
                                <span id="naoConc10" hidden>{{ $totais[10][3] }}</span> 
                                {{ number_format( ($totais[10][0]/($totais[10][0] + $totais[10][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>
                
                <!-- SICREDIPAR -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">SicrediPar</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart11" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo11" hidden>{{ $totais[11][0] }}</span>
                                <span id="concAtraso11" hidden>{{ $totais[11][1] }}</span> 
                                <span id="naoConcAtraso11" hidden>{{ $totais[11][2] }}</span>
                                <span id="naoConc11" hidden>{{ $totais[11][3] }}</span> 
                                {{ number_format( ($totais[11][0]/($totais[11][0] + $totais[11][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>

                <!-- SFG -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">SFG</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart12" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo12" hidden>{{ $totais[12][0] }}</span>
                                <span id="concAtraso12" hidden>{{ $totais[12][1] }}</span> 
                                <span id="naoConcAtraso12" hidden>{{ $totais[12][2] }}</span>
                                <span id="naoConc12" hidden>{{ $totais[12][3] }}</span> 
                                {{ number_format( ($totais[12][0]/($totais[12][0] + $totais[12][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>

                <!-- CONDOMINIO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="titu-grafico">Condomínio</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart13" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="concPrazo13" hidden>{{ $totais[13][0] }}</span>
                                <span id="concAtraso13" hidden>{{ $totais[13][1] }}</span> 
                                <span id="naoConcAtraso13" hidden>{{ $totais[13][2] }}</span>
                                <span id="naoConc13" hidden>{{ $totais[13][3] }}</span> 
                                {{ number_format( ($totais[13][0]/($totais[13][0] + $totais[13][3]))*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>
                    
                
            </div>
        </div>
    </div>
</center>


