<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

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
			//'cover' => ['required']
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
	
	protected function getValidatorInstance() {
		
		$messages = $this->messages();
        
        return parent::getValidatorInstance()->after(function($validator) {

            $data = $validator->getData();
			
			if(!Arr::has($data, 'id') && ! Arr::has($_FILES, 'cover')){
				
				$validator->errors()->add('cover', $messages['cover.required']);
			}
        });
    }
}
