<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Model as Model;
use Yajra\DataTables\Facades\DataTables as Datatables;

/**
 * Description of CrudController
 *
 * @author michael
 */
class CrudController extends Controller {

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
	
	protected function getForm($data = array()){
		
		$model = $this->getModel();
		
		$model->getConnection()->beginTransaction();

		$view = view($this->resource . '.form');
		
		try {
			
			$model->fill($data);
			
			app($this->getFormRequest());
			
			
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
			
			Log::info($e->getMessage());
			Log::info($e->getTraceAsString());
		}
		
		$view->with('model', $model);
		
		return $view;
	}
	
	protected function getEmptyForm(){
		
		return view($this->resource . '.form', [
			'model' => $this->getModel()
		]);
	}

	/**
     * 
     *
     * @return \Illuminate\Http\Response|Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Response $response){
        
		$this->authorize('view', $this->model);
		
		if ($request->isXmlHttpRequest()) {
			
            return $this->getDataTable($request)->make(true);
        }
		
		return view($this->resource . '.index', [
			
			'model' => $this->model
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Response $response){
		
		$this->authorize('create', $this->model);
       
		return $this->getEmptyForm();
    }
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Response $response) {
		
		$this->authorize('update', $this->model);
		
        return $this->getEmptyForm();
    }	

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response) {
		
		$this->authorize('create', $this->model);
		
		return $this->getForm($request->post());
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response) {
		
		$this->authorize('update', $this->model);
		
		return $this->getForm($request->post());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Response $response) {
        
		$this->authorize('show', $this->model);
		
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
			$json['msg'] = 'Removed';
		}
		catch (\Exception $e) {
			
			$model->getConnection()->rollBack();
			$json['msg'] = $e->getMessage();
		}
		
		return response()->json($json);
    }	
}
