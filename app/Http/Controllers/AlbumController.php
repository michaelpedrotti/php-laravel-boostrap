<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\AlbumRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables as Datatables;

class AlbumController extends CrudController {

	protected $resource = 'album';
		
	public function __construct(Album $model) {
		
		$this->model = $model;
	}
	
	protected function getFormRequest(){
		
		return AlbumRequest::class;
	}
	
	protected function getDataTable(Request $request) {
		
		$model = $this->getModel();
		$query = $model->fetch($request->all());
			
		return Datatables::eloquent($query)
			->editColumn('cover', function ($query) {
				return 'data:image/gif;base64,'.base64_encode($query->cover);
			})
			->addColumn('artist', function ($query) use($model) {
			
				return $model->findArtist($query->artist_id);
			});
	}
	
	protected function getEmptyForm(){
		
		$view = parent::getEmptyForm();
		
		$view->with('artists', $this->getModel()->fetchArtists());
		
		return $view;
	}
	
	protected function getForm($data = array()){
		
		$view = parent::getForm($data);
		
		$view->with('artists', $this->getModel()->fetchArtists());
		
		return $view;
	}
}
