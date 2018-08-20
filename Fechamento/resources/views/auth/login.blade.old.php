@extends('layouts.app')

@section('content')

@push('styles')
    <link href="{{asset('css/app.css')}}" />
@endpush
<link href="{{ asset('css/styles-login-v2.css') }}" rel="stylesheet">

<main>
    <div class="wrapper">
        <div class="image">
            <img src="{{asset('img/login/arte-login-rede.png')}}">
        </div>
        <div class="login-box-wrapper">
            <div class="login-box">
                <div class="title">
                    <h1>Insira suas credenciais</h1>
                </div>
                <form id ="formLogin" method="post" action="">
                    <div class="form-group usuario">
                        <input type="text" class="form-control" id="fieldUser" placeholder="Usu&aacute;rio" name="USER">
                    </div>
                    <div class="form-group senha">
                        <input type="password" class="form-control" id="fieldPassword" placeholder="Senha" name="PASSWORD">
                    </div>
                    <div class="erro" id="error" style="display: none;">
                        Usu&aacute;rio ou senha incorretos.<br />
                        Tente novamente.
                    </div>
                    <div class="validate">

                        <div class="checkbox">
                            <label><input type="checkbox" value="" name="checkbox" id="checkbox">Lembrar meu usu&aacute;rio</label>
                        </div>

                        <INPUT TYPE=HIDDEN NAME="SMENC" VALUE="ISO-8859-1">
                        <INPUT type=HIDDEN name="SMLOCALE" value="US-EN">
                        <input type=hidden name=target value="HTTP://redecolaborativa.sicredi.com.br/webcenter/">
                        <input type=hidden name=smquerydata value="">
                        <input type=hidden name=smauthreason value="0">
                        <input type=hidden name=smagentname value="kUuPTPMVBv7wI73XXdMOPY5CKMFjDwO/93bG3YfAoRx2C7YAtYoo0DxQc5GZOzks">
                        <input type=hidden name=postpreservationdata value="">
                        <!--<input type="button" id="btnSubmit" class="btn" value="Entrar">-->
                        <input class="btn" id="btnSubmit" type="submit" value="Entrar"/>
                    </div>
                </form>
            </div>
            <div class="logo">
            <img src="{{asset('img/login/logo-sicredi-login.png')}}">
            </div>
        </div>
    </div>
</main>





















<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Entrar</div>
                <div class="panel-body">
                    <!--<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">-->
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('loginLdap') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Login (LDAP)</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Entrar
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
@endsection
