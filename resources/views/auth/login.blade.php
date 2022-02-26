@extends('layout.lobby')
@section('content')

<div class="card">
    <div class="card-body login-card-body">
		<p class="login-box-msg">Sign in to start your session</p>
		
		@include('layout.flash')
		
		<form action="{{ route('login') }}" method="post">
			
			{{ csrf_field() }} 
			
			<div class="input-group mb-3">
				<input type="email" name="email" class="form-control" placeholder="Email">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-envelope"></span>
					</div>
				</div>
				
			</div>
			@if ($errors->has('email'))
				<div class="text-red">{{ $errors->first('email') }}</div>
			@endif
				
			<div class="input-group mb-3">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<div class="input-group-append">
					<div class="input-group-text">
						<span class="fas fa-lock"></span>
					</div>
				</div>
			</div>
			@if ($errors->has('password'))
				<div class="text-red">{{ $errors->first('password') }}</div>
			@endif
			
			<div class="row">
				<div class="col-8">
					<div class="icheck-primary">
						
						<input type="checkbox" id="remember" disabled="disabled" name="remember" {{ old('remember') ? 'checked' : '' }}>

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
			<a href="javascript:void(0)" class="btn btn-block btn-primary disabled">
				<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
			</a>
			<a href="javascript:void(0)" class="btn btn-block btn-danger disabled">
				<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
			</a>
		</div>
		<!-- /.socialhttp://localhost/login#-auth-links -->

		<p class="mb-1">
			<a href="{{ route('password.request') }}">I forgot my password</a>
		</p>
		<p class="mb-0">
			<a href="/register" class="text-center disabled">Register a new membership</a>
		</p>
    </div>
</div>


@endsection
