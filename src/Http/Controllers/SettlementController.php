<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    
    public function fetch(Request $request)
    {
        $settlements = \Slavic\MissingPersons\Model\Settlement::getByRegion($request->region_id);
        return \Response::json(['settlements' => $settlements], 200);
    }
}
