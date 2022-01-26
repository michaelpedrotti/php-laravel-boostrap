<?php

namespace App\Observers;

use App\Models\Role;

class RoleObserver {


	public function saving(Role $model){

		$model->uid = strtoupper(preg_replace('/\s+/', '_', $model->name));
	}	
}
