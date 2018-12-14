<!DOCTYPE html>
<html lang="pt-br">
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Encerramento Contábil') }}</title>

    @php $version = 9 @endphp
    <!-- Styles -->
    <!--Import Google Icon Font-->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/app.css') }}?v={{$version}}" rel="stylesheet">
    <link href="{{ asset('lib/datatables.net-dt/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/zabuto_calendar/zabuto_calendar.css') }}?v={{$version}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('lib/materialize/css/materialize.css') }}?v={{$version}}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}?v={{$version}}" rel="stylesheet">
    <link href="{{ asset('css/graficoCentral.css') }}?v={{$version}}" rel="stylesheet">
    <link href="{{ asset('lib/font-awesome-4.7.0/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/font-awesome-4.7.0/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/coments.css') }}?v={{$version}}" rel="stylesheet">
    
    
</head>
<body id="app-layout" class="" style="display: flex; min-height: 100vh; flex-direction: column;"> 
  <header>
    @include('layouts._includes._site._nav')
  </header>
  <main style="flex: 1 0 auto;">
    
    <!--
    @if(Session::has('mensagem'))
      <div class="container">
        <div class="row">
          <div class="card {{ Session::get('mensagem')['class'] }}">
            <div align="center" class="card-content">
              {{ Session::get('mensagem')['msg'] }}
            </div>
          </div>
        </div>
      </div>
    @endif 
    -->
    <div class="container">
        @yield('content')
    </div>
     
  </main>  


<footer class="page-footer blue-grey darken-1 <accent-2></accent-2>" >
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <img src="{{asset('img/site/TAG_ESTRUTURA_VERTICAL_COLORIDA_RGB.png')}}" class="sicredi_logo_footer">
        <!--<h5 class="white-text">Confederação Sicredi</h5>-->
        <p>
          <a href="#"><i class="white-text mdi mdi-facebook mdi-24px"></i></a>
          <a href="#"><i class="white-text mdi mdi-twitter mdi-24px"></i></a>
          <a href="#"><i class="white-text mdi mdi-youtube-play mdi-24px"></i></a>
        </p>
      </div>
      <div class="col l4 offset-l2 s12">
        <p class="grey-text text-lighten-4">Dashboard de controle do Encerramento Contábil.</p>
        <!--<h5 class="white-text">Links</h5>-->
        <br>
        <ul>
          <li><a class="grey-text text-lighten-3" href="{{ url('/home') }}">Home</a></li>
          <li><a class="grey-text text-lighten-3" href="{{ route('tarefa.index') }}">Minhas tarefas</a></li>
          <li><a class="grey-text text-lighten-3" href="{{ route('contas.index') }}">Contas/Críticas</a></li>
          <li><a class="grey-text text-lighten-3" href="{{ route('pendencia.index') }}">Relatório</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div class="col s9 m9 l9">  
          © 2018 Copyright Text
        </div>
        <div class="col s3 m3 l3">
            Dúvidas ou sugestões<a class="grey-text text-lighten-4 " href="mailto:luiz_geraldo@sicredi.com.br?Subject=App%20-%20Encerramento%20Contábil"><img src="{{asset('img/site/email.png')}}" class="mailto"></a>
        </div>
      </div>
    </div>
  </div>
</footer>
            
    <script src="{{ asset('js/app.js') }}?v={{$version}}"></script>
    <script src="{{asset('lib/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset('lib/zabuto_calendar/zabuto_calendar.js')}}?v={{$version}}"></script>
    <script src="{{asset('lib/materialize/js/materialize.js')}}?v={{$version}}"></script>

    <script src="{{asset('js/init.js')}}?v={{$version}}"></script>
    <script src="{{asset('js/graficoCentral.js')}}?v={{$version}}"></script>
    <script src="{{asset('lib/chart.js/dist/Chart.js')}}"></script>
    <!--<script src="{{asset('lib/chart.js/dist/Chart.bundle.js')}}"></script>-->
    <script src="{{asset('lib/chart.js/samples/utils.js')}}"></script>
    <script src="{{asset('lib/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('lib/font-awesome-4.7.0/js/fontawesome-all.min.js')}}"></script>

  </body>
</html>