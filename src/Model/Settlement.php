<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected static $_table = 'settlements';
    
    public function region()
    {
        return $this->belongsTo('App\Model\Region');
    }
}