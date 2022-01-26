<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest {
	
    public function authorize() {
        return true;
    }

    public function rules() {
		return [
            'name' => ['required']//Rule::unique('users')->ignore($this->user->id)
        ];
    }
	
	public function messages() {
		return [
			'name.required' => 'Name is required'
		];
	}
}
