<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class PersonFound extends Model
{
    protected $table = 'person_found';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'person_id', 'date_found', 'dead'
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
    
    public function store($id, $request)
    {
        // store
    }
    
    /**
     * Find profile by person.
     *
     * @return object
     */
    public static function getByPerson($person_id)
    {
        return self::where('person_id', '=', $person_id)->get();
    }
}
