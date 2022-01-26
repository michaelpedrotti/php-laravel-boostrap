<?php
namespace App\Models;

class Policy extends Model  {
    
    
    protected $primaryKey = 'id';
    
    public $table = 'permissions';
    public $timestamps = false;
    
    /**
     * Variaveis seguras para uso e guardar dados 
     * @var array 
     */
    public $fillable = [
        'id',
        'method',
    ];
    
    /**
     * Tipos nativos dos atributos
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'method' => 'string'
    ];    
    	

    public function role() {
		
        return $this->belongsToMany('App\Models\Role', 'role_policy', 'policy_id', 'role_id');
    }

    /**
     * Verifica se o usuário tem permissão pra acessar o registro
     *
     * @return null
     */
    public function authorize(){
    
        if(!empty($this->id)) {

            $builder = self::select(); 
            $builder->where('id', $this->id);
            //$builder->where('user_id', \Auth::user()->id);

            // Grava em laravel.log
            //
            //\Log::info($builder->getBindings());
            //\Log::info($builder->toSql());

            if($builder->count() <= 0){
                die(view('default/403')->render());
            }
        } 
    }
    
    
    /**
     * Realiza a consulta da tabela
     *
     * @param array $filter
     * @return \Illuminate\Support\Collection
     */
    public function fetch(array $filter = [], $expression = '*') {
        
        if(empty($filter)) $filter = $this->toArray();
    
        $builder = self::selectRaw($expression);

           
        if(array_key_exists('id', $filter) && !empty($filter['id'])) {
            $builder->where('id', $filter['id']);
        }
           
        if(array_key_exists('permission', $filter) && !empty($filter['permission'])) {
            $builder->where('permission', $filter['permission']);
        }
           
        if(array_key_exists('desc', $filter) && !empty($filter['desc'])) {
            $builder->where('desc', 'LIKE', '%'.$filter['desc'].'%');
        }
        
        
        if(array_key_exists('orderBy', $filter) && !empty($filter['orderBy'])) {
            $builder->orderBy($filter['orderBy'], 'ASC');
        }
        
        // Grava em laravel.log
        //
        //\Log::info($builder->getBindings());
        //\Log::info($builder->toSql());

        return $builder;
    }
	
	/**
	 * Adicionas as permissiões
	 * 
	 * @return null
	 */
	public static function setSession(){
	
		$model = \App\Models\Users::find(\Auth::user()->id);
		$collection = $model->Roles;

		$role = '';
		$policies = [];
		
		if($collection && $collection->count() > 0){

			$collection = $collection->first()->Roles;
			if($collection && $collection->count() > 0){
				
				$model = $collection->first();
				
				$role = $model->uid;
				
				$policies = static::select()
					->from('role_policy AS a')
					->join('policy AS b', 'b.id', 'a.policy_id')
					->where('a.role_id', $model->id)
						->get()
						->map(function($row){
							
							$row['uid'] = strtolower($row['resource'] . '-' . $row['method']);
							
							return $row;
						})
						->pluck('uid')
							->toArray();
						
				sort($policies);
			}
		}
		
		$session = app('session.store');
		$session->put('role', $role);
		$session->put('policy', $policies);
	}
}