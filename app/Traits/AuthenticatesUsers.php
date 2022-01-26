<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait AuthenticatesUsers {

    use \Illuminate\Foundation\Auth\AuthenticatesUsers;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request) {

        $arr = $request->only($this->username(), 'password');
        $arr['deleted_at'] = null;

        return $arr;
    }
}
