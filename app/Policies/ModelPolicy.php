<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Log;
use App\Models\Policy;

class ModelPolicy {
	
    use HandlesAuthorization;
	
	public function __call($method, $args) {
	
		$exists = false;
		$model = array_pop($args);
		$resource = class_basename($model);
		$policy = strtolower($resource).'-'.$method;
		
		$session = Session::getFacadeRoot();
			
		if(in_array($policy,  $session->get('policy', []))){
			
			$exists = true;
		}
		else {
			
			$query = Policy::selectRaw('1');
			$query->join('role_policy', 'role_policy.policy_id', 'policy.id');
			$query->join('role', 'role.id', 'role_policy.role_id');		
			$query->join('user_role', 'user_role.role_id', 'role.id');
			$query->where('policy.method', $method);
			$query->where('policy.resource', $resource);
			$query->where('user_role.user_id', \Auth::user()->id);

			if($query->exists()){

				$session->push('policy', $policy);
				
				$exists = true;
			}
			
//			Log::info($query->getBindings());
//			Log::info($query->toSql());
		}
	
		return $exists;
		
	}
}
