
<form action="{{ route('relatorio.gerarRelatorio', 1) }}" method="post">
{{ csrf_field() }}
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Relatório Customizado</span>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <select name="periodo" required: true>
                            <option value="{{$periodos[0]->id}}" selected>{{ $periodos[0]->nome }}</option>
                                @for($i = 1; $i < count($periodos); $i++ )
                                    <option value="{{ $periodos[$i]->id }}" > {{ $periodos[$i]->nome }}  </option>
                                @endfor
                            </select>
                            <label>Período</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <select name="gerencia">
                                <option value="%" selected>Todas</option>
                                @foreach ($gerencias as $gerencia)
                                    <option value="{{ $gerencia->id }}" > {{ $gerencia->nome }}  </option>
                                @endforeach
                            </select>
                            <label>Gerência</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <select name="empresa">
                                <option value="%" selected>Todas</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}" > {{ $empresa->nome }}  </option>
                                @endforeach
                            </select>
                            <label>Empresa</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <select name="user">
                                <option value="%" selected>Todos</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" > {{ $user->nome }}  </option>
                                @endforeach
                            </select>
                            <label>Usuário</label>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="card-action">
                    <button type="'" class="waves-effect waves-teal btn-flat" style="color:orange">Exportar</button>
                </div>
            </div>
        </div>
    
</form>

<form action="{{ route('relatorio.gerarRelatorio', 2) }}" method="post">
    {{ csrf_field() }}
    
    <div class="col s12 m6">
        <div class="card blue-grey darken-1">
            <div class="card-content white-text">
                <span class="card-title">Relatório por Gestor</span>
                <div class="row">
                    <div class="input-field col s12 m12">
                        <select name="periodo" required: true>
                            <option value="{{$periodos[0]->id}}" selected>{{ $periodos[0]->nome }}</option>
                            @for($i = 1; $i < count($periodos); $i++ )
                                <option value="{{ $periodos[$i]->id }}" > {{ $periodos[$i]->nome }}  </option>
                            @endfor
                        </select>
                        <label>Período</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12">
                        <select name="gestor">
                            <option value="%" selected>Todos</option>
                            @foreach ($gestores as $gestor)
                                <option value="{{ $gestor->id }}" > {{ $gestor->nome }}  </option>
                            @endforeach
                        </select>
                        <label>Gestor</label>
                    </div>
                </div>
            <div class="card-action">
                <button type="'" class="waves-effect waves-teal btn-flat " style="color:orange" >Exportar</button>
            </div>
        </div>
    </div>
    

    

</form>

<form action="{{ route('relatorio.gerarRelatorio', 3) }}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col s12 m12">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Relatório de atrasados</span>
                    <div class="row">
                        <div class="input-field col s12 m12">
                            <select name="periodo" required: true>
                                <option value="{{$periodos[0]->id}}" selected>{{ $periodos[0]->nome }}</option>
                                @for($i = 1; $i < count($periodos); $i++ )
                                    <option value="{{ $periodos[$i]->id }}" > {{ $periodos[$i]->nome }}  </option>
                                @endfor
                            </select>
                            <label>Período</label>
                        </div>
                    </div>
                <div class="card-action">
                    <button type="'" class="waves-effect waves-teal btn-flat" style="color:orange" >Exportar</button>
                </div>
            </div>
        </div>
    </div>
</form>
