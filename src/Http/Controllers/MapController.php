<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
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
        SEOTools::setTitle(\Lang::get('missing-persons::missing.page_title_map'));
        SEOTools::setDescription(\Lang::get('missing-persons::missing.default_meta_description'));
        SEOTools::addKeyword(\Lang::get('missing-persons::missing.default_meta_keywords'));
        // End SEO optimization
        
        return view('missing-persons::map', [
            'locations' => $locations
        ]);
    }
}
