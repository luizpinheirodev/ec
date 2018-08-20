<!DOCTYPE html>
<html lang="pt-br">
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- AUTOREFRESH -->
    <meta http-equiv="refresh" content="200"> <!-- Em segundos -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Encerramento Contábil') }}</title>

    <!-- Styles -->
    <!--Import Google Icon Font-->
    <link href="{{ asset('css/styleTV.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/datatables.net-dt/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/materialize/css/materializeTV.css') }}" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <link href="{{ asset('css/graficoCentral.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/font-awesome-4.7.0/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/zabuto_calendar/zabuto_calendar.css') }}" rel="stylesheet">
    
    
    
    
</head>
<body id="app-layout" class=""> 
  <header>
  </header>
  <main>

   
  
<div class="slider fullscreen">
  <ul class="slides">

    <li>

    <!-- ---------------------------------------SLIDE 1--------------------------------------------- -->
    
    <center class="slid1">
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="card-content">
            <div class="row">
                <div class="col s12 m6">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha"><b>STATUS FECHAMENTO</b></h5>
                    </div>  
                    <div id="canvas-holder2" style="width:60%; position:relative;">
                        <canvas id="grafTotal" width="300" height="300" style="display: block; width: 300px; height: 300px;"></canvas>
                        <div class="traffic-text">{{ number_format( ($totais[0][0]/($totais[0][0] + $totais[0][3]))*100, 2, ',', '') }}% <span>Concluído</span></div>
                    </div>
                    
                    <footer>
                        <div class="perc-grafico">
                                <span id="concPrazo" hidden>{{ $totais[0][0] }}</span>
                                <span id="concAtraso" hidden>{{ $totais[0][1] }}</span> 
                                <span id="naoConcAtraso" hidden>{{ $totais[0][2] }}</span>
                                <span id="naoConc" hidden>{{ $totais[0][3] }}</span> 
                        </div>
                    </footer>
                    <h1 class="periodo">Período: {{ $periodos->nome}} </h1>
                  </div>
                  <div class="col s12 m6">
                    <div class="perc-grafico">
                      <div class="grafico-header2">
                        <h5 class="legend-text"><b>STATUS PROCESSOS</b></h5>
                      </div>
                      <div class="channels-info-item">
                        <div class="legend-color" style="background-color: #105A5A"></div>
                        <p class="legend-text">Concluído no prazo<span class="channel-number">{{ number_format(($totais[0][0] - $totais[0][1])/($totais[0][0] + $totais[0][3])*100, 2, ',', '') }}%</span></p>
                        <div class="progress-sm channel-progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" ></div>
                        </div>
                        <div class="legend-color" style="background-color: #007475"></div>
                        <p class="legend-text">Concluído em atraso<span class="channel-number">{{ number_format( ($totais[0][1]/($totais[0][0] + $totais[0][3]))*100, 2, ',', '') }}%</span></p>
                        <div class="progress-sm channel-progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" ></div>
                        </div>
                        <div class="legend-color" style="background-color: #bf685f"></div>
                        <p class="legend-text">Em atraso<span class="channel-number">{{ number_format( ($totais[0][2]/($totais[0][0] + $totais[0][3]))*100, 2, ',', '') }}%</span></p>
                        <div class="progress-sm channel-progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" ></div>
                        </div>
                        <div class="legend-color" style="background-color: transparent"></div>
                        <p class="legend-text">No prazo<span class="channel-number">{{ number_format(($totais[0][3] - $totais[0][2])/($totais[0][0] + $totais[0][3])*100, 2, ',', '') }}%</span></p>
                        <div class="progress-sm channel-progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" >
                          </div>
                          
                        </div>
                        <!--<img class="responsive-img" src="{{asset('img/tv/sic.png')}}" width="100%" height="100%" style="background-repeat: no-repeat; margin-left: -20px"/>-->
                    </div>
                    <img class="imgsicred" src="../../../../img/tv/sic.png" style="background-repeat: no-repeat;"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </center>
        </li>








<!-- ---------------------------------------SLIDE 2--------------------------------------------- -->
<li>
  
<!-- GRAFICOS DAS EMPRESAS -->
<center class="slid2">
    <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="card-content">
            <div class="row">
    
                <!-- COOPERATIVAS -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha">Cooperativas</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart1" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o tit-fecha"></i>
                                <span id="concPrazo1" hidden>{{ $totais[1][0] }}</span>
                                <span id="concAtraso1" hidden>{{ $totais[1][1] }}</span> 
                                <span id="naoConcAtraso1" hidden>{{ $totais[1][2] }}</span>
                                <span id="naoConc1" hidden>{{ $totais[1][3] }}</span> 
                                <span class="perc-conc">
                                {{ number_format( ($totais[1][0]/($totais[1][0] + $totais[1][3]))*100, 2, ',', '') }}% Concluído
                                
                            </p>
                        </div>
                    </footer>
                </div>
    
                <!-- CENTRAIS -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha">Centrais</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart2" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o tit-fecha"></i>
                                <span id="concPrazo2" hidden>{{ $totais[2][0] }}</span>
                                <span id="concAtraso2" hidden>{{ $totais[2][1] }}</span> 
                                <span id="naoConcAtraso2" hidden>{{ $totais[2][2] }}</span>
                                <span id="naoConc2" hidden>{{ $totais[2][3] }}</span>
                                <span class="perc-conc">
                                {{ number_format( ($totais[2][0]/($totais[2][0] + $totais[2][3]))*100, 2, ',', '') }}% Concluído
                                </span>
                            </p>
                        </div>
                    </footer>
                </div>
    
                <!-- CONFEDERAÇÃO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha">Confederação</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart3" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o tit-fecha"></i>
                                <span id="concPrazo3" hidden>{{ $totais[3][0] }}</span>
                                <span id="concAtraso3" hidden>{{ $totais[3][1] }}</span> 
                                <span id="naoConcAtraso3" hidden>{{ $totais[3][2] }}</span>
                                <span id="naoConc3" hidden>{{ $totais[3][3] }}</span> 
                                <span class="perc-conc">
                                {{ number_format( ($totais[3][0]/($totais[3][0] + $totais[3][3]))*100, 2, ',', '') }}% Concluído
                                </span>
                            </p>
                        </div>
                    </footer>
                </div>
                
                <!-- CORRETORA -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha">Corretora</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart4" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o tit-fecha"></i>
                                <span id="concPrazo4" hidden>{{ $totais[4][0] }}</span>
                                <span id="concAtraso4" hidden>{{ $totais[4][1] }}</span> 
                                <span id="naoConcAtraso4" hidden>{{ $totais[4][2] }}</span>
                                <span id="naoConc4" hidden>{{ $totais[4][3] }}</span> 
                                <span class="perc-conc">
                                {{ number_format( ($totais[4][0]/($totais[4][0] + $totais[4][3]))*100, 2, ',', '') }}% Concluído
                                </span>
                            </p>
                        </div>
                    </footer>
                </div>
            </div>
    
            <div class="row">
    
                <!-- CONSORCIO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha">Consórcio</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart5" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o tit-fecha"></i>
                                <span id="concPrazo5" hidden>{{ $totais[5][0] }}</span>
                                <span id="concAtraso5" hidden>{{ $totais[5][1] }}</span> 
                                <span id="naoConcAtraso5" hidden>{{ $totais[5][2] }}</span>
                                <span id="naoConc5" hidden>{{ $totais[5][3] }}</span> 
                                <span class="perc-conc">
                                {{ number_format( ($totais[5][0]/($totais[5][0] + $totais[5][3]))*100, 2, ',', '') }}% Concluído
                                </span>
                            </p>
                        </div>
                    </footer>
                </div>
    
                <!-- CARTÕES -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha">Cartões</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart6" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o tit-fecha"></i>
                                <span id="concPrazo6" hidden>{{ $totais[6][0] }}</span>
                                <span id="concAtraso6" hidden>{{ $totais[6][1] }}</span> 
                                <span id="naoConcAtraso6" hidden>{{ $totais[6][2] }}</span>
                                <span id="naoConc6" hidden>{{ $totais[6][3] }}</span> 
                                <span class="perc-conc">
                                {{ number_format( ($totais[6][0]/($totais[6][0] + $totais[6][3]))*100, 2, ',', '') }}% Concluído
                                </span>
                            </p>
                        </div>
                    </footer>
                </div>
    
                <!-- BANCO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha">Banco</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart7" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o tit-fecha"></i>
                                <span id="concPrazo7" hidden>{{ $totais[7][0] }}</span>
                                <span id="concAtraso7" hidden>{{ $totais[7][1] }}</span> 
                                <span id="naoConcAtraso7" hidden>{{ $totais[7][2] }}</span>
                                <span id="naoConc7" hidden>{{ $totais[7][3] }}</span> 
                                <span class="perc-conc">
                                {{ number_format( ($totais[7][0]/($totais[7][0] + $totais[7][3]))*100, 2, ',', '') }}% Concluído
                                </span>
                            </p>
                        </div>
                    </footer>
                </div>
                
                <!-- FUNDAÇÃO -->
                <div class="col s12 m3">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha">Fundação</h5>
                    </div>
                    <div id="canvas-holder2" style="width:50%">
                        <canvas id="chart8" />
                    </div>
                    <footer>
                        <div class="perc-grafico">
                            <p><i class="fa fa-hdd-o tit-fecha"></i>
                                <span id="concPrazo8" hidden>{{ $totais[8][0] }}</span>
                                <span id="concAtraso8" hidden>{{ $totais[8][1] }}</span> 
                                <span id="naoConcAtraso8" hidden>{{ $totais[8][2] }}</span>
                                <span id="naoConc8" hidden>{{ $totais[8][3] }}</span> 
                                <span class="perc-conc">
                                {{ number_format( ($totais[8][0]/($totais[8][0] + $totais[8][3]))*100, 2, ',', '') }}% Concluído
                                </span>
                            </p>
                        </div>
                    </footer>
                </div>
            
                
    
            </div>
        </div>
    </div>
  </center>

</li>

     
<!-- ---------------------------------------SLIDE 3--------------------------------------------- -->
<li>
    <div class="container">
        
    <center>
        <!--<h5 class="tit-fecha"><b>STATUS FECHAMENTO</b></h5>-->
    
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
                @foreach ($painelAeros as $pn)
                    <tr>
                        <td class="column1">{{$pn[4]}}</td>
                        <td class="column2">{{$pn[2]}}</td>
                        <td class="column3">{{$pn[3]}}</td>
                        <td class="column4">{{ \Carbon\Carbon::parse($pn[0])->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($pn[0])->format('H:i')}}hs </td>
                        <td class="column5">
                        @if($pn[1] != null)
                        {{ \Carbon\Carbon::parse($pn[1])->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($pn[1])->format('H:i')}}hs
                        @endif
                        </td>
                        <td class="column6">
                            @if($pn[5] == 1)
                            <button class="btn btn-small red">Em atraso</button>
                            @else
                            <button class="btn btn-small">No prazo</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </center>
</li>
<!-- ---------------------------------------END SLIDE 3--------------------------------------------- -->
     




<!-- ---------------------------------------SLIDE 4--------------------------------------------- -->
<li>

        <center>
            <span id="concPrazo9" hidden>{{ $totais[9][0] }}</span>
            <span id="naoConc9" hidden>{{ $totais[9][3] }}</span> 
            <span id="concPrazo10" hidden>{{ $totais[10][0] }}</span>
            <span id="naoConc10" hidden>{{ $totais[10][3] }}</span>
        
        <div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <div class="card-content">
                <div class="row">
                    <div class="grafico-header2">
                        <h5 class="tit-fecha"><b>Quantidade de processos</b></h5>
                    </div>
                    <div class="container">
                        <div id="canvas-holder" style="width:100%">
                                <canvas id="chart-bar-emp" />
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </center>
    </li>
    <!-- ---------------------------------------END SLIDE 4--------------------------------------------- -->
       
    

       


    
</div>


    
  </main>  
  
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{asset('lib/jquery/dist/jquery.js')}}"></script>
  <script src="{{asset('lib/materialize/js/materialize.js')}}"></script>
  <script src="{{asset('js/graficoCentralTV.js')}}"></script>
  <script src="{{asset('js/init.js')}}"></script>
    <script src="{{asset('lib/zabuto_calendar/zabuto_calendar.js')}}"></script>

    <!--<script type="text/javascript" src="http://www.chartjs.org/assets/Chart.js">    </script>-->
    <script src="{{asset('lib/chart.js/dist/Chart.js')}}"></script>
    <!--<script src="{{asset('lib/chart.js/dist/Chart.bundle.js')}}"></script>-->
    <script src="{{asset('lib/chart.js/samples/utils.js')}}"></script>
    <script src="{{asset('lib/datatables.net/js/jquery.dataTables.js')}}"></script>
    

</body>
</html>
