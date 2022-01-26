@extends('layout.lobby')
@section('content')

<div class="card">
    <div class="card-body login-card-body">
		<p class="login-box-msg">Sign in to start your session</p>

		<form action="{{ route('login') }}" method="post">
			
			{{ csrf_field() }} 
			
			<div class="input-group mb-3">
				<input type="email" name="email" class="form-control" placeholder="Email">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-envelope"></span>
					</div>
				</div>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
			<div class="input-group mb-3">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
				@if ($errors->has('password'))
				<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>
			<div class="row">
				<div class="col-8">
					<div class="icheck-primary">
						
						<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>

						<label for="remember">
							Remember Me
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-4">
					<button type="submit" class="btn btn-primary btn-block">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
		</form>

		<div class="social-auth-links text-center mb-3">
			<p>- OR -</p>
			<a href="#" class="btn btn-block btn-primary">
				<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
			</a>
			<a href="#" class="btn btn-block btn-danger">
				<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
			</a>
		</div>
		<!-- /.social-auth-links -->

		<p class="mb-1">
			<a href="{{ route('password.request') }}">I forgot my password</a>
		</p>
		<p class="mb-0">
			<a href="javascript:void(0)" class="text-center disabled">Register a new membership</a>
		</p>
    </div>
</div>


@endsection
