<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('layout.partials.header')
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
	<div class="wrapper">
		<div class="preloader flex-column justify-content-center align-items-center">
			<img class="animation__shake" src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
		</div>
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="index3.html" class="nav-link">Home</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Contact</a>
				</li>
			</ul>
			@include('layout.partials.topbar')
		</nav>

		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index3.html" class="brand-link">
				<img src="/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">AdminLTE 3</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- SidebarSearch Form -->
				<div class="form-inline" style="margin-top:0.5rem">
					<div class="input-group" data-widget="sidebar-search">
						<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
						<div class="input-group-append">
							<button class="btn btn-sidebar">
								<i class="fas fa-search fa-fw"></i>
							</button>
						</div>
					</div>
				</div>
				@include('layout.partials.sidebar')
			</div>
		</aside>
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">@yield('title')</h1>
						</div>
						<div class="col-sm-6">
							@yield('breadcrumb')
						</div>
					</div>
				</div>
			</div>

			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<section class="col-lg-12 connectedSortable">
							@yield('content')	
						</section>
					</div>
				</div>
			</section>
		</div>

		<footer class="main-footer">
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 3.2.0-rc
			</div>
		</footer>

		<aside class="control-sidebar control-sidebar-dark">
			@include('layout.partials.asidebar')
		</aside>

	</div>
	
	@include ('layout.partials.footer')
</body>
</html>