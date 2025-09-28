<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminFormationController extends Controller
{
    /**
     * Display a listing of the formations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Formation::latest('created_at');

        // Apply search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Apply category filter
        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        // Apply status filter
        if ($status = $request->input('status')) {
            if ($status === 'published') {
                $query->where('is_published', true);
            } elseif ($status === 'draft') {
                $query->where('is_published', false);
            }
        }

        $formations = $query->paginate(10);

        // Count formations by status for stats
        $counts = [
            'all' => Formation::count(),
            'published' => Formation::where('is_published', true)->count(),
            'draft' => Formation::where('is_published', false)->count(),
            'upcoming' => Formation::where('is_published', true)
                ->where('start_date', '>', now())
                ->count(),
            'in_progress' => Formation::where('is_published', true)
                ->where('start_date', '<=', now())
                ->where(function ($q) {
                    $q->whereNull('end_date')
                        ->orWhere('end_date', '>=', now());
                })
                ->count(),
            'completed' => Formation::where('is_published', true)
                ->whereNotNull('end_date')
                ->where('end_date', '<', now())
                ->count(),
        ];

        $categories = Formation::select('category')->distinct()->pluck('category');

        return view('pages.admin.formations.index', compact('formations', 'counts', 'categories'));
    }

    /**
     * Show the form for creating a new formation.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.admin.formations.create');
    }

    /**
     * Store a newly created formation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Remove the dd() call that's preventing form submission
        // dd($request->all());

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'formateur' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'is_published' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Create a new formation record
            $formation = new Formation();

            // Basic information
            $formation->title = $validated['title'];
            $formation->slug = Str::slug($validated['title']);
            $formation->description = $validated['description'];
            $formation->content = $validated['description']; // Using description as content since content isn't in the form
            $formation->formateur = $validated['formateur'];
            $formation->platform = $validated['platform'];
            // Dates and times
            $formation->start_date = $validated['start_date'] ?? null;
            $formation->end_date = $validated['end_date'] ?? null;

            // Calculate duration based on start and end dates if available
            if ($formation->start_date && $formation->end_date) {
                $start = new \DateTime($formation->start_date);
                $end = new \DateTime($formation->end_date);
                $interval = $start->diff($end);

                if ($interval->days > 0) {
                    $formation->duration = $interval->days . ' jours';
                } else {
                    $formation->duration = $interval->h . ' heures';
                }
            } else {
                $formation->duration = 'Non définie';
            }
            // Formation::create('formation', [
            //     'title' => $validated['title'],
            //     'slug' => Str::slug($validated['title']),
            //     'description' => $validated['description'],
            //     'content' => $validated['description'], // Using description as content since content isn't in the form
            //     'start_date' => $validated['start_date'] ?? null,
            //     'end_date' => $validated['end_date'] ?? null,
            //     'formateur' => $validated['formateur'],
            //     'platform' => $validated['platform'],
            // ]);

            // Location is platform in this case
            // $formation->location = $validated['platform'];

            // Category (not in the form, setting a default)
            $formation->category = 'online'; // Default category

            // Publication status
            $formation->is_published = $request->has('is_published');

            // Image handling
            if ($request->hasFile('image')) {
                $formation->thumbnail = $request->file('image')->store('formations/thumbnails', 'public');
            }

            // Save the record
            $formation->save();

            return redirect()->route('admin.formations.index')
                ->with('success', 'Formation créée avec succès.');
        } catch (\Exception $e) {
            Log::error('Error creating formation: ' . $e->getMessage());

            return back()
                ->with('error', 'Une erreur est survenue lors de la création de la formation: ' . $e->getMessage())
                ->withInput();
        }
    }
    /**
     * Show the form for editing the specified formation.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\View\View
     */
    public function edit(Formation $formation)
    {
        return view('pages.admin.formations.edit', compact('formation'));
    }

    /**
     * Update the specified formation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Formation $formation)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('formations')->ignore($formation->id)
            ],
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'duration' => 'required|string|max:50',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Set boolean value for is_published
            $validated['is_published'] = $request->has('is_published');

            // Generate slug if not provided
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['title']);
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($formation->thumbnail && Storage::disk('public')->exists($formation->thumbnail)) {
                    Storage::disk('public')->delete($formation->thumbnail);
                }

                $validated['thumbnail'] = $request->file('thumbnail')->store('formations/thumbnails', 'public');
            }

            $formation->update($validated);

            return redirect()->route('admin.formations.index')
                ->with('success', 'Formation mise à jour avec succès.');

        } catch (\Exception $e) {
            Log::error('Error updating formation: ' . $e->getMessage());

            return back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour de la formation.')
                ->withInput();
        }
    }

    /**
     * Remove the specified formation from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Formation $formation)
    {
        try {
            // Delete thumbnail
            if ($formation->thumbnail && Storage::disk('public')->exists($formation->thumbnail)) {
                Storage::disk('public')->delete($formation->thumbnail);
            }

            $formation->delete();

            return redirect()->route('admin.formations.index')
                ->with('success', 'Formation supprimée avec succès.');
        } catch (\Exception $e) {
            Log::error('Error deleting formation: ' . $e->getMessage());

            return back()
                ->with('error', 'Une erreur est survenue lors de la suppression de la formation.');
        }
    }
}
