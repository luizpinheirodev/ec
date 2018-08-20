@extends('layouts.app')

@section('content')

@if(session()->has('changePass'))
    <div class="alert alert-{{ session('changePass') }}"> 
    {!! session('changePass') !!}
    </div>
@endif
@if($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Alterar Senha</div>
                <div class="panel-body">
                    <form name="fomulario" class="form-horizontal" role="form" method="POST" action="{{ route('user.update') }}" onsubmit="return validarSenha(this);"  >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('currentPassword') ? ' has-error' : '' }}">
                            <label for="currentPassword" class="col-md-4 control-label">Senha Atual</label>

                            <div class="col-md-6">
                                <input id="currentPassword" type="password" class="form-control" name="currentPassword" required>

                                @if ($errors->has('currentPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('currentPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('newPassword') ? ' has-error' : '' }}">
                            <label for="newPassword" class="col-md-4 control-label">Nova Senha</label>

                            <div class="col-md-6">
                                <input id="newPassword" type="password" class="form-control" name="newPassword" required>

                                @if ($errors->has('newPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('newPasswordAgain') ? ' has-error' : '' }}">
                            <label for="newPasswordAgain" class="col-md-4 control-label">Confirme a nova senha </label>

                            <div class="col-md-6">
                                <input id="newPasswordAgain" type="password" class="form-control" name="newPasswordAgain" required>

                                @if ($errors->has('newPasswordAgain'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newPasswordAgain') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Alterar
                                </button>

                                <!--
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                                -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function validarSenha(form){
        newPassword = document.getElementById('newPassword').value;
        newPasswordAgain = document.getElementById('newPasswordAgain').value;
        if(newPassword != newPasswordAgain){
            alert("Senha não confere!");
            document.getElementById("newPasswordAgain").focus();
            return false;
        }
    }

</script>
@endsection
