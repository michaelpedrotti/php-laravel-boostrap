<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller {
	
	protected $resource = 'role';
	
	protected function getFormRequest(){
		
		return RoleRequest::class;
	}
	
	/**
	 * @return \Yajra\DataTables\EloquentDataTable
	 */
	protected function getDataTable(\Illuminate\Http\Request $request){
		
		$query = $this->getModel()->fetch($request->all());

		return \Yajra\DataTables\Facades\DataTables::eloquent($query)
			->editColumn('created_at', function ($query) {
					
				return app_date($query->created_at, 'y-m-d H:i');
			});
	}
	
	public function __construct(Role $model) {
		
		$this->model = $model;
	}
}
