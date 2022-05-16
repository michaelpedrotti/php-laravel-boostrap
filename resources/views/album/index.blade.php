@extends('layout.app')
@section('title')
<i class="fa fa-users"></i> Album
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
	<li class="breadcrumb-item">Moat.ai</li>
	<li class="breadcrumb-item active">Album</li>
</ol>
@endsection

@include('layout.partials.gallery', [
	'url' => url("album"),
	'model' => $model
])