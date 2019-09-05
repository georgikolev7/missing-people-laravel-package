<?php

namespace Slavic\MissingPersons\Model;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    public static function getSelectOptions()
    {
        return [
            ['id' => 1, 'text' => trans('missing.gender_male')],
            ['id' => 2, 'text' => trans('missing.gender_female')],
        ];
    }
}
