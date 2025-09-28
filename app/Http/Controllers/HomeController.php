<?php

namespace App\Http\Controllers;

use App\Models\Recherche;
use App\Models\Documentation;
use App\Models\Formation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with featured content
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $recherches = Recherche::where('status', 'published')->latest()->limit(3)->get();
        // $documentations = Documentation::where('status', 'published')->latest()->limit(3)->get();
        // $formations = Formation::where('status', 'published')->latest()->limit(3)->get();

        return view('pages.index');
    }
}