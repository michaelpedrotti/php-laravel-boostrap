<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolePolicySeeder extends Seeder {

	public function run() {
		
		$id = 1;
		
		foreach(range(1, 12) as $policy){

			$rows[] = [

				'id' => $id,
				'role_id' => 1,// ADMIN
				'policy_id' => $policy,
			];

			$id++;
		}
		
		foreach(range(1, 11) as $policy){

			$rows[] = [

				'id' => $id,
				'role_id' => 2,// USER
				'policy_id' => $policy,
			];

			$id++;
		}

		\DB::table('role_policy')->insert($rows);
	}
}
