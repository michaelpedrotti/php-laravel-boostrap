@section('content')
<div class="card">
	<div class="card-header">
	  <h3 class="card-title"></h3>	  
	  @if(!isset($disableToolbar) || empty($disableToolbar))
		<div class="card-tools">
			@php if(!isset($policy)): $policy = ''; endif; @endphp

			@if(isset($allowAll) || app_can($policy.'-show'))
				<a href="javascript:void(0)" data-action="show" class="btn btn-default">
					<i class="fa fa-search"></i> @lang('Show')
				</a>
			@endif
			@if(isset($allowAll) || app_can($policy.'-create'))
				<a href="javascript:void(0)" data-action="create" class="btn btn-success">
					<i class="fa fa-plus"></i> @lang('Add')
				</a>
			@endif
			@if(isset($allowAll) || app_can($policy.'-edit'))
				<a href="javascript:void(0)" data-action="edit" class="btn btn-primary">
					<i class="fa fa-edit"></i> @lang('Edit')
				</a>
			@endif
			@if(isset($allowAll) || app_can($policy.'-remove'))
				<a href="javascript:void(0)" data-action="remove" class="btn btn-danger">
					<i class="fa fa-minus"></i> @lang('Remove')
				</a>
			@endif
			@yield('toolbar')
		</div>
		@endif
	</div>
	<div class="card-body">
		<div class="dataTables_wrapper dt-bootstrap4">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-striped table-bordered table-hover dataTable" role="datatable" width="100%">
						<thead>
							<tr role="row">
								@foreach($columns as $key => $label)
								<th>{{ $label }}</th>
								@endforeach
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@include('layout.partials.modal')
@stop
@section('javascript')
<script type="text/javascript" src="/js/datatables.js"></script>
<script type="text/javascript">
$(function() {
	$('table.dataTable').DataTable({
		ajax: {
			url: '{{ $url }}',
			data: function(data) {
				data.token = APP.token;
			}
		},
		columns: [
			@foreach($columns as $key => $label) {
				data: '{{ $key }}',
				name: '{{ $key }}',
				className: 'text-left',
			},
			@endforeach
		]
	});
});
</script>
@append
