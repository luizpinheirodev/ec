@extends('layouts.admin')


@section('content')
<br>
<nav>
    <div class="nav-wrapper blue-grey darken-3">
        <div class="col s12">
            <a href="{{ route('admin.index') }}" class="breadcrumb">Admin</a>
            <a href="#!" class="breadcrumb">Usuário</a>
        </div>
    </div>
</nav>


@if (Session::has('message1'))

<div class="row" id="alert_box">
    <div class="col s12 m12">
     <div class="card red darken-1">
      <div class="row">
       <div class="col s12 m10">
         <div class="card-content white-text">
            <p>{{ Session::get('message1') }}</p>
           
       </div>
     </div>
     <div class="col s12 m2">
       <i class="fa fa-times icon_style" id="alert_close" aria-hidden="true" style="position: absolute; right: 10px; top: 10px; font-size: 20px; color: white; cursor:pointer; " ></i>
     </div>
      </div>
     </div>
    </div>
</div>

@endif

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
                                <form action="{{ route('usuario.salvar') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} col s6">
                                        <label for="nome">Nome</label>
                                        <input type="text" name="nome" class="form-control" placeholder="Nome da usuario" required>
                                        @if( $errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nome')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('ramal') ? 'has-error' : '' }} col s6">
                                        <label for="ramal">Ramal</label>
                                        <input type="text" name="ramal" class="form-control" placeholder="Ramal do usuario">
                                        @if( $errors->has('ramal'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ramal')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}  col s6">
                                        <label for="email">Login</label>
                                        <input type="text" name="email" class="form-control" placeholder="Login do usuario" required>
                                        @if( $errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} col s6">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password do usuario" required>
                                        @if( $errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    
                                    <div class="file-field input-field col s12">
                                        <div class="btn">
                                            <span>Foto</span>
                                            <input type="file">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input name="foto" class="file-path validate" type="text">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group {{ $errors->has('gerente_id') ? 'has-error' : '' }} col s4">
                                        <label for="nivel">Gerente</label>
                                        <div class="input-field">
                                            <select name="gerente_id" >
                                                    <option value="" disabled selected>Selecione o gerente</option>
                                                @foreach($usuariosG as $usuarioG)
                                                    <option value="{{ $usuarioG->id }}"> {{ $usuarioG->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('gerencia_id') ? 'has-error' : '' }} col s4">
                                        <label for="nivel">Gerência</label>
                                        <div class="input-field">
                                            <select name="gerencia_id" required>
                                                    <option value="" disabled selected>Selecione a gerência</option>
                                                    @foreach($gerencias as $gerencia)
                                                    <option value="{{ $gerencia->id }}">{{ $gerencia->nome }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('nivel') ? 'has-error' : '' }} col s4">
                                        <label for="nivel">Nível</label>
                                        <div class="input-field">
                                            <select name="nivel" required>
                                                <option value="" disabled selected>Selecione o nível</option>
                                                @if($usuarioAut->nivel == 1)
                                                    <option value="1"> Desenvolvedor </option>
                                                @endif
                                                <option value="2"> Administrador </option>
                                                <option value="3"> Gestor </option>
                                                <option value="4"> Analista </option>
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
                                <th>Nome</th>
                                <th>Login</th>
                                <th>Ramal</th>
                                <th>Gerente</th>
                                <th>Gerência</th>
                                <th>Nível</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

         

                            @foreach($usuarios as $usuario)
                            <tr>
                                <td scope="row">{{ $usuario->id }}</td>
                                <td>{{ $usuario->nome }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->ramal }}</td>
                                <td>{{ $usuario->gerente['nome'] }}</td>
                                <td>{{ $usuario->gerencia['nome'] }}</td>
                                <td>{{ $usuario->nivel }}</td>
                                <td>
                                    <div class="row">
                                        <a style="height: 36px; width: 112px; padding:0px" class="waves-effect waves-light btn light-green accent-3" href="#modalM{{$usuario->id}}">Editar</a>
                                        <div id="modalM{{$usuario->id}}" class="modalM">
                                            <div class="modalM-content">
                                                <form action="{{route('usuario.atualizar', $usuario->id)}}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="put">
                                                    <div class="form-group col s6">
                                                        <label for="nome">Nome</label>
                                                        <input type="text" name="nome" class="form-control" placeholder="Nome do usuário" value="{{$usuario->nome}}" required>
                                                    </div>
                                                    <div class="form-group col s6">
                                                        <label for="ramal">Ramal</label>
                                                        <input type="text" name="ramal" class="form-control" placeholder="Ramal do usuário" value="{{$usuario->ramal}}">
                                                    </div>
                                                    <div class="form-group col s6">
                                                        <label for="email">Email</label>
                                                        <input type="text" name="email" class="form-control" placeholder="E-mail do usuário" value="{{$usuario->email}}" required>
                                                    </div>
                                                    <div class="form-group col s6">
                                                        <label for="password">Senha</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Senha do usuário" value="">
                                                    </div>
                                                    
                                                    <div class="form-group col s4">
                                                        <label for="gerente_id">Gerente</label>
                                                        <select name="gerente_id">
                                                            <option value="{{$usuario->gerente_id}}"  selected>{{ $usuario->gerente['nome'] }}</option>
                                                            @foreach($usuariosG as $usuarioG)
                                                                <option value="{{ $usuarioG->id }}"> {{ $usuarioG->nome }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col s4">
                                                        <label for="gerencia_id">Gerência</label>
                                                        <select name="gerencia_id" required>
                                                                <option value="{{$usuario->gerencia_id}}" selected>{{$usuario->gerencia['nome']}}</option>
                                                            @foreach($gerenciasE as $gerenciaE)
                                                                <option value="{{ $gerenciaE->id }}"> {{ $gerenciaE['nome'] }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col s4">
                                                        <label for="nivel">Nível</label>
                                                        <select name="nivel" required>
                                                            <option value="{{ $usuario->nivel }}"  selected>Selecione o nível</option>
                                                            
                                                            @if($usuarioAut->nivel == 1)
                                                                <option value="1"> Desenvolvedor </option>
                                                            @endif
                                                            <option value="2"> Administrador </option>
                                                            <option value="3"> Gestor </option>
                                                            <option value="4"> Analista </option>
                                                            
                                                        </select>
                                                    </div>


                                                    <button class="btn btn-info">Atualizar</button>

                                                </form>
                                            </div>
                                            <div class="modalM-footer">
                                                <a href="#!" class="modalM-action modalM-close waves-effect waves-green btn-flat">Cancelar</a>
                                            </div>
                                        </div>

                                        <a style="height: 36px; width: 112px; padding:0px" class="waves-effect waves-light btn red accent-4" href="javascript:(confirm('Deletar esse registro?') ? window.location.href='{{ route('usuario.deletar', $usuario->id) }}' : false)">Deletar</a>
                                        
                                        
                                    </div>
                                </td>
                            </tr>
                            @endforeach
            
                        </tbody>
                    </table>
                    {{ $usuarios->links() }}
                </div>   
            </div>
        </div>
    </div>
</div>



@endsection
