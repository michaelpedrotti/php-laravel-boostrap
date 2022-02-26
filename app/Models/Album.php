<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

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
    
    
	public function fetchArtists(){
		
		$artists = [];
		
		$array = Redis::hGetAll('artist-list');
		
		if(!empty($array)){
			
			$artists = $array;
		}
		else {
					
			$client = Http::withHeaders(["Basic" => env('ALBUM_ARTIST_BASIC')])->get(env('ALBUM_ARTIST_URL'));
			if($client->ok()){

				foreach($client->json([]) as $list){

					$array = array_pop($list);

					$key = Arr::get($array, 'id', 0);
					$val = Arr::get($array, 'name', 'Unknow');

					$artists[$key] = $val;

					// @todo: Set expires
					Redis::hSet('artist-list', $key, $val);
				}
			}
		}
		
		return $artists;
	}
	
	public function findArtist($artist_id = 0){
		
		$array = [];
		
		$string = Redis::hGet('artist-detail', $artist_id);
		
		if(!empty($string)){
			
			$array = json_decode($string, true);
		}
		else {
			
			$client = Http::withHeaders(["Basic" => env('ALBUM_ARTIST_BASIC')])->get(env('ALBUM_ARTIST_URL').'/?artist_id='.$artist_id);
			if($client->ok()){

				$result = $client->json([]);

				$array = array_pop($result);

				// @todo: Set expires
				Redis::hSet('artist-detail', $artist_id, json_encode($array));
			}
		}
		return $array;
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