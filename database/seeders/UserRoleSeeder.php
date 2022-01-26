<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder {

	public function run() {

		\DB::table('user_role')->insert([
			[
				'id' => '1',
				'user_id' => '1',
				'role_id' => '1',
			],
		]);
	}
}