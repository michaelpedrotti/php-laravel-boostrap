<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		
		
		@foreach(app_menu() as $title => $node)
			
			<li class="nav-header">Administration</li>
		
			@include('layout.partials.navitem', ['node' => $node])
			
			
		@endforeach
		
		<li class="nav-header">Moat.ai</li>

		<li class="nav-item">
			<a href="{{  url('/album') }}" class="nav-link">
				<i class="nav-icon fas fa-copy"></i>
				<p>Album</p>
			</a>
		</li>
	</ul>
</nav>

<input type="text" id="text-to-clipboard" style="border:none; background:none; font-size:9px" value="" />