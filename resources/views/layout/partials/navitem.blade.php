@if(isset($node['disabled']) && !empty($node['disabled']))
@else
	@php $url = array_get($node, 'url'); @endphp

	<li class="nav-item" data-nav="{{ $url }}">
		<a href="{{ $url ? url($url) : '#' }}" class="nav-link">
			<i class="nav-icon fa {{ array_get($node, 'icon') }}"></i>
			<p>
				{{ array_get($node, 'label') }}
			
				@if(!empty($node['children']))<i class="fas fa-angle-left right"></i>@endif
			</p>
		</a>

		@if(!empty($node['children']))
			<ul class="nav nav-treeview">
				@foreach($node['children'] as $child)
			
						@include('layout.partials.navitem', ['node' => $child])
				
				@endforeach
			</ul>
		@endif

	</li>
@endif