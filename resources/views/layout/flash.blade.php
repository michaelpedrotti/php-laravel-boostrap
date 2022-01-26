<div class="row">
	<div class="col-md-12" id="flash-messager">
		@foreach(flash()->messages as $message)
			<div class="row">
				<div class="col-sm-12">
					<div class="alert alert-{{$message->level}}">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class=""></i> {{$message->message}}
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
@php flash()->clear() @endphp