<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model  {
    
    use SoftDeletes;
    protected $primaryKey = 'id';
    
    public $table = 'album';
    public $timestamps = true;
    
    public $fillable = [
        'id',
		'user_id',
		'artist_id',
        'name',
		'year',
		'cover'
    ];
    
    protected $casts = [];    

    public function authorize(){
    
        return true;
    }
    
    
    /**
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