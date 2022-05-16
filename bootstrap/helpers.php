<?php

if(!function_exists('app_menu')) {
    /**
     * Retorna um array, com cache, da configuração config/menu.php
     *
     * @return array
     */
	function app_menu(){

		$session = app('session.store');

		//if(!$session->has('menu')) {

			$session->put('menu', config('menu'));
		//} 
			
		return $session->get('menu');
	}
}

if(!function_exists('app_date')) {
    /**
     * Formata uma data de diferentes locales
     *
     * @return string
     */
	function app_date($value = '', $output = 'd/m/Y 00:00:00'){

		if(!empty($value)) {
		
			$datetime = new \DateTime($value);
			
			if(!empty($datetime)) {
				return $datetime->format($output);
			}
		}
		return '';
	}
}

if(!function_exists('app_bytes_to_size')) {
    /**
     * Formata para padrão humano bytes
     *
     * @return string
     */
	function app_bytes_to_size($bytes){

		$units = array('bytes','Kb','Mb','Gb','Tb','Pb','Eb','Zb','Yb');
		$step = 1024;
		$i = 0;
		while (($bytes / $step) > 0.9) {
			$bytes = $bytes / $step;
			$i++;
		}
		return round($bytes, 2).' '.$units[$i];
	}
}

if(!function_exists('app_can')) {
	
	/**
     * Verifica se o usuário ter permissão para acessar um recurso do sistema
     *
	 * @param string $ability Permissão a ser testada
     * @return bool
     */
	function app_can($ability, $model = 'Users'){
		
		if(\App::runningInConsole()) return true;
		
		//\Log::info($builder->getBindings());
        //\Log::info($builder->toSql());

		return app(\App\Policies\ModelPolicy::class)->$ability('\App\Models\\'.$model);	
	}
}

if(!function_exists('app_fetch')) {
    /**
     * Retorna uma lista para combobox com label e value
     *
	 * @link https://laravel.com/docs/5.5/helpers
     * @return array
     */
	function app_fetch($classname = '', $label = 'name', $value = 'id', $filter = []){

		$model = call_user_func('\App\Models\\'.studly_case($classname).'::getModel');
		
		return $model->search($filter)
				->pluck($label, $value)
					->prepend('Selecione', '')
						->toArray();
	}
}

if(!function_exists('app_abort')) {
    /**
     * Retorna uma mensagem de erro padrão para ajax ou uma view com o layout 
	 * dependendo do tipo de requisição
     *
	 * @param number $code 
	 * @param string $message 
	 * @link https://laravel.com/docs/5.5/helpers
     * @throws Illuminate\Http\Exceptions\HttpResponseException
     */
	function app_abort($code, $message){
		
		if (app('request')->isXmlHttpRequest()) {
				
			$response = \Response::json([
				'success' => false,
				'code' => $code,
				'msg' => $message
			]);
		}
		else {
			$response = \Response::view('layout.errors.401', [
				'code' => $code,
				'message' => $message
			]);
		}

		throw new \Illuminate\Http\Exceptions\HttpResponseException($response);	
	}
}

if(!function_exists('app_has')){
	
	function app_has(&$var, $key) {
	
		if(is_array($var) && array_key_exists($key, $var)) {
			$value = &$var[$key];
		}
		elseif(is_object($var) && property_exists($var, $key)){
			$value = &$var->{$key};
		}
		else {
			$value = null;
		}
		
		return (is_numeric($value) || !empty($value));
	}
}

if(!function_exists('app_model')) {
	
	function app_model($classname, $id = 0){

		return call_user_func('App\Models\\'.studly_case($classname).'::findOrNew', $id);
	}
}

if(!function_exists('app_dispatch')){
	
	function app_dispatch($router, $controller, $action, $id) {
	
		$route = $router->getCurrentRoute();
		$route->name($controller.'.'.$action);
		
		$controller = sprintf('App\Http\Controllers\%sController', \Illuminate\Support\Str::studly($controller));
		
		if(!class_exists($controller)) {
			abort(404, 'Controller not found');
		}
		
		$action = \Illuminate\Support\Str::studly($action);
		
		if(!method_exists($controller, $action)) {
			abort(404, 'Action not found');
		}
		
		$route->uses($controller.'@'.$action);
	
		return $router->dispatch($router->getCurrentRequest());
	}
}

# https://laravel.com/docs/8.x/helpers

if(!function_exists('array_has')){
	
	function array_has($array = array(), $key = ''){
		
		return \Illuminate\Support\Arr::has($array, $key);
	}
}

if(!function_exists('array_get')){
	
	function array_get($array = array(), $key = '', $default = null){
		
		return \Illuminate\Support\Arr::get($array, $key, $default);
	}
}

