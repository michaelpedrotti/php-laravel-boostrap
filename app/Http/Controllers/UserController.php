<?php
namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables as Datatables;
use App\Http\Controllers\Controller;
use App\Models\Users as Model; 
use App\Http\Requests\UserRequest;


class UserController extends CrudController {
        
	
	protected $resource = 'user';
	
	protected function getFormRequest(){
		
		return UserRequest::class;
	}
	
	protected function getDataTable(\Illuminate\Http\Request $request) {
		
		$query = $this->getModel()->fetch($request->all(), ['id', 'email', 'name', 'created_at']);
		
		return Datatables::eloquent($query)
			->editColumn('created_at', function ($query) {
					
				return app_date($query->created_at, 'y-m-d H:i');
			});
	}
		
	public function __construct(Model $model) {
		
		$this->model = $model;
	}
}
