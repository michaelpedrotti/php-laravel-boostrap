<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables as Datatables;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\Models\Model as Model;

/**
 * @link https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller
 */
class Controller extends BaseController {
    
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	protected $resource = 'home';
	
	/**
	 * @var \App\Models\Model
	 */
	protected $model;

	/**
	 * @var \Illuminate\Foundation\Http\FormRequest
	 */	
	protected $form;
	
	
	public function __construct(Model $model) {
		
		$this->model = $model;
		//$this->form = $form;
	}
	
	/**
	 * @return \App\Models\Model
	 */
	protected function getModel(){
		
		$id = request()->route($this->resource);
		
		return empty($id) ? $this->model : $this->model->newQuery()->findOrFail($id);
	}
	
	/**
	 * @return \Illuminate\Foundation\Http\FormRequest
	 */	
	protected function getFormRequest(){
		
		return FormRequest::class;
	}
	
	/**
	 * @return \Yajra\DataTables\EloquentDataTable
	 */
	protected function getDataTable(Request $request){
		
		$query = $this->getModel()->fetch($request->all());

		return Datatables::eloquent($query);
	}


	/**
     * 
     *
     * @return \Illuminate\Http\Response|Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Response $response){
        
		if ($request->isXmlHttpRequest()) {
			
            return $this->getDataTable($request)->make(true);
        }
		
		return view($this->resource . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Response $response){
       
		return view($this->resource . '.form', [
			'model' => $this->getModel()
		]);
    }
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Response $response) {
		
        return view($this->resource . '.form', [
			'model' => $this->getModel()
		]);
    }	

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response) {
		
		$model = $this->getModel();
		
		$model->getConnection()->beginTransaction();

		$view = view($this->resource . '.form', [
			'model' => $model
		]);
		
		try {

			app($this->getFormRequest());
			
			$model->fill($request->post());
			$model->save();
			$model->getConnection()->commit();

			flash('Saved', 'success');
		}
		catch(ValidationException $e){

			$view->withErrors($e->validator);
			
			flash('Check form fields', 'warning');
		}
		catch(\Exception $e) {

			$model->getConnection()->rollBack();
			flash($e->getMessage(), 'danger');   
			
			\Illuminate\Support\Facades\Log::info($e->getMessage());
			\Illuminate\Support\Facades\Log::info($e->getTraceAsString());
		}            
		
		return $view;
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response) {
		
		return $this->store($request, $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Response $response) {
        
		return view($this->resource . '.show', [
			'model' => $this->getModel()
		]);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, \Illuminate\Http\JsonResponse $response) {
        
		$json = ['success' => false, 'msg' => ''];
		
		$model = $this->getModel();		
		$model->getConnection()->beginTransaction();
		
		try {
			
			$model->delete();
			$model->getConnection()->commit();
			
			$json['success'] = true;
			$json['data'] = $model->toArray();
			$json['msg'] = 'Removed';
		}
		catch (\Exception $e) {
			
			$model->getConnection()->rollBack();
			$json['msg'] = $e->getMessage();
		}
		
		return $response->setData($json);
    }
}
