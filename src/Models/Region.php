<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected static $_table = 'regions';
    
    public function settlements()
    {
        return $this->hasMany('App\Model\Settlement');
    }
}