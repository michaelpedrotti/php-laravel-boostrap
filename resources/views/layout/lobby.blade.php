<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ config('app.name', 'Portal HSC Brasil') }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


<link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">

</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<div class="hsc-logo">
				<a href="../../index2.html"><b>Admin</b>LTE</a>
			</div>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			@include('layout.flash')
			@yield('content')
		</div>
		<!-- /.login-box-body -->
	</div>

<script src="/assets/plugins/jquery/jquery.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/dist/js/adminlte.min.js"></script>
</body>
</html>