<?php

namespace App\Http\Controllers;

use App\Models\Recherche;
use Illuminate\Http\Request;

class RechercheController extends Controller
{
    /**
     * Display a listing of the research publications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Start with only published research
        $query = Recherche::where('is_published', true);
        
        // Handle search
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // Handle category filtering
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }
        
        // Handle year filtering
        if ($year = $request->input('year')) {
            $query->whereYear('published_at', $year);
        }
        
        // Retrieve paginated results
        $publications = $query->latest('published_at')->paginate(10);
        
        // Get distinct categories and years for filtering
        $categories = Recherche::where('is_published', true)->distinct()->pluck('category');
        $years = Recherche::where('is_published', true)
            ->selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        return view('pages.recherche.index', compact('publications'));
    }

    /**
     * Display the specified research publication.
     *
     * @param  \App\Models\Recherche  $recherche
     * @return \Illuminate\View\View
     */
    public function show(Recherche $recherche)
    {
        // Ensure the research is published
        if (!$recherche->is_published) {
            abort(404);
        }
        
        // Get related research (only published)
        $relatedResearches = Recherche::where('is_published', true)
            ->where('category', $recherche->category)
            ->where('id', '!=', $recherche->id)
            ->take(3)
            ->get();
        
        return view('pages.recherche.show', compact('recherche', 'relatedResearches'));
    }
}