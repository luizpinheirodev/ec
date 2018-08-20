@extends('layouts.admin')






@section('content')
<br>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <div class="col s12">
            <a href="{{ route('admin.index') }}" class="breadcrumb bread_cad"> Admin</a>
            <a href="#!" class="breadcrumb">Dependencia</a>
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
                                <form action="{{ route('dependencia.salvar') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('atividade_id1') ? 'has-error' : '' }} col s6">
                                        <label for="atividade_id1">Para realizar</label>
                                        <div class="input-field">
                                            <select name="atividade_id1" required autofocus>
                                                    <option value="" disabled selected>Selecione a atividade</option>
                                                @foreach($atividades as $atividade)
                                                    <option value="{{ $atividade->id }}">{{ $atividade->gerencia['sigla'] }} - {{ $atividade->nome }} - {{ $atividade->empresa['nome'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('atividade_id2') ? 'has-error' : '' }} col s6">
                                        <label for="atividade_id2">Realizar primeiro</label>
                                        <div class="input-field">
                                            <select name="atividade_id2" required autofocus>
                                                    <option value="" disabled selected>Selecione a atividade</option>
                                                @foreach($atividades as $atividade)
                                                    <option value="{{ $atividade->id }}">{{ $atividade->gerencia['sigla'] }} - {{ $atividade->nome }} - {{ $atividade->empresa['nome'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                <th>Para realizar</th>
                                <th>Realizar primeiro</th>
                            </tr>
                        </thead>
                        <tbody>
         

                            @foreach($dependencias as $dependencia)
                            <tr>
                                <td scope="row">{{ $dependencia->id }}</td>
                                <td> {{ $dependencia->atividade1->gerencia['sigla'] }} - {{ $dependencia->atividade1['nome'] }} - {{ $dependencia->atividade1->empresa['nome'] }}</td>
                                <td> {{ $dependencia->atividade2->gerencia['sigla'] }} - {{ $dependencia->atividade2['nome'] }} - {{ $dependencia->atividade2->empresa['nome'] }}</td>
                                <td>
                                    <a class="waves-effect waves-light btn light-green accent-3" href="#modalM1{{$dependencia->id}}">Editar</a>
                                    <div id="modalM1{{$dependencia->id}}" class="modalM">
                                        <div class="modalM-content">
                                            <form action="{{route('dependencia.atualizar', $dependencia->id)}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                
                                                <div class="form-group">
                                                    <label for="atividade_id1">Para realizar</label>
                                                    <select name="atividade_id1" required>
                                                        <option value="{{$dependencia->atividade_id1}}" disabled selected>{{ $dependencia->atividade1['nome'] }}</option>
                                                        @foreach($atividades1 as $atividade1)
                                                            <option value="{{ $atividade1->id }}"> {{ $atividade1->nome }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="atividade_id2">Realizar primeiro</label>
                                                    <select name="atividade_id2" required>
                                                        <option value="{{$dependencia->atividade_id2}}" disabled selected>{{ $dependencia->atividade2['nome'] }}</option>
                                                        @foreach($atividades2 as $atividade2)
                                                            <option value="{{ $atividade2->id }}"> {{ $atividade2->nome }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                                <button class="btn btn-info">Atualizar</button>

                                            </form>
                                        </div>
                                        <div class="modalM-footer">
                                            <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Cancelar</a>
                                        </div>
                                    </div>

                                    <a class="waves-effect waves-light btn red accent-4" href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('dependencia.deletar', $dependencia->id) }}' : false)">Deletar</a>
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
