<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected static $_table = 'regions';
    
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'place_id', 'code', 'ekatte', 'name', 'lat', 'lng', 'people', 'settlements', 'type'
    ];
    
    
    /**
     * The rules for validation.
     *
     * @var array
     */
    public static $rules = array(
        'code' => 'required',
        'ekatte' => 'required',
        'name' => 'required',
        'lat' => 'required',
        'lng' => 'required',
        'type' => 'required'
    );
    
    public function settlements()
    {
        return $this->hasMany('Slavic\MissingPersons\Model\Settlement');
    }
    
    
    /**
     * Get all regions.
     *
     * @return collect
     */
    public static function getAll()
    {
        return self::all();
    }
}
