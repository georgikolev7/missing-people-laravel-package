<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use File;
use Slavic\MissingPersons\Libraries\FileUploader;

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
    
    public function edit(Request $request)
    {
        $person = \Slavic\MissingPersons\Model\Person::getByHash($request->hash);
        
        $genders = \Slavic\MissingPersons\Model\Gender::getSelectOptions();
        $hair_colors = \Slavic\MissingPersons\Model\HairColor::getAll();
        $eyes_colors = \Slavic\MissingPersons\Model\EyesColor::getAll();
        $regions = \Slavic\MissingPersons\Model\Region::getAll();
       
        return view('missing-persons::persons.edit', [
           'person' => $person,
           'genders' => $genders,
           'hair_colors' => $hair_colors,
           'eyes_colors' => $eyes_colors,
           'regions' => $regions
       ]);
    }
    
    /**
     * Get list of photos of the person
     * @param  Reqeust $request
     * @return \Illuminate\Http\Response
     */
    public function list_photo(Reqeust $request)
    {
        $person_id = $request->input('id');
        $photos = \Slavic\MissingPersons\Model\PersonPhoto::getByPerson($person_id);
        
        return response()->json(array('photos' => $photos));
    }
    
    
    /**
     * Storing photos of the missing/wanted person
     * @param  Request $request
     */
    public function store_photo(Request $request)
    {
        $upload_path = \Slavic\MissingPersons\Model\PersonPhoto::dirPath($request->id);
        
        if (!file_exists($upload_path)) {
            File::makeDirectory($upload_path, 0755, true, true);
        }
        
        $FileUploader = new FileUploader('filename', array(
            'uploadDir' => $upload_path
        ));
        
        $upload = $FileUploader->upload();
      
        if ($upload['isSuccess']) {
            \Slavic\MissingPersons\Model\PersonPhoto::createThumbnails($request->id, $upload['files']);
        }
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
        $regions = \Slavic\MissingPersons\Model\Region::getAll();
       
        return view('missing-persons::persons.create', [
           'person' => $person,
           'genders' => $genders,
           'hair_colors' => $hair_colors,
           'eyes_colors' => $eyes_colors,
           'regions' => $regions
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
        
        $hash = mb_substr(md5(strtotime('now')), 0, 10, 'UTF-8');
        
        // validate and save posted data
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'age' => 'required',
                'eyes_color' => 'required',
                'hair_color' => 'required',
                'height' => 'required',
                'description' => 'required',
            ]);
            
            // Update fields
            $person = \Slavic\MissingPersons\Model\Person::updateOrCreate([
                'hash' => $hash,
                'name' => $request->get('name'),
                'age' => $request->get('age'),
                'height' => $request->get('height'),
                'year_of_birth' => (date('Y') - $request->get('age')),
                'eyes_color' => $request->get('eyes_color'),
                'hair_color' => $request->get('hair_color'),
                'description' => $request->get('description'),
                //'last_seen' => $request->get('last_seen_date'),
                'region_id' => $request->get('region_id'),
                'settlement_id' => $request->get('settlement_id')
            ]);
            
            // Update last known place
            $last_place = \Slavic\MissingPersons\Model\LastPlace::updateOrCreate([
                'person_id' => $person->id,
            ], [
                'address' => $request->get('exact_address_text'),
                'lat' => $request->get('exact_address_latitude'),
                'lng'    => $request->get('exact_address_longitude')
            ]);
            
            return \Response::json($person, 200);
        }
    }
}
