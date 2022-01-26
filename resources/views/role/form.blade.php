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
		<input type="text" name="name" value="{{ $model->name }}" class="form-control" placeholder="Enter name">
		@error('name')
			<div class="form-text text-red">{{ $message }}</div>
		@enderror
	</div>
</form>
