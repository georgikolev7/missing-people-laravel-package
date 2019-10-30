<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Page extends Model
{
    protected $table = 'pages';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'page', 'title', 'content'
    ];
    
    /**
     * Get page by code.
     *
     * @return object
     */
    public static function getByCode($page)
    {
        return self::where('page', '=', $page)->first();
    }
}
