<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;

class LastPlace extends Model
{
    protected $table = 'person_last_place';
    
    /**
     * Associations.
     *
     * @var object | collect
     */
    public function person()
    {
        return $this->belongsTo('Slavic\MissingPersons\Model\Person', 'person_id');
    }
}
