<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder {

	public function run() {

		$datetime = date('Y-m-d H:i:s');

		\DB::table('role')->insert([
			[
				'id' => '1',
				'name' => 'Administrador',
				'uid' => 'ADMIN',
				'created_at' => $datetime,
				'updated_at' => $datetime
			],
			[
				'id' => '2',
				'name' => 'User',
				'uid' => 'USER',
				'created_at' => $datetime,
				'updated_at' => $datetime
			],
		]);
	}
}