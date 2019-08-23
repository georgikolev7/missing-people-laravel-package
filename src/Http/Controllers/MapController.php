<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;
use Khead;
use Illuminate\Http\Request;
use Lang;

class MapController extends Controller
{
    /**
     * Display a map with all not found persons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = \Slavic\MissingPersons\Model\LastPlace::getNotFound();
        
        // SEO optimization
        Khead::setTitle(\Lang::get('missing-persons::missing.page_title_map'));
        
        Khead::setMeta('description', [
            'name' => 'description',
            'content' => \Lang::get('missing-persons::missing.default_meta_description')
        ]);
        
        Khead::setMeta('keywords', [
            'name' => 'keywords',
            'content' => \Lang::get('missing-persons::missing.default_meta_keywords')
        ]);
        
        // End SEO optimization
        
        return view('missing-persons::map', [
            'locations' => $locations
        ]);
    }

}
