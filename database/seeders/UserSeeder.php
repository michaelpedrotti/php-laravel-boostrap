<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

	public function run() {
		
		$datetime = date('Y-m-d H:i:s');

		\DB::table('users')->insert([
			[
				'id' => '1',
				'name' => 'Administrador',
				'email' => 'admin@xyz.io',
				'password' => bcrypt('admin'),
				//'remember_token' => str_random(10),
				//'first_login' => 'N', 
				'created_at' => $datetime,
				'updated_at' => $datetime,
			],
            [
				'id' => '2',
				'name' => 'User 1',
				'email' => 'user1@xyz.io',
				'password' => bcrypt('user1'),
				'created_at' => $datetime,
				'updated_at' => $datetime,
			]
		]);
	}
}
