<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolicyTable extends Migration {

	public function up() {

		Schema::create('policy', function (Blueprint $table) {

			$table->increments("id");
			$table->string("method", 50);
			$table->string("resource", 50);
		});
		
		app(\Database\Seeders\PolicySeeder::class)->run();
	}

	public function down() {
		Schema::drop('policy');
	}

}
