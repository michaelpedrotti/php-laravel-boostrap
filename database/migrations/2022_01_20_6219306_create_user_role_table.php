<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleTable extends Migration {

	public function up() {
		Schema::create('user_role', function (Blueprint $table) {
			
			$table->increments("id");
			$table->integer("user_id")->unsigned();
			$table->integer("role_id")->unsigned();

			$table->foreign('role_id', 'fk_user_role_role')
				->references('id')
					->on('role')
						->onDelete('cascade');
			
			$table->foreign('user_id', 'fk_user_role_user')
				->references('id')
					->on('users')
						->onDelete('cascade');
		});
		
		app(\Database\Seeders\UserRoleSeeder::class)->run();
	}

	public function down() {
		Schema::drop('user_role');
	}

}
