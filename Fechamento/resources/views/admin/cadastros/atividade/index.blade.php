@extends('layouts.admin')






@section('content')
<br>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <div class="col s12">
            <a href="{{ route('admin.index') }}" class="breadcrumb bread_cad"> Admin</a>
            <a href="#!" class="breadcrumb">Atividade</a>
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
                                <form action="{{ route('atividade.salvar') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }} col s10">
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome" class="form-control" placeholder="Nome da atividade" required autofocus>
                                            @if( $errors->has('nome'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('nome')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-check {{ $errors->has('destaque') ? 'has-error' : '' }} col s2">
                                            <input type="hidden" name="destaque" value=0><input type="checkbox" name="destaque" class="form-check-input" id="destaque" value=1>
                                            <!--<input type="checkbox" name="destaque" class="form-check-input" id="destaque">-->
                                            <label for="destaque">Destaque</label>
                                            @if( $errors->has('destaque'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('destaque')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('empresa_id') ? 'has-error' : '' }} col s6">
                                        <label for="empresa_id">Empresa</label>
                                        <div class="input-field">
                                            <select name="empresa_id"  required autofocus>
                                                    <option value="" disabled selected>Selecione a empresa</option>
                                                @foreach($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}"> {{ $empresa->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('gerente_id') ? 'has-error' : '' }} col s6">
                                        <label for="gerencia_id">Gerência</label>
                                        <div class="input-field">
                                            <select name="gerencia_id"  required autofocus>
                                                    <option value="" disabled selected>Selecione a gerência</option>
                                                @foreach($gerencias as $gerencia)
                                                    <option value="{{ $gerencia->id }}"> {{ $gerencia->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('usuario_id') ? 'has-error' : '' }} col s6">
                                        <label for="usuario_id">Usuário</label>
                                        <div class="input-field">
                                            <select name="usuario_id" required autofocus>
                                                    <option value="" disabled selected>Selecione o usuário</option>
                                                @foreach($usuarios as $usuario)
                                                    <option value="{{ $usuario->id }}"> {{ $usuario->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('float') ? 'has-error' : '' }} col s6">
                                        <label for="float">Float</label>
                                        <div class="input-field">
                                            <select name="float" required autofocus>
                                                <option value="" disabled selected>Selecione o float</option>
                                                <option value="-2">Penúltimo dia útil</option>
                                                <option value="-1">Último dia útil</option>
                                                <option value="1">Primeiro dia útil</option>
                                                <option value="2">Segundo dia útil</option>
                                                <option value="3">Terceiro dia útil</option>
                                                <option value="4">Quarto dia útil</option>
                                                <option value="5">Quinto dia útil</option>
                                                <option value="6">Sexto dia útil</option>
                                                <option value="-15">Dia 15</option>
                                                <option value="-20">Dia 20</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group {{ $errors->has('float_hora') ? 'has-error' : '' }} col s6">
                                        <label for="float_hora">Horário</label>
                                        <input type="text" name="float_hora" class="timepicker" placeholder="Horário da atividade" required autofocus>
                                        @if( $errors->has('float_hora'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('float_hora')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('duracao') ? 'has-error' : '' }} col s6">
                                        <label for="duracao">Duração</label>
                                        <input type="text" name="duracao" class="form-control" placeholder="Duração do atividade em horas">
                                        @if( $errors->has('ramal'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('duracao')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <hr>
                                    
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
                                <th>Float</th>
                                <th>Horário</th>
                                <th>Usuário</th>
                                <th>Gerência</th>
                                <th>Empresa</th>
                                <th>Ação</th>
                                <th>Backup</th>
                            </tr>
                        </thead>
                        <tbody>
         

                            @foreach($atividades as $atividade)
                            <tr>
                                <td scope="row">{{ $atividade->id }}</td>
                                <td>{{ $atividade->nome }}</td>
                                <td>{{ $atividade->float }}</td>
                                <td>{{ $atividade->float_hora }}</td>
                                <td>{{ $atividade->usuario['nome'] }}</td>

                                <td>{{ $atividade->gerencia['nome'] }}</td>
                                <td>{{ $atividade->empresa['nome'] }}</td>  
                                <td>
                                    <a style="height: 36px; width: 112px; padding:0px" class="waves-effect waves-light btn light-green accent-3" href="#modalM1{{$atividade->id}}">Editar</a>
                                    <div id="modalM1{{$atividade->id}}" class="modalM">
                                        <div class="modalM-content">
                                            <form action="{{route('atividade.atualizar', $atividade->id)}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                <div class="row">
                                                <div class="form-group col s10">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" name="nome" class="form-control" placeholder="Nome da Atividade" value="{{$atividade->nome}}" required >
                                                </div>
                                                <div class="form-check col s2">
                                                    @if($atividade->destaque == 0)
                                                        <input type="hidden" name="destaque" value=0><input type="checkbox" name="destaque" class="form-check-input" id="destaqueEd{{$atividade->id}}" value=1>
                                                    @else
                                                        <input type="hidden" name="destaque" value=0><input type="checkbox" name="destaque" class="form-check-input" id="destaqueEd{{$atividade->id}}" value=1 checked>
                                                    @endif
                                                    <label for="destaqueEd{{$atividade->id}}">Destaque</label>
                                                </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="float">Float</label>
                                                    <div class="input-field">
                                                            <select name="float" required autofocus>
                                                                <option value="{{$atividade->float}}" disabled selected>Selecione o float</option>
                                                                <option value="-2">Penúltimo dia útil</option>
                                                                <option value="-1">Último dia útil</option>
                                                                <option value="1">Primeiro dia útil</option>
                                                                <option value="2">Segundo dia útil</option>
                                                                <option value="3">Terceiro dia útil</option>
                                                                <option value="4">Quarto dia útil</option>
                                                                <option value="5">Quinto dia útil</option>
                                                                <option value="6">Sexto dia útil</option>
                                                                <option value="-15">Dia 15</option>
                                                                <option value="-20">Dia 20</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="float_hora">Horário</label>
                                                    <input type="text" name="float_hora" class="timepicker" placeholder="Horário da atividade" value="{{$atividade->float_hora}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="duracao">Duração</label>
                                                    <input type="text" name="duracao" class="form-control" placeholder="Duração da atividade" value="{{$atividade->duracao}}" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="usuario_id">Usuário</label>
                                                    <select name="usuario_id" required>
                                                        <option value="{{$atividade->usuario_id}}" disabled selected>{{ $atividade->usuario['nome'] }}</option>
                                                        @foreach($usuariosEd as $usuarioEd)
                                                            <option value="{{ $usuarioEd->id }}"> {{ $usuarioEd->nome }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gerencia_id">Gerencia</label>
                                                    <select name="gerencia_id" required>
                                                        <option value="{{$atividade->gerencia_id}}" disabled selected>{{ $atividade->gerencia['nome'] }}</option>
                                                        @foreach($gerenciasEd as $gerenciaEd)
                                                            <option value="{{ $gerenciaEd->id }}"> {{ $gerenciaEd->nome }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="empresa_id">Empresa</label>
                                                    <select name="empresa_id" required>
                                                        <option value="{{$atividade->empresa_id}}" disabled selected>{{ $atividade->empresa['nome'] }}</option>
                                                        @foreach($empresasEd as $empresaEd)
                                                            <option value="{{ $empresaEd->id }}"> {{ $empresaEd->nome }}</option>
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

                                    <a style="height: 36px; width: 55px;" class="waves-effect waves-light btn red accent-4" href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('atividade.deletar', $atividade->id) }}' : false)">Deletar</a>
                                </td>
                                <td>    
                                    @if($atividade->backup_id == null)
                                    
                                    <!--------------BACKUP----------- -->
                                    <a style="height: 36px; width: 112px; padding:0px"  class="waves-effect waves-light btn blue-grey darken-3" href="#modalMBackup{{$atividade->id}}">Backup</a>
                                    @else 
                                    {{ $atividade->backup['nome']}} <a class="" href="#modalMBackup{{$atividade->id}}"><i class="fa fa-edit"></i></a>
                                    @endif
                                    <div id="modalMBackup{{$atividade->id}}" class="modalM">
                                        <div class="modalM-content">
                                            <form action="{{route('atividade.backup', $atividade->id)}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="put">
                                                
                                                <div class="form-group col s12">
                                                    <label for="backup_id">Backup da atividade</label>
                                                    <select name="backup_id">
                                                        <option value="{{$atividade->backup_id}}" disabled selected>{{ $atividade->backup['nome'] }}</option>
                                                        {{ App\Http\Controllers\Admin\AtividadeController::ativBackup($atividade->gerencia_id) }}
                                                    </select>
                                                </div>
                                                
                                                

                                                <button class="btn btn-info">Atualizar</button>

                                            </form>
                                        </div>
                                        <div class="modalM-footer">
                                            <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Cancelar</a>
                                        </div>
                                    </div>
                                    <!--------------END BACKUP----------- -->
                                    

                                </td>
                            </tr>
                            @endforeach
            
                        </tbody>
                    </table>
                    {{ $atividades->links() }}
                </div>   
            </div>
        </div>
    </div>
</div>



@endsection
