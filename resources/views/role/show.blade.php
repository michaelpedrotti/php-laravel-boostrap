<form>
	<title class="hidden">Show</title>
	<input type="hidden" name="id" value="{{ $model->id }}" />
	
	<div class="form-group">
		<label>Name</label>
		<div class="form-control">{{ $model->name }}</div>
	</div>
</form>
