<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected static $_table = 'settlements';
	
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'place_id', 'region_id', 'code', 'ekatte', 'name', 'lat', 'lng', 'people'
    ];
    
    
    /**
     * The rules for validation.
     *
     * @var array
     */
    public static $rules = array(
        'code' => 'required',
        'region_id' => 'required',
        'ekatte' => 'required',
        'name' => 'required',
        'lat' => 'required',
        'lng' => 'required'
    );
    
    public function region()
    {
        return $this->belongsTo('Slavic\MissingPersons\Model\Region');
    }
    
    /**
     * Find items by region.
     *
     * @return object
     */
    public static function getByRegion($region_id)
    {
        return self::where('region_id', '=', $region_id)->get();
    }
}
