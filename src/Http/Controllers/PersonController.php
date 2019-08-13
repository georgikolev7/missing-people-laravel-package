<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $persons = \Slavic\MissingPersons\Model\Person::getLatest();
        return view('missing-persons::persons.index', [
            'persons' => $persons
        ]);
    }
    
    public function view(Request $request)
    {
        $person = \Slavic\MissingPersons\Model\Person::getByHash($request->hash);
        return view('missing-persons::persons.view', [
            'person' => $person
        ]);
    }
    
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $person = new \Slavic\MissingPersons\Model\Person();
       
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
        
        $genders = \Slavic\MissingPersons\Model\Gender::getSelectOptions();
        $hair_colors = \Slavic\MissingPersons\Model\HairColor::getAll();
        $eyes_colors = \Slavic\MissingPersons\Model\EyesColor::getAll();
       
        return view('missing-persons::persons.create', [
           'person' => $person,
           'genders' => $genders,
           'hair_colors' => $hair_colors,
           'eyes_colors' => $eyes_colors
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
        $person = new \Slavic\MissingPersons\Model\Person();
        
        // validate and save posted data
        if ($request->isMethod('post')) {
            $this->validate($request, $region->getRules());
            
            // Save region
            $region->name = $request->name;
            $region->save();
            
            // Update field
            $region->updateFields($request->all());
            
            // Redirect to my lists page
            $request->session()->flash('alert-success', trans('messages.person.created'));
            return redirect()->action('PersonController@index');
        }
    }
}
