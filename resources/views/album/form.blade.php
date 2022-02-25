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
		<select class="form-control">
			<option value="">Selecione</option>
			@foreach($artists as $value => $display)
				@if($display == $model->artist)
					<option value="{{ $value }}" selected="selected">{{ $display }}</option>
				@else
					<option value="{{ $value }}">{{ $display }}</option>
				@endif
			@endforeach
		</select>
		@error('artist')
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
	
</form>
