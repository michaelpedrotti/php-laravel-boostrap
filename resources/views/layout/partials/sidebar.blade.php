<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		
		
		@foreach(app_menu() as $title => $node)
			
			<li class="nav-header">Administration</li>
		
			@include('layout.partials.navitem', ['node' => $node])
			
			
		@endforeach
		
		<li class="nav-header">Administration</li>

		<li class="nav-item">
			<a href="#" class="nav-link">
				<i class="nav-icon fas fa-copy"></i>
				<p>
					Team
					<i class="fas fa-angle-left right"></i>
					<span class="badge badge-info right">6</span>
				</p>
			</a>
			<ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="{{ url('user') }}" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>User</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('role') }}" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Role</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('policy') }}" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Policy</p>
					</a>
				</li>
			</ul>
		</li>
	</ul>
</nav>

<input type="text" id="text-to-clipboard" style="border:none; background:none; font-size:9px" value="" />