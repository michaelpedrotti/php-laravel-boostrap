<?php
namespace App\Http\Controllers;

use App\Models\Policy; 

class AlbumController extends CrudController {

	protected $resource = 'album';
		
	public function __construct(Policy $model) {
		
		$this->model = $model;
	}
}
