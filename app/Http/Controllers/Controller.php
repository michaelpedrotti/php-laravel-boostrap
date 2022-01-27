<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @link https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller
 */
class Controller extends BaseController {
    
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
