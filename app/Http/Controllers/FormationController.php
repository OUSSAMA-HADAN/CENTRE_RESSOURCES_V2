<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FormationController extends Controller
{
    /**
     * Display a listing of the formations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get published formations with optional filtering
        $query = Formation::published()
            ->orderBy('start_date', 'desc');
        
        // Handle search
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // Handle category filtering
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }
        
        // Handle status filtering
        $status = $request->input('status');
        switch ($status) {
            case 'upcoming':
                $query->where('start_date', '>', now());
                break;
            case 'ongoing':
                $query->where('start_date', '<=', now())
                      ->where(function($q) {
                          $q->whereNull('end_date')
                            ->orWhere('end_date', '>=', now());
                      });
                break;
            case 'completed':
                $query->whereNotNull('end_date')
                      ->where('end_date', '<', now());
                break;
        }
        
        // Paginate results
        $formations = $query->paginate(9);
        
        // Get distinct categories for filtering
        $categories = Formation::published()
            ->select('category')
            ->distinct()
            ->pluck('category');
        
        // Prepare status counts
        $statusCounts = [
            'all' => Formation::published()->count(),
            'upcoming' => Formation::published()
                ->where('start_date', '>', now())
                ->count(),
            'ongoing' => Formation::published()
                ->where('start_date', '<=', now())
                ->where(function($q) {
                    $q->whereNull('end_date')
                      ->orWhere('end_date', '>=', now());
                })
                ->count(),
            'completed' => Formation::published()
                ->whereNotNull('end_date')
                ->where('end_date', '<', now())
                ->count(),
        ];
        
        return view('pages.formation.index', compact('formations', 'categories', 'statusCounts', 'status'));
    }

    /**
     * Display the specified formation.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Find the formation by slug
        $formation = Formation::published()->where('slug', $slug)->firstOrFail();
        
        // Get related formations
        $relatedFormations = Formation::published()
            ->where('category', $formation->category)
            ->where('slug', '!=', $slug)
            ->take(3)
            ->get();
        
        // Determine formation status
        $status = match(true) {
            $formation->hasEnded() => 'completed',
            $formation->hasStarted() => 'ongoing',
            default => 'upcoming'
        };
        
        // Calculate remaining time or duration
        $timeInfo = $this->calculateTimeInfo($formation);
        
        return view('pages.formation.show', compact(
            'formation', 
            'relatedFormations', 
            'status',
            'timeInfo'
        ));
    }

    /**
     * Calculate time-related information for a formation.
     *
     * @param  \App\Models\Formation  $formation
     * @return array
     */
    private function calculateTimeInfo($formation)
    {
        $now = now();
        
        // If no start date, return null info
        if (!$formation->start_date) {
            return [
                'remainingTime' => null,
                'durationDetails' => 'Date non spécifiée',
            ];
        }
        
        // Upcoming formation
        if ($formation->start_date > $now) {
            $remainingTime = $now->diff($formation->start_date);
            return [
                'remainingTime' => $remainingTime,
                'durationDetails' => $this->formatRemainingTime($remainingTime, 'upcoming'),
            ];
        }
        
        // Ongoing or completed formation
        if ($formation->end_date) {
            if ($formation->end_date < $now) {
                // Completed formation
                $duration = $formation->start_date->diff($formation->end_date);
                return [
                    'remainingTime' => null,
                    'durationDetails' => $this->formatDuration($duration, 'completed'),
                ];
            } else {
                // Ongoing formation
                $remainingTime = $now->diff($formation->end_date);
                return [
                    'remainingTime' => $remainingTime,
                    'durationDetails' => $this->formatRemainingTime($remainingTime, 'ongoing'),
                ];
            }
        }
        
        // If no end date, but started
        return [
            'remainingTime' => null,
            'durationDetails' => 'En cours',
        ];
    }

    /**
     * Format remaining time for display.
     *
     * @param  \DateInterval  $interval
     * @param  string  $status
     * @return string
     */
    private function formatRemainingTime($interval, $status)
    {
        if ($status === 'upcoming') {
            $parts = [];
            if ($interval->y > 0) $parts[] = $interval->y . ' an' . ($interval->y > 1 ? 's' : '');
            if ($interval->m > 0) $parts[] = $interval->m . ' mois';
            if ($interval->d > 0) $parts[] = $interval->d . ' jour' . ($interval->d > 1 ? 's' : '');
            
            return count($parts) > 0 
                ? 'Commence dans ' . implode(', ', $parts)
                : 'Commence très bientôt';
        }
        
        if ($status === 'ongoing') {
            $parts = [];
            if ($interval->y > 0) $parts[] = $interval->y . ' an' . ($interval->y > 1 ? 's' : '');
            if ($interval->m > 0) $parts[] = $interval->m . ' mois';
            if ($interval->d > 0) $parts[] = $interval->d . ' jour' . ($interval->d > 1 ? 's' : '');
            
            return count($parts) > 0 
                ? 'Se termine dans ' . implode(', ', $parts)
                : 'Se termine bientôt';
        }
        
        return '';
    }

    /**
     * Format duration for completed formations.
     *
     * @param  \DateInterval  $interval
     * @param  string  $status
     * @return string
     */
    private function formatDuration($interval, $status)
    {
        if ($status === 'completed') {
            $parts = [];
            if ($interval->y > 0) $parts[] = $interval->y . ' an' . ($interval->y > 1 ? 's' : '');
            if ($interval->m > 0) $parts[] = $interval->m . ' mois';
            if ($interval->d > 0) $parts[] = $interval->d . ' jour' . ($interval->d > 1 ? 's' : '');
            
            return count($parts) > 0 
                ? 'Durée totale : ' . implode(', ', $parts)
                : 'Durée courte';
        }
        
        return '';
    }
}