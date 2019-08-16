<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    
    public function index()
    {
        $list = \Slavic\MissingPersons\Model\Region::getAll();
        
        return view('missing-persons::regions.index', [
            'list' => $list
        ]);
    }
    
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $region = new \Slavic\MissingPersons\Model\Region();
       
        // Get old post values
        $values = [];
        if (null !== $request->old()) {
            foreach ($request->old() as $key => $value) {
                if (is_array($value)) {
                    $values[str_replace('[]', '', $key)] = implode(',', $value);
                } else {
                    $values[$key] = $value;
                }
            }
        }
       
        return view('missing-persons::regions.create', [
           'region' => $region
       ]);
    }
    
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $region = new \Slavic\MissingPersons\Model\Region();
        
        // validate and save posted data
        if ($request->isMethod('post')) {
            $this->validate($request, $region->getRules());
            
            // Save region
            $region->name = $request->name;
            $region->save();
            
            // Update field
            $region->updateFields($request->all());
            
            // Redirect to my lists page
            $request->session()->flash('alert-success', trans('messages.region.created'));
            return redirect()->action('RegionController@index');
        }
    }
}
