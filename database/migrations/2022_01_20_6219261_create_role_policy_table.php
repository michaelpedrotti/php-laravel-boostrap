<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePolicyTable extends Migration {

	public function up() {
		
		Schema::create('role_policy', function (Blueprint $table) {
			
			$table->increments("id");
			$table->integer("role_id")->unsigned();
			$table->integer("policy_id")->unsigned();


			$table->foreign('role_id', 'fk_role_policy_acls')
				->references('id')
				->on('role')
					->onDelete('cascade');
			
			$table->foreign('policy_id', 'fk_role_policy_policy')
				->references('id')
				->on('policy')
					->onDelete('cascade');
		});
		
		app(\Database\Seeders\RolePolicySeeder::class)->run();
	}

	public function down() {
		Schema::drop('role_policy');
	}

}
