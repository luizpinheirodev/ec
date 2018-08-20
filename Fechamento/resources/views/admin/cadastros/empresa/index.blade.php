@extends('layouts.admin')

@section('content')
<br>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <div class="col s12">
            <a href="{{ route('admin.index') }}" class="breadcrumb bread_cad"> Admin</a>
            <a href="#!" class="breadcrumb">Empresa</a>
        </div>
    </div>
</nav>

<div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid cad_card">
        <div class="card-content">
            <div class="row">
                <div class="container">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header">
                                <i class="fa fa-plus-square-o fa-sm"></i>Adicionar
                            </div>
                            <div class="collapsible-body">
                                <form action="{{ route('empresa.salvar') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
                                        <label for="nome">Nome</label>
                                        <input type="text" name="nome" class="form-control" placeholder="Nome da empresa" required>
                                        @if( $errors->has('nome'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nome')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <button class="btn waves-effect light-green accent-3"> Salvar</button>

                                </form>
                            </div>
                        </li>
                    </ul>
                    <table class="bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($empresas as $empresa)
                            <tr>
                                <th scope="row">{{ $empresa->id }}</th>
                                <td>{{ $empresa->nome }}</td>
                                <td>
                                    
                                    <a class="waves-effect waves-light btn light-green accent-3" href="#modalM1{{$empresa->id}}">Editar</a>
                                    <div id="modalM1{{$empresa->id}}" class="modalM">
                                        <div class="modalM-content">
                                            <form action="{{route('empresa.atualizar', $empresa->id)}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                <div class="form-group">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" name="nome" class="form-control" placeholder="Nome da Empresa" value="{{$empresa->nome}}" required>
                                                </div>
                                                <button class="btn btn-info">Atualizar</button>

                                            </form>
                                        </div>
                                        <div class="modalM-footer">
                                            <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Cancelar</a>
                                        </div>
                                    </div>

                                    <a class="waves-effect waves-light btn red accent-4" href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('empresa.deletar', $empresa->id) }}' : false)">Deletar</a>
                                </td>
                            </tr>
                            @endforeach
            
                        </tbody>
                    </table>
                </div>   
            </div>
        </div>
    </div>
</div>



@endsection
