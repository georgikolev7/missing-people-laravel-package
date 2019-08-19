<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $locations = self::getNotFound();
        return view('missing-persons::map.index', [
            'locations' => $locations
        ]);
    }
    
    /**
     * Find item by hash.
     *
     * @return object
     */
    public static function getNotFound()
    {
        return self::where('found', '=', 0)->get();
    }

}
