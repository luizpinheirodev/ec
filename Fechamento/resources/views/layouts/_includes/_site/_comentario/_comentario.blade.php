<!--<h2 class="header">Horizontal Card</h2>-->



<div class="row">
    <form class="col s12" enctype="multipart/form-data" action="{{ route('comentario.salvar') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="input-field col s12">
                <textarea name="texto" id="textarea1" class="materialize-textarea" required></textarea>
                <label for="textarea1">Insira seu comentário</label>
            </div>
        </div>

        <!--
        <div class="file-field input-field">
            <div class="btn">
                <i class="fa fa-paperclip" aria-hidden="true"></i>
                <span>Anexo</span>
                <input name="anexo" type="file" multiple>
            </div>
            <div class="file-path-wrapper">
                <input name="anexo" class="file-path validate" type="text" placeholder="Inserir anexo">
            </div>
        </div>
        -->
        
        <div class="input-field col s6">
            <select name="atividade_periodo_id">
                <option value="" disabled selected>Escolha a tarefa</option>
                @foreach ($tarefas as $tarefa)
                    <option value="{{ $tarefa->id }}"> {{ $tarefa->atividade['nome'] }} </option>
                @endforeach
                
            </select>
            <label>Vincular a tarefa</label>
        </div>
            

        <button class="btn waves-effect waves-light right" >Enviar
        </button>

    </form>
</div>



<!--COMMENT AREA -->
<div class="divider"></div>
<div class="divider"></div>
<div class="divider"></div>

@foreach ($comentarios as $comentario)
<div class="card horizontal">
    <div class="card-image">
        <img src="{{asset('img/site/user.png')}}" width="100" height="100" class="foto-contato">
    </div>
   
    <div class="card-stacked">
        <div class="card-content">
            <p class="titulo-comentario">

            @if ($comentario->atividade_periodo_id != null)
                <span class="left">{{ $comentario->atividade_periodo->atividade['nome'] }}</span>
            @endif
                <a class="">{{ $comentario->usuario['nome'] }} </a>  |  {{ $comentario->updated_at->format('d/m/Y') }} as {{ $comentario->updated_at->format('H:i') }}  @if($comentario->anexo != null) | 
                <a href="{{ URL::to( '/uploads/comentarios/' . $comentario->anexo)   }}" ><i class="fa fa-paperclip" aria-hidden="true"></i></a> @endif </p> 
            <div class="divider"></div>
            <p class="comentario">{{ $comentario['texto'] }} </p>
        </div>
         
        @foreach ($respostas as $resposta)
            @if($resposta->resposta_id == $comentario->id)
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="{{asset('img/site/user.png')}}" width="100" height="100" class="foto-contato">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p class="titulo-comentario"><a href="#" class="">{{ $resposta->usuario['nome'] }}</a>  | {{ $resposta->updated_at->format('d/m/Y') }} as {{ $resposta->updated_at->format('H:i') }}</p> 
                            <div class="divider"></div>
                            <p class="comentario">{{ $resposta['texto'] }}</p>
                        </div>
                    </div>
                </div>

            @endif
        @endforeach
        <div class="card-action">
            <ul class="collapsible-comment " data-collapsible="accordion">
                <li>
                    <div class="collapsible-header right">Responder</div>
                    <div class="collapsible-body">
                        <form class="col s12" action="{{ route('comentario.responder', $comentario->id) }}" method="post">
                        
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field col s9">
                                    <textarea name="text-resposta" id="textarea1" class="materialize-textarea"></textarea>
                                    <label for="textarea1">Insira sua resposta</label>
                                </div>
                                
                            </div>
                            <button class="btn waves-effect waves-light" >Enviar</button>
                        
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endforeach



