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
		<input type="number" name="year" value="{{ $model->year }}" class="form-control"  placeholder="Enter name">
		@error('year')
			<div class="form-text text-red">{{ $message }}</div>
		@enderror
	</div>
	
	
	<div class="col-sm-12">
		<div class="form-body">
			<label class="control-label">Cover <span class="request">*</span></label>
			<input type="file" name="cover" class="form-control"  placeholder="Attach clover">
			@error('cover')
				<div class="form-text text-red">{{ $message }}</div>
			@enderror
		</div>
	</div>
	
</form>
