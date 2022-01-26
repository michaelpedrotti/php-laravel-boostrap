<?php
namespace App\Models;

class RolePolicy extends Model {
    
    
    protected $primaryKey = 'id';
    
    public $table = 'role_policy';
    public $timestamps = false;
    
    public $fillable = [
        'id',
        'role_id',
        'policy_id',
    ];
    
    protected $casts = [
		
        'id' => 'integer',
        'role_id' => 'integer',
        'policy_id' => 'integer',
    ];    


    public function Roles() {
		
        return $this->belongsTo('App\Models\Role', 'id', 'role_id');
    }

    public function Policies() {
		
        return $this->belongsTo('App\Models\Policy', 'id', 'policy_id');
    }

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
                app_abort(403, trans('Acesso negado para esta permissão'));
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
           
        if(array_key_exists('role_id', $filter) && !empty($filter['role_id'])) {
            $builder->where('role_id', $filter['role_id']);
        }
           
        if(array_key_exists('policy_id', $filter) && !empty($filter['policy_id'])) {
            $builder->where('policy_id', $filter['policy_id']);
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
}