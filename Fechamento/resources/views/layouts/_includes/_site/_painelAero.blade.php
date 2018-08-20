<center>
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        
        <div class="divider"></div>
        <div class="cabecalhos_home">
            <div class="section  notificacaoTitulo">
                <h5>Próximas Atividades</h5>
            </div>
        </div>
        
        <div class="card-content">
        <div class="row">
                    
                <table class="tableTV">
                    <thead class="tableHeadSlide">
                        <tr>
                            <th class="head1">Empresa</th>
                            <th class="head2">Atividade</th>
                            <th class="head3">Responsável</th>
                            <th class="head4">SLA</th>
                            <th class="head5">Previsão</th>
                            <th class="head5">Status</th>
                        </tr>
                    </thead>
            
                    
                    <tbody class="tableBodySlide">
                        
                        @for ($i=0; ($i < count($painelAeros) && $i<10); $i++)
                            <tr>
                                <td class="column1">{{$painelAeros[$i][4]}}</td>
                                <td class="column2">{{$painelAeros[$i][2]}}</td>
                                <td class="column3">{{$painelAeros[$i][3]}}</td>
                                <td class="column4">{{ \Carbon\Carbon::parse($painelAeros[$i][0])->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($painelAeros[$i][0])->format('H:i')}}hs </td>
                                <td class="column5">
                                @if($painelAeros[$i][1] != null)
                                {{ \Carbon\Carbon::parse($painelAeros[$i][1])->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($painelAeros[$i][1])->format('H:i')}}hs
                                @endif
                                </td>
                                <td class="column6">
                                    @if($painelAeros[$i][5] == 1)
                                    <button style="height: 36px; width: 112px; padding:0px; pointer-events: none; cursor: default;" class="btn btn-small red" >Em atraso</button>
                                    @else
                                    <button style="height: 36px; width: 112px; padding:0px; pointer-events: none; cursor: default; background:#146E37 " class="btn btn-small">No prazo</button>
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>

              
            </div>
        </div>
    </div>
</center>



