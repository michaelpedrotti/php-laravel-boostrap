<?php
namespace App\Models;

/**
 * Description of Model
 *
 * @author michael
 */
class Model extends \Illuminate\Database\Eloquent\Model {

	public function fetch(array $filter = [], $expression = ['*']){

		if(empty($filter)) $filter = $this->toArray();
    
        $builder = self::selectRaw(implode(',', $expression));

		if(array_has($filter, 'field.id')){
			
			$builder->where('id', array_get($filter, 'field.id'));
		}
		       
        if(array_has($filter, 'field.name')) {
			
			$builder->where('name', 'LIKE', '%'.array_get($filter, 'field.id').'%');
	    }
		
		if(array_has($filter, 'order') && is_array($filter['order'])) {
			
			foreach($filter['order'] as $column => $dir){
				
				$builder->orderBy($column, $dir);
			}
        }
		
		
//		start: 0
//length: 10

        // Grava em laravel.log
        //
        //\Log::info($builder->getBindings());
        //\Log::info($builder->toSql());

        return $builder;
	}
}
