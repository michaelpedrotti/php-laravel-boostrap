<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model  {
    
    use SoftDeletes;
    protected $primaryKey = 'id';
    
    public $table = 'role';
    public $timestamps = true;
    
    /**
     * Variaveis seguras para uso e guardar dados 
     * @var array 
     */
    public $fillable = [
        'id',
        'name',
        'uid',
    ];
    
    /**
     * Tipos nativos dos atributos
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'uid' => 'string',
    ];    


    public function Permissions() {
        return $this->belongsToMany('App\Models\Policy', 'role_policy', 'role_id', 'policy_id');
    }

    public function Users() {
        return $this->belongsToMany('App\Models\Users', 'user_role', 'role_id', 'user_id');
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
           
        if(array_key_exists('name', $filter) && !empty($filter['name'])) {
            $builder->where('name', 'LIKE', '%'.$filter['name'].'%');
        }
           
        if(array_key_exists('uid', $filter) && !empty($filter['uid'])) {
            $builder->where('uid', 'LIKE', '%'.$filter['uid'].'%');
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