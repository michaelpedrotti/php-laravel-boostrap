<?php
namespace App\Http\Controllers;

use App\Models\Album; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class AlbumController extends CrudController {

	protected $resource = 'album';
		
	public function __construct(Album $model) {
		
		$this->model = $model;
	}
	
	public function create(Request $request, Response $response){
	
		$artists = [];
		
		$client = Http::withHeaders(["Basic" => env('ALBUM_ARTIST_BASIC')])->get(env('ALBUM_ARTIST_URL'));
		if($client->ok()){
			
			foreach($client->json([]) as $list){
				
				
				$array = array_pop($list);
				

				$artists[Arr::get($array, 'id', 0)] = Arr::get($array, 'name', 'Unknow');
			}
		}
       
		
		
		return view($this->resource . '.form', [
			'artists' => $artists,
			'model' => $this->getModel()
		]);
    }
}
