@section('css')
<link rel="stylesheet" href="/assets/plugins/ekko-lightbox/ekko-lightbox.css">
@stop
@section('content')
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Ekko Lightbox</h4>
			@if(!isset($disableToolbar) || empty($disableToolbar))
			<div class="card-tools">
				@can('create', $model)
					<a href="javascript:void(0)" data-action="create" class="btn btn-success">
						<i class="fa fa-plus"></i> @lang('Add')
					</a>
				@endcan
				@yield('toolbar')
			</div>
			@endif
		</div>

		<div class="card-body">
			<div class="row" data-type="gallery">
					<div class="col-sm-2">
						<div class="text-right">
							@can('update', $model)
							<a href="javascript:void(0)" data-action="gallery-edit" data-id="">
								<i class="fa fa-edit"></i>
							</a>
							@endcan
							@can('delete', $model)
								<a href="javascript:void(0)" data-action="gallery-remove" data-id="">
									<i class="fa fa-trash"></i>
								</a>
							@endcan
						</div>
						<a href="javacript:void(0)" data-toggle="lightbox" data-title="sample - black" data-gallery="gallery">
							<img src="" class="img-fluid mb-2" alt="black sample">
						</a>
					</div>
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
	
	function fetchGallery(){

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
	
				$.each(json.data, function(index, row){
					
					var card = base.clone();
					var title = row.artist.name + ' - ' + row.name + ' <span title="'+ row.artist.twitter +'" class="badge badge-primary">'+ row.artist.twitter +'</span> <span class="badge badge-info right">' + row.year + '</span>';
					
					card.find('img').get(0).src = row.cover;
					card.find('a[data-action=gallery-edit]').attr('data-id', row.id);
					card.find('a[data-action=gallery-remove]').attr('data-id', row.id);
					card.find('a[data-gallery=gallery]').attr('data-title', title).attr('href', row.cover);
					selector.append(card);
				});
			}  
		});
	}
	
	$(function () {
	  
		$(document).on('click', '[data-toggle="lightbox"]', onClickLightBox);
		$(document).on('click', '[data-action=gallery-edit]', APP.edit);
		$(document).on('click', '[data-action=gallery-remove]', APP.remove);
		
		$('.btn[data-filter]').on('click', onClickFilter);
		
		APP.afterSubmit.push(function(){
			
			fetchGallery();
			
		});
		
		APP.afterRemove.push(function(){
			
			fetchGallery();
		});
		//$('.filter-container').filterizr({gutterPixels: 3});
		
		fetchGallery();
  })
</script>
@append
