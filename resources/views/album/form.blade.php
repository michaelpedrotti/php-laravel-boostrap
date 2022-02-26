<form>
	@include('layout.flash')
	
	@if (!empty($model->id))
		<title>Edit</title>
		<input type="hidden" name="id" value="{{ $model->id }}" />
	@else
		<title>Add</title>
		
	@endif

	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" value="{{ $model->name }}" class="form-control"  placeholder="Album name">
		@error('name')
			<div class="form-text text-red">{{ $message }}</div>
		@enderror
	</div>
	
	<div class="form-group">
		<label>Artista</label>
		<select name="artist_id" class="form-control">
			<option value="">Selecione</option>
			@foreach($artists ?? [] as $value => $display)
				@if($value == $model->artist_id)
					<option value="{{ $value }}" selected="selected">{{ $display }}</option>
				@else
					<option value="{{ $value }}">{{ $display }}</option>
				@endif
			@endforeach
		</select>
		@error('artist_id')
			<div class="form-text text-red">{{ $message }}</div>
		@enderror
	</div>
	
	<div class="form-group">
		<label>Year</label>
		<input type="text" name="year" value="{{ $model->year }}" class="form-control"  placeholder="Enter name">
		@error('year')
			<div class="form-text text-red">{{ $message }}</div>
		@enderror
	</div>
	
	
	<div class="col-sm-12">
		<div class="form-body">
			<label class="control-label">Cover <span class="request">*</span></label>
			@if(empty($model->cover))
				<input type="file" name="cover" class="form-control"  placeholder="Attach clover">
			@else
			<div class="input-group">
				<input type="file" name="cover" class="form-control"  placeholder="Attach clover">
				<a href="{{ url('documents/download/'.$model->id ) }}" title="Baixar o documento" class="input-group-addon btn btn-link btn-default">
					<i class="fa fa-download"></i>	
				</a>
			</div>
			@endif
			@error('cover')
				<div class="form-text text-red">{{ $message }}</div>
			@enderror
		</div>
	</div>
	
</form>
