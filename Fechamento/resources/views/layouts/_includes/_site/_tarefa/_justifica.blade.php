<!--<h2 class="header">Horizontal Card</h2>-->
<div class="row">
    <div class="col s12 m5">
        <div class="card-panel red darken-4">
            <span class="white-text"><b>Atividade concluída com atraso.</b></span>
        </div>
    </div>
</div>

<div class="row">
    <form class="col s12" enctype="multipart/form-data" action="{{ route('tarefa.concluirAtraso',['tarefa'=>$atividade_periodo->id, 'atividade'=>$atividade_periodo->atividade_id]) }}" method="post">
        {{ csrf_field() }}
        
        <p>
            <input name="group1" value="um" type="radio" onclick="javascript:yesnoCheck();" id="test" />
            <label for="test">Atraso de dependência de outra área.</label>
        </p>
        <div id="append">
        </div>
        <p>
            <input name="group1" value="dois" type="radio" onclick="javascript:yesnoCheck();" id="test2" />
            <label for="test2">Erro de sistema. </label>
        </p>
        <div id="append2">
        </div>
        <p>
            <input name="group1" value="outro" type="radio" onclick="javascript:yesnoCheck();" id="test3" />
            <label for="test3">Outro: </label>
        </p>
        
        <div id="append3">
        </div>

        <button class="btn waves-effect waves-light right" >Concluir</button>

    </form>
</div>


