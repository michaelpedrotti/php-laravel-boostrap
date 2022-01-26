<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class ModelPolicy {
	
    use HandlesAuthorization;

	public function __call($name, $arguments) {
		
		
		//dd($name, $arguments);
		
		return app_can($name);
	}
}
