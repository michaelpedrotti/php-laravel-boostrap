<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('layout.partials.header')
</head>
<body class="hold-transition skin-blue fixed">
	<div class="wrapper">
		<div class="content-wrapper" style="margin-left:0; padding-top:0">
			<section class="content">

				@include('layout.flash')
				
				<div class="row">
					<div class="col-md-12">
						@yield('content')
					</div>
				</div>
			</section>
		</div>
	</div>
	@include ('layout.partials.footer')
</body>
</html>