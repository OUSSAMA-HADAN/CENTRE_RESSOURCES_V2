<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recherche;
use App\Models\Documentation;
use App\Models\Educatrice;
use App\Models\Formation;
use App\Models\Resource;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get counts for dashboard cards
        $statistics = [
            'applicants' => [
                'total' => Educatrice::count(),
                'pending' => Educatrice::where('status', 'pending')->count(),
            ],
            'formations' => [
                'total' => Formation::count(),
                'published' => Formation::where('is_published', true)->count(),
            ],
            'recherches' => [
                'total' => Recherche::count(),
                'published' => Recherche::where('is_published', true)->count(),
            ],
            'resources' => [
                'total' => Resource::count(),
                'published' => Resource::where('is_published', true)->count(),
            ],
            // Nouvelles statistiques pour les éducatrices
            'educatrices' => [
                'total' => Educatrice::count(),
                'recent' => Educatrice::whereMonth('created_at', now()->month)->count(),
                'schools' => Educatrice::distinct('etablissement')->count('etablissement'),
            ]
        ];
         // Add monthly data for the area chart
        // This example gets data for the last 12 months
        $monthlyData = []; // Format: [['Month', count], ['Month', count]]
        $recentApplicants = Educatrice::latest()->take(10)->get();
        // Récupération des éducatrices récentes
        $recentEducatrices = Educatrice::latest()->take(5)->get();
        
        
        return view('pages.admin.dashboard', compact('statistics', 'recentApplicants' ,'recentEducatrices', 'monthlyData'));
    }
    
}