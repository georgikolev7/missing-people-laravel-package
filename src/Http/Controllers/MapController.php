<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $locations = \Slavic\MissingPersons\Model\LastPlace::getNotFound();
        return view('missing-persons::map', [
            'locations' => $locations
        ]);
    }

}
