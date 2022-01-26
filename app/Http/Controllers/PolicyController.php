<?php
namespace App\Http\Controllers;

use App\Models\Policy; 

class PolicyController extends Controller {

	protected $resource = 'policy';
		
	public function __construct(Policy $model) {
		
		$this->model = $model;
	}
}
