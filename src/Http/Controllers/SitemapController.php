<?php

namespace Slavic\MissingPersons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $persons = \Slavic\MissingPersons\Model\Person::getLatest(50);
        return response()->view('missing-persons::sitemap.index', [
            'persons' => $persons
        ])->header('Content-Type', 'text/xml');
    }
}
