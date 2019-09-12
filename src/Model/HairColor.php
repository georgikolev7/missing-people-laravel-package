<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class HairColor extends Model
{
    protected $table = 'hair_color';
    
    /**
    * Get all hair colors.
    *
    * @return collect
    */
    public static function getAll()
    {
        return self::all();
    }
}
