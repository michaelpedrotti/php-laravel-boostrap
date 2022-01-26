<?php

namespace App\Listeners;

use Laracasts\Utilities\JavaScript\JavaScriptFacade as Javascript;
use Illuminate\Support\Facades\Route;

/**
 * Injeta algumas configurações do PHP no Javascript no objeto APP
 */
class PhpToJs {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Handle the event.
     *
     * @param  SetConfigSistem  $event
     * @return void
     */
    public function handle() {

		$route = Route::getCurrentRoute();
		
		[$controller, $action] = explode('@', $route->getActionName());
		
		$controller = strtolower(str_replace('Controller', '', class_basename($controller)));
		
        Javascript::put([
			'csrf' => csrf_token(),
            'host' => asset(""),
			'controller' => $controller,
			'action' => $action,
			'url' => asset($controller),
            'id' => $route->parameter('id', null),
        ]);
    }
}
