@extends('layouts.admin')

@section('content')

<div class="container">
	
    <h3 class="center"></h3>
    <div class="switch">
        <label>
            Não
            @if ($periodos->resultado == 1)
                <input id='idResult' value='{{ $periodos->id }}' name='switch_Activate' type='checkbox' 
                onclick="javascript:(confirm('Alterar lançamentos em resultado?') ? jsresultado() : false)" checked>
            @else
                <input id='idResult' value='{{ $periodos->id }}' name='switch_Activate' type='checkbox' 
                onclick="javascript:(confirm('Alterar lançamentos em resultado?') ? jsresultado() : false)">
            @endif
            <span class="lever"></span>
            Sim
        </label><span class="swit">Bloquear lançamentos em resultado</span>
    </div>
    <br>
    <div class="switch">
        <label>
            Não
            @if ($periodos->periodo == 1)
                <input id='idPeriodo' value='{{ $periodos->id }}' name='switch_Activate' type='checkbox' 
                onclick="javascript:(confirm('Alterar período?') ? jsperiodo() : false)" checked>
            @else
                <input id='idPeriodo' value='{{ $periodos->id }}' name='switch_Activate' type='checkbox' 
                onclick="javascript:(confirm('Alterar período?') ? jsperiodo() : false)">
            @endif
            <span class="lever"></span>
            Sim
        </label><span class="swit">Bloquear período</span>
    </div>
    <br>

	<div class="row">
        <div class="col s12 m4">
            <div class="card horizontal">
                <div class="card-image">
                    <img src="{{asset('img/admin/caduceu.jpg')}}" width="100" height="190">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Usuários</span>
                    </div>
                    <p>Área para cadastro e listagem dos usuários</p>
                    <div class="card-action">
                        <a href="{{ route('usuario.index')}}">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card horizontal">
                <div class="card-image">
                    <img src="{{asset('img/admin/caduceu.jpg')}}" width="100" height="190">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Gerências</span>
                    </div>
                    <p>Área para cadastro e listagem das gerências</p>
                    <div class="card-action">
                        <a href="{{ route('gerencia.index')}}">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card horizontal">
                <div class="card-image">
                    <img src="{{asset('img/admin/caduceu.jpg')}}" width="100" height="190">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Empresas</span>
                    </div>
                    <p>Área para cadastro e lista das empresas</p>
                    <div class="card-action">
                        <a href="{{ route('empresa.index')}}">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
	</div>
	<div class="row">
        <div class="col s12 m4">
          <div class="card horizontal">
                <div class="card-image">
                    <img src="{{asset('img/admin/caduceu.jpg')}}" width="100" height="190">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Atividades</span>
                    </div>
                    <p>Área para cadastro e lista das Atividades</p>
                    <div class="card-action">
                        <a href="{{ route('atividade.index')}}">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
          <div class="card horizontal">
                <div class="card-image">
                    <img src="{{asset('img/admin/caduceu.jpg')}}" width="100" height="190">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Dependencias</span>
                    </div>
                    <p>Área para cadastro e listagem das dep.</p>
                    <div class="card-action">
                        <a href="{{ route('dependencia.index')}}">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col s12 m4">
            <div class="card horizontal">
                <div class="card-image">
                    <img src="{{asset('img/admin/caduceu.jpg')}}" width="100" height="190">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Feriados</span>
                    </div>
                    <p>Área para cadastro e listagem dos feriados</p>
                    <div class="card-action">
                        <a href="{{ route('feriado.index')}}">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
           
    </div>

	
</div>

@endsection