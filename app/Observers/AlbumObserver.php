<?php

namespace App\Observers;

use App\Models\Album;
use Illuminate\Support\Facades\Auth;

class AlbumObserver {

	public function saving(Album $model){

		$model->user_id = Auth::id();
		
		if(array_key_exists('cover', $_FILES) && $_FILES['cover']['size'] > 0){

			$model->cover = file_get_contents($_FILES['cover']['tmp_name']);
		}
	}	
}