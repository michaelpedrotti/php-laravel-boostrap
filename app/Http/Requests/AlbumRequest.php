<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest {

    public function authorize() {
        return true;
    }


    public function rules() {
		return [
            'name' => ['required'],
            'year' => ['required'],
			'artist_id' => ['required'],
			'artist_id' => ['required'],
			'cover' => ['required']
        ];
    }
	
	public function messages() {
		return [
			'name.required' => 'Name is required',
			'year.required' => 'Email is required',
			'artist_id.required' => 'Artist is required',
			'cover.required' => 'Cover is required',
		];
	}
}
