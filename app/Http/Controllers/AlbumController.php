<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\AlbumRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables as Datatables;

class AlbumController extends CrudController {

	protected $resource = 'album';
		
	public function __construct(Album $model) {
		
		$this->model = $model;
	}
	
	protected function getArtists(){
		
		$artists = [];
		
		$client = Http::withHeaders(["Basic" => env('ALBUM_ARTIST_BASIC')])->get(env('ALBUM_ARTIST_URL'));
		if($client->ok()){
			
			foreach($client->json([]) as $list){
				
				$array = array_pop($list);
				
				$artists[Arr::get($array, 'id', 0)] = Arr::get($array, 'name', 'Unknow');
			}
		}
		
		return $artists;
	}
	
	
	protected function getFormRequest(){
		
		return AlbumRequest::class;
	}
	
	protected function getDataTable(Request $request) {
		
		$query = $this->getModel()->fetch($request->all());
		
		return Datatables::eloquent($query)
			->editColumn('clover', function ($query) {
				return 'data:image/gif;base64,'.base64_encode($query->cover);
			})
			->addColumn('artist', function ($query) {
			
				
				return 'fulano';
			});
	}
	
	/**
	 * @override
	 */
	public function create(Request $request, Response $response){
	
		return view($this->resource . '.form', [
			'artists' => $this->getArtists(),
			'model' => $this->getModel()
		]);
    }
}
