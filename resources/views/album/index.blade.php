@extends('layout.app')
@section('title')
<i class="fa fa-users"></i> User
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
	<li class="breadcrumb-item">Team</li>
	<li class="breadcrumb-item active">User</li>
</ol>
@endsection

@include('layout.partials.datatable', [
	'url' => url("album"),
	'allowAll' => true,
	'columns' => [
		'id' => 'ID',
		'name' => 'Nome',
		'artist' => 'Artista',
		'year' => 'Lançamento'
	]
])