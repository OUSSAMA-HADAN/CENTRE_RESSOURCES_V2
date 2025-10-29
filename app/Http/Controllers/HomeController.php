<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display the home page with featured content
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the count of published documentation resources with caching
        $documentationCount = Cache::remember('documentation_count', 3600, function () {
            return Resource::published()->count();
        });

        return view('pages.index', compact('documentationCount'));
    }
}