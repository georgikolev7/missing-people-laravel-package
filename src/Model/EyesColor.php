<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class EyesColor extends Model
{
    protected $table = 'eyes_color';
     
    /**
    * Get all eyes colors.
    *
    * @return collect
    */
    public static function getAll()
    {
        return self::all();
    }
}
