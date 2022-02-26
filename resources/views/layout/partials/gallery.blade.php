@section('css')
<link rel="stylesheet" href="/assets/plugins/ekko-lightbox/ekko-lightbox.css">
@stop
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Ekko Lightbox</h4>
			@if(!isset($disableToolbar) || empty($disableToolbar))
			<div class="card-tools">
				@php if(!isset($policy)): $policy = ''; endif; @endphp

				@if(isset($allowAll) || app_can($policy.'-create'))
					<a href="javascript:void(0)" data-action="create" class="btn btn-success">
						<i class="fa fa-plus"></i> @lang('Add')
					</a>
				@endif
				@yield('toolbar')
			</div>
			@endif
		</div>
		<div class="card-body">
			<div class="row" data-type="gallery">
				@foreach(range(2, 4) as $index)
					<div class="col-sm-2">
						<div class="text-right">
							<a href="javascript:void(0)" data-action="gallery-edit" data-id="">
								<i class="fa fa-edit"></i>
							</a>
							<a href="javascript:void(0)" data-action="gallery-remove">
								<i class="fa fa-trash"></i>
							</a>
						</div>
						<a href="https://via.placeholder.com/1200/000000.png?text={{ $index }}" data-toggle="lightbox" data-title="sample {{ $index }} - black" data-gallery="gallery">
							<img src="https://via.placeholder.com/300/000000?text={{ $index }}" class="img-fluid mb-2" alt="black sample">
						</a>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	@include('layout.partials.modal')
@stop
@section('javascript')
<script type="text/javascript" src="/assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script type="text/javascript" src="/assets/plugins/filterizr/jquery.filterizr.min.js"></script>
<script type="text/javascript" src="/js/datatables.js"></script>
<script type="text/javascript">

	function onClickLightBox(event) {
		event.preventDefault();
		$(this).ekkoLightbox({
		  alwaysShowClose: true
		});
	}
	
	function onClickFilter(){
		$('.btn[data-filter]').removeClass('active');
		$(this).addClass('active');
	}
	
	function onClickEdit(){
		
		var tag = $(this);
		var modal = $(tag.attr('data-modal') || '#modal-default');
		var id = tag.attr('data-id'); 

		if(!id){

			APP.flash('Select a record', 'warning');
			return;
		}

		modal.attr('url', APP.url + '/' + id + '/edit');
		modal.find('a[data-submit], button[data-submit]').attr('data-submit', 'update').show();
		modal.find('.modal-body').empty().html('Loading...');
		modal.modal({
			show:true, 
			callback:function(){
				
				alert('hello world');
			},
			button:tag
		});

	}
	
	function fetchGallery(){
		console.log('fetchGallery');
		$.ajax({

			method:'GET',
			url:'{{ $url }}',
			dataType:'json',
			error:function(jqXHR, textStatus, errorThrown){

			
			}, 
			success:function(json){
				
				var selector = $('[data-type=gallery]');
				var base = selector.find('div').first().clone();
				
				selector.empty();
				
				console.log('base', base);
				
				$.each(json.data, function(index, row){
					
					var card = base.clone();
					
					card.find('img').get(0).src = row.clover;
					card.find('a[data-action=gallery-edit]').attr('data-id', row.id);
					card.find('a[data-gallery=gallery]').attr('data-title', row.name).attr('href', row.clover);
					selector.append(card);
				});
			}  
		});
	}
	
	$(function () {
	  
		$(document).on('click', '[data-toggle="lightbox"]', onClickLightBox);
		$(document).on('click', '[data-action=gallery-edit]', onClickEdit);
		
		
		$('.btn[data-filter]').on('click', onClickFilter);
		
		APP.afterSubmit.push(function(){
			
			fetchGallery();
			
		});
		
		//$('.filter-container').filterizr({gutterPixels: 3});
		
		fetchGallery();
  })
</script>
@append
