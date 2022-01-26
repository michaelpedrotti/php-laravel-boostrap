<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller {
	
	/**
	 * Show the application dashboard.
	 *
	 * @return Illuminate\Contracts\View\View
	 */
	public function index(Request $request, Response $response) {
		
		return view('home.index', [

            'boxes' => [],
            'socials' => []
        ]);
	}
}
