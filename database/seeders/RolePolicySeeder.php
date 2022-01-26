<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolePolicySeeder extends Seeder {

	public function run() {
		
		$roles = range(1, 2);
		$policies = range(1, 12);
		$rows = array();
		$id = 1;
		
		foreach($roles as $role){
			
			foreach($policies as $policy){

				$rows[] = [
					
					'id' => $id,
					'role_id' => $role,
					'policy_id' => $policy,
				];
				
				$id++;
			}
		}

		\DB::table('role_policy')->insert($rows);
	}
}
