<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder {
    
    public function run() {

		$rows = [];
		$id = 1;
		$methods = ['view', 'create', 'update', 'delete'];
		$resources = [
			
			'User', 'Role', 'Policy', 'Album'
		];
		
		foreach($methods as $method){
			
			foreach($resources as $resource){
			
				$rows[] = [
					'id' => $id, 
					'resource' => $resource,
					'method' => $method
				];

				$id++;
			}
		}
		                   
        \DB::table('policy')->insert($rows);
    }
}
