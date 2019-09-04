<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class LastPlace extends Model
{
    protected $table = 'person_last_place';    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'person_id', 'address', 'lat', 'lng'
    ];
    /**
     * Associations.
     *
     * @var object | collect
     */
    public function person()
    {
        return $this->belongsTo('Slavic\MissingPersons\Model\Person', 'person_id');
    }
    
    /**
     * Get all persons that are not found.
     *
     * @return object
     */
    public static function getNotFound()
    {
        $records = self::select(DB::raw(
            DB::getTablePrefix().'person_last_place.*, ' .
            DB::getTablePrefix() . 'persons.name, ' .
            DB::getTablePrefix() . 'persons.hash, ' .
            DB::getTablePrefix() . 'person_photo.icon'
        ))
        ->leftJoin('persons', 'persons.id', '=', 'person_last_place.person_id')
        ->leftJoin('person_photo', 'persons.id', '=', 'person_photo.person_id');
        $records = $records->where('persons.found', 0)->groupBy('person_last_place.person_id')->orderBy('persons.created_at', 'DESC')->get();
        return $records;
    }
}
