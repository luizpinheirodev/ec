@extends('layouts.admin')

@section('content')
<br>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <div class="col s12">
            <a href="{{ route('admin.index') }}" class="breadcrumb bread_cad"> Admin</a>
            <a href="#!" class="breadcrumb">Período</a>
        </div>
    </div>
</nav>


<div class="card demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid cad_card">
        <div class="card-content">
            <div class="row">
                <div class="container">
                    @can('dev')
                        <ul class="collapsible" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header">
                                    <i class="material-icons">add_circle_outlines</i>Adicionar
                                </div>
                                <div class="collapsible-body">
                                    <form action="{{ route('periodo.salvar') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome" class="form-control" placeholder="Nome da periodo - Formato 02/2018" required>
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
                    @endcan
                    <table class="bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Dias de fechamento</th>
                                <th>Atingimento</th>
                                <th>Comentário</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($periodos as $periodo)
                            <tr>
                                <th scope="row">{{ $periodo->id }}</th>
                                <td>{{ $periodo->nome }}</td>
                                <td>{{$periodo->diasfechamento}}</td>
                                <td>{{$periodo->atingimento}}</td>
                                <td>@php echo $periodo->comentario @endphp</td>
                                <td>
                                    
                                    <a class="waves-effect waves-light btn light-green accent-3" href="#modalM1{{$periodo->id}}">Editar</a>
                                    <div id="modalM1{{$periodo->id}}" class="modalM">
                                        <div class="modalM-content">
                                            <form action="{{route('periodo.atualizar', $periodo->id)}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                
                                                <div class="form-group">
                                                    <label for="nome">Dias de Fechamento</label>
                                                    <input type="text" name="diasfechamento" class="form-control" placeholder="Dias de Fechamento" value="{{$periodo->diasfechamento}}" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="nome">Atingimento</label>
                                                    <input type="text" name="atingimento" class="form-control" placeholder="Atingimento" value="{{$periodo->atingimento}}" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="nome">Comentário</label>
                                                    <textarea id="textarea1" name="comentario" class="materialize-textarea" value="{{$periodo->comentario}}">{{ ($periodo->comentario)}}</textarea>
                                                </div>


                                                <button class="btn btn-info">Atualizar</button>

                                            </form>
                                        </div>
                                        <div class="modalM-footer">
                                            <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Cancelar</a>
                                        </div>
                                    </div>

                                   <!-- <a class="waves-effect waves-light btn red accent-4" href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('periodo.deletar', $periodo->id) }}' : false)">Deletar</a> -->
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
