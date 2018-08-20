
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            @if(in_array('empresa', explode('/', Request::url())))
                <li class="tab col s4"><a class="active" href="#test1">Empresa</a></li>
            @else
                <li class="tab col s4"><a class="" href="#test1">Empresa</a></li>
            @endif
            @if(in_array('gerencia', explode('/', Request::url())))
                <li class="tab col s4"><a class="active" href="#test2">Gerência</a></li>
            @else
                <li class="tab col s4"><a href="#test2">Gerência</a></li>
            @endif
            @if(in_array('dia', explode('/', Request::url())))
                <li class="tab col s4"><a class="active" href="#test3">Dia</a></li>
            @else
                <li class="tab col s4"><a class="" href="#test3">Dia</a></li>
            @endif
        </ul>
    </div>
</div>


    <div id="test1" class="col s12">
        @foreach($empresas as $empresa)
            <a href="{{route('customizado.empresa', $empresa->id)}}" method="post" style="margin:5px; " class="waves-effect waves-light btn blue-grey darken-2"> {{$empresa['nome']}} </a>
        @endforeach
    </div>
  

    <div id="test2" class="col s12">
        @foreach($gerencias as $gerencia)
            <a href="{{route('customizado.gerencia', $gerencia->id)}}" style="margin:5px; " class="waves-effect waves-light btn blue-grey darken-2"> {{$gerencia['sigla']}} </a>
        @endforeach
    </div>

    <div id="test3" class="col s12">
        <a style="margin:5px;" href="{{route('customizado.dia', -1)}}" class="waves-effet waves-light btn blue-grey darken-2"> Último dia </a>
        <a style="margin:5px;" href="{{route('customizado.dia', 1)}}" class="waves-effect waves-light btn blue-grey darken-2"> Primeiro dia </a>
        <a style="margin:5px;" href="{{route('customizado.dia', 2)}}" class="waves-effect waves-light btn blue-grey darken-2"> Segundo dia </a>
        <a style="margin:5px;" href="{{route('customizado.dia', 3)}}" class="waves-effect waves-light btn blue-grey darken-2"> Terceiro dia </a>
        <a style="margin:5px;" href="{{route('customizado.dia', 4)}}" class="waves-effect waves-light btn blue-grey darken-2"> Quarto dia </a>
        <a style="margin:5px;" href="{{route('customizado.dia', 5)}}" class="waves-effect waves-light btn blue-grey darken-2"> Quinto dia </a>
    </div>

    <br>
        <br>
<div class="divider"></div>
<hr>
    