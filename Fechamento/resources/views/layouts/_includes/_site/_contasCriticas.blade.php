
<center>
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        
        <div class="divider"></div>
        <div class="cabecalhos_home">
            <div class="section" style="margin-left:0px;color: white;">
                <h5>Críticas de Conciliação</h5>
            </div>
        </div>
        
        <div class="card-content" id="chamaContas" style="cursor:pointer;">
            <div class="row">
                        
                <div class="col s12 m12">
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart14" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><img src="{{asset('img/site/monitoramento.png')}}" class="status_monitoramento">
                                <span id="qtd14" hidden>{{ $contasCriticas[0]->qtd }}</span>
                                <span id="qtdConc14" hidden>{{ $contasCriticas[0]->qtdConc }}</span> 
                                {{ number_format( ($contasCriticas[0]->qtdConc/$contasCriticas[0]->qtd)*100, 2, ',', '') }}% Concluído
                            </p>
                        </div>
                    </footer>
                </div>
     
            </div>
        </div>
    </div>
</center>
