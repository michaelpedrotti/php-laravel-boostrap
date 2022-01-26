<ul class="navbar-nav ml-auto">

	<li class="nav-item d-none d-sm-inline-block">
		
	</li>
	<li class="nav-item dropdown">
		<a class="nav-link" data-toggle="dropdown" href="#">
			<i class="far fa-bell"> {{ \Auth::user()->name }}</i>
		</a>
		<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


			<a href="{{ route('logout') }}" class="dropdown-item">
				<i class="fas fa-sign-out mr-2"></i> Logout
				<span class="float-right text-muted text-sm"></span>
			</a>
			
			
			
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
				<i class="fas fa-users mr-2"></i> 8 friend requests
				<span class="float-right text-muted text-sm">12 hours</span>
			</a>
			<div class="dropdown-divider"></div>
			<a href="#" class="dropdown-item">
				<i class="fas fa-file mr-2"></i> 3 new reports
				<span class="float-right text-muted text-sm">2 days</span>
			</a>

		</div>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-widget="fullscreen" href="#" role="button">
			<i class="fas fa-expand-arrows-alt"></i>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
			<i class="fas fa-th-large"></i>
		</a>
	</li>
</ul>