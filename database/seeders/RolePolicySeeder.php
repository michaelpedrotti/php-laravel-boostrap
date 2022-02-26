<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePolicySeeder extends Seeder {

	public function run() {
		
		$id = 1;
		$collection = DB::table('policy')->pluck('id');

		foreach($collection as $policy){
			
			$rows[] = [

				'id' => $id,
				'role_id' => 1,// ADMIN
				'policy_id' => $policy,
			];
			
			$id++;
		}
		
		$collection->pop();// remove delete from album
		
		foreach($collection as $policy){
			
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
