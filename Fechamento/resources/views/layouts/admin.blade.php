<!DOCTYPE html>
<html lang="pt-br">
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Encerramento Contábil') }}</title>

    <!-- Styles -->
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('lib/materialize/css/materialize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/graficoCentral.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/font-awesome-4.7.0/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/zabuto_calendar/zabuto_calendar.css') }}" rel="stylesheet">
    
    
</head>
<body id="app-layout" class="">
  <header>
    @include('layouts._includes._site._navAdmin')
  </header>
  <main>
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


<footer class="page-footer light-green <accent-2></accent-2>" >
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">Confederação Sicredi</h5>
        <p class="grey-text text-lighten-4">Dashboard de controle do Encerramenteo Contábil.</p>
        <p>
          <a href="#"><i class="white-text mdi mdi-facebook mdi-24px"></i></a>
          <a href="#"><i class="white-text mdi mdi-twitter mdi-24px"></i></a>
          <a href="#"><i class="white-text mdi mdi-youtube-play mdi-24px"></i></a>
        </p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-text">Links</h5>
        <ul>
          <li><a class="grey-text text-lighten-3" href="{{ url('/home') }}">Home</a></li>
          <li><a class="grey-text text-lighten-3" href="{{ route('tarefa.index') }}">Minhas tarefas</a></li>
          <li><a class="grey-text text-lighten-3" href="{{ route('pendencia.index') }}">Relatório</a></li>

        </ul>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
    © 2017 Copyright Text
    <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
    </div>
  </div>
</footer>
            

    <script src="{{asset('lib/jquery/dist/jquery.js')}}"></script>
    <script src="{{asset('lib/materialize/js/materialize.js')}}"></script>
    <script src="{{asset('lib/zabuto_calendar/zabuto_calendar.js')}}"></script>

    <script src="{{asset('js/init.js')}}"></script>
    <script src="{{asset('js/graficoCentral.js')}}"></script>
    <script src="{{asset('lib/chart.js/dist/Chart.bundle.js')}}"></script>
    <script src="{{asset('lib/chart.js/samples/utils.js')}}"></script>

</body>
</html>
