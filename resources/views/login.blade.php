@extends('layouts.app')

@section('assets')
	@parent
	<link rel="stylesheet" href="{{URL::asset('css/login.css')}}"/>
@overwrite

@section('content')
	<section class="container">
		<section class="login-form">
			<form method="post" action="" role="login" class="form-horizontal">
				<img src="{{URL::asset('images/logo.png')}}" class="img-responsive" alt="" />
				<input type="email" name="usulogin" placeholder="Login" required class="form-control input-lg" />
				<input type="password" name="ususenha" placeholder="Senha" required class="form-control input-lg" />
				<button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Entrar</button>
				<div class="col self-align-center">
					<label class="control-label">
						<input type="checkbox" name="lembrar"/> Lembrar-me
					</label>
					<br>
					<a href="{{url('/esqueci')}}">Esqueci minha senha</a>
				</div>
			</form>
			<div class="form-links">
				<a href="http://www.ivida.com.br">www.ivida.com.br</a>
			</div>
		</section>
	</section>
@endsection