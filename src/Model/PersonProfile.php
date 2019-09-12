<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class PersonProfile extends Model
{
    protected $table = 'person_profile';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'person_id', 'age', 'height', 'year_of_birth', 'sex',
        'eyes_color', 'hair_color', 'description', 'region_id',
        'settlement_id'
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
