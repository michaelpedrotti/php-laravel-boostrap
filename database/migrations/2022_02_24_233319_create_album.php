<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbum extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('album', function (Blueprint $table) {
			$table->increments("id");
			$table->integer("user_id")->unsigned();
			$table->string("name", 255);
			$table->string("artist", 255);
			$table->year("year");
			$table->softDeletes();
			$table->timestamps();
			
			$table->foreign('user_id', 'fk_album_user')
				->references('id')
					->on('users')
						->onDelete('cascade');
		});
		
		//app(\Database\Seeders\AlbumSeeder::class)->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('album');
    }
}
