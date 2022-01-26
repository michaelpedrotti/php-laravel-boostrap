@extends('layout.lobby')

@section('content')
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif

	<p class="login-box-msg">@lang('Digite seu e-mail para restaurar sua senha')</p>

	<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
		{{ csrf_field() }}
		<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
			<input type="email" name="email" class="form-control" placeholder="E-mail">
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			@if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
			@endif
		</div>

		<div class="row">
			<div class="col-xs-offset-7 col-xs-5">
				<button type="submit" class="btn btn-primary btn-block btn-flat">@lang('Recuperar senha')</button>
			</div>
		</div>
	</form>
@endsection
