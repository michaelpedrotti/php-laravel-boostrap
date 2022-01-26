<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model {
    
    use SoftDeletes;
    protected $primaryKey = 'id';
    
    public $table = 'users';
    public $timestamps = true;
	    
    /**
     * Variaveis seguras para uso e guardar dados 
     * @var array 
     */
    public $fillable = [
        'id',
        'name',
        'email',
        'password',
        'remember_token',
		'first_login'
    ];
    
    /**
     * Tipos nativos dos atributos
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'remember_token' => 'string',
		'first_login' => 'string'
    ];    
	
    /**
	 * Mutator para Data de expiração	 *
	 * @link https://laravel.com/docs/5.5/eloquent-mutators 
	 */
	public function setPasswordAttribute($value){
		
		//$this->addHidden(['password_plain' => $value]); 
		$this->attributes['password'] = bcrypt($value);
	}
	
	public function getCurrentAcl(){
		
		$model = Role::select('role.*')
			->join('user_role', 'user_role.role_id', 'role.id')
			->where('user_role.user_id', $this->id)
				->get()
					->first();
		
		if(empty($model)) {
			$model = Acls::where('uid', 'ADMIN')->first();
		}
		
		return $model;
	}
	
    public function Roles() {
        return $this->hasMany('\App\Models\UserRole', 'user_id', 'id');
    }
	
    public function UserRole() {
        return $this->hasOne('\App\Models\UserRole', 'user_id', 'id');
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
    public function fetch(array $filter = [], $expression = ['*']) {
        
        if(empty($filter)) $filter = $this->toArray();
    
        $builder = self::selectRaw(implode(',', $expression));

           
        if(array_key_exists('id', $filter) && !empty($filter['id'])) {
            $builder->where('id', $filter['id']);
        }
           
        if(array_key_exists('name', $filter) && !empty($filter['name'])) {
            $builder->where('name', 'LIKE', '%'.$filter['name'].'%');
        }
           
        if(array_key_exists('email', $filter) && !empty($filter['email'])) {
            $builder->where('email', 'LIKE', '%'.$filter['email'].'%');
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


	
//	static protected function boot() {
//		
//		static::observe(\App\Observers\UserObserver::class);
//		static::bootTraits();
//	}
}