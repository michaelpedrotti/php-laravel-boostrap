@extends('layout.app')
@section('title')
<i class="fa fa-users"></i> Home
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
	<li class="breadcrumb-item active">Home</li>
</ol>
@endsection
@section('content')
<div class="card">
	<div class="card-header border-0">
		<h3 class="card-title">Online Store Overview</h3>
		<div class="card-tools">
			<a href="#" class="btn btn-sm btn-tool">
				<i class="fas fa-download"></i>
			</a>
			<a href="#" class="btn btn-sm btn-tool">
				<i class="fas fa-bars"></i>
			</a>
		</div>
	</div>
	<div class="card-body">
		<div class="d-flex justify-content-between align-items-center border-bottom mb-3">
			<p class="text-success text-xl">
				<i class="ion ion-ios-refresh-empty"></i>
			</p>
			<p class="d-flex flex-column text-right">
				<span class="font-weight-bold">
					<i class="ion ion-android-arrow-up text-success"></i> 12%
				</span>
				<span class="text-muted">CONVERSION RATE</span>
			</p>
		</div>
		<!-- /.d-flex -->
		<div class="d-flex justify-content-between align-items-center border-bottom mb-3">
			<p class="text-warning text-xl">
				<i class="ion ion-ios-cart-outline"></i>
			</p>
			<p class="d-flex flex-column text-right">
				<span class="font-weight-bold">
					<i class="ion ion-android-arrow-up text-warning"></i> 0.8%
				</span>
				<span class="text-muted">SALES RATE</span>
			</p>
		</div>
		<!-- /.d-flex -->
		<div class="d-flex justify-content-between align-items-center mb-0">
			<p class="text-danger text-xl">
				<i class="ion ion-ios-people-outline"></i>
			</p>
			<p class="d-flex flex-column text-right">
				<span class="font-weight-bold">
					<i class="ion ion-android-arrow-down text-danger"></i> 1%
				</span>
				<span class="text-muted">REGISTRATION RATE</span>
			</p>
		</div>
		<!-- /.d-flex -->
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">	

$(function(){
	
	$("a[data-bind=copy], button[data-bind=copy]").click(function(){
		
		var selector = $(this);								
		var input = $('#text-to-clipboard');
		var val = selector.find('small').html().slice(1, -1).trim();
        
		input.val(val);
		input.select();
		document.execCommand("copy");
		input.val('');
		input.blur();
		
		APP.flash('@lang("%s foi movida para o clipboard")'.replace('%s', val), 'success');
	});

});

</script>
@endsection