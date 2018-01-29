@extends('layouts.app')

@section('assets')
	@parent
	<link rel="stylesheet" href="{{URL::asset('css/login.css')}}"/>
@overwrite

@section('content')
<div class="login-form">
    {{Form::open(['url'=>url('login'),'class'=>'form-horizontal','role'=>'login'])}}
        <img src="{{URL::asset('images/logo.png')}}" class="img-responsive" alt="" />
        <input type="text" name="usulogin" placeholder="Login" required class="form-control input-lg" />
        <input type="password" name="ususenha" placeholder="Senha" required class="form-control input-lg" />
        <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Entrar</button>
        <div class="col self-align-center">
            <label class="control-label">
                    <input type="checkbox" name="lembrar"/> Lembrar-me
            </label>
            <br>
            <a href="{{url('/esqueci')}}">Esqueci minha senha</a>
        </div>
    {{Form::close()}}
    <div class="form-links">
        <a href="http://www.ivida.com.br">www.ivida.com.br</a>
    </div>
</div>
@endsection