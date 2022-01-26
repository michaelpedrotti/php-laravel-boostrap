@extends('layout.app')
@section('title')
<i class="fas fa-user-tag"></i> Role
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
	<li class="breadcrumb-item">Team</li>
	<li class="breadcrumb-item active">Role</li>
</ol>
@endsection

@include('layout.partials.datatable', [
	'url' => url("role"),
	'allowAll' => true,
	'columns' => [
		'id' => 'ID',
		'name' => 'Name',
		'uid' => 'UID',
		'created_at' => 'Created'
	]
])