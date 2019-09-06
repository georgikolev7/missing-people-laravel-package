<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Logs extends Model
{
    protected $table = 'logs';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'person_id', 'ip_address', 'user_agent'
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
}
