<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Person extends Model
{
    protected $table = 'persons';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'hash', 'type', 'name', 'age',
        'year_of_birth', 'sex', 'height',
        'last_seen', 'eyes_color', 'hair_color',
        'description', 'region_id', 'settlement_id',
        'found', 'date_found', 'lat', 'lng'
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
    
    /**
     * Associations.
     *
     * @var object | collect
     */
    public function region()
    {
        return $this->belongsTo('Slavic\MissingPersons\Model\Region', 'region_id');
    }
    
    public function settlement()
    {
        return $this->belongsTo('Slavic\MissingPersons\Model\Settlement', 'settlement_id');
    }
    
    public function photos()
    {
        return $this->hasMany('Slavic\MissingPersons\Model\PersonPhoto', 'person_id');
    }
    
    public function last_place()
    {
        return $this->hasOne('Slavic\MissingPersons\Model\LastPlace', 'person_id');
    }
    
    public function eyes_color()
    {
        return $this->hasOne('Slavic\MissingPersons\Model\EyesColor', 'eyes_color');
    }
    
    public function hair_color()
    {
        return $this->hasOne('Slavic\MissingPersons\Model\HairColor', 'hair_color');
    }
    
    /**
     * Get latest published persons
     *
     * @return collect
     */
    public static function getLatest($number = 16)
    {
        $records = self::select(DB::raw(DB::getTablePrefix().'persons.*, ' . DB::getTablePrefix() . 'person_photo.thumb'))            ->leftJoin('person_photo', 'persons.id', '=', 'person_photo.person_id');
        $records = $records->groupBy('persons.id')->orderBy('persons.date_added', 'DESC')->get();
        return $records->take($number);
    }
    
    /**
     * Find item by hash.
     *
     * @return object
     */
    public static function getByHash($hash)
    {
        return self::where('hash', '=', $hash)->first();
    }    
    
    /**
     * Get all items.
     *
     * @return collect
     */
    public static function getAll()
    {
        return self::select('*');
    }
}
