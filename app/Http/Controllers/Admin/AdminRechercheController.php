<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recherche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminRechercheController extends Controller
{
    /**
     * Display a listing of the research publications.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Recherche::latest('published_at');
        
        // Search functionality
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // Category filter
        if ($category = $request->get('category')) {
            $query->where('category', $category);
        }
        
        // Status filter
        if ($status = $request->get('status')) {
            if ($status === 'published') {
                $query->where('is_published', true);
            } elseif ($status === 'draft') {
                $query->where('is_published', false);
            }
        }
        
        $recherches = $query->paginate(10);
        
        // Get counts for stats cards
        $counts = [
            'all' => Recherche::count(),
            'published' => Recherche::where('is_published', true)->count(),
            'draft' => Recherche::where('is_published', false)->count()
        ];
        return view('pages.admin.recherche.index', compact('recherches', 'counts'));
    }

    /**
     * Show the form for creating a new research publication.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.admin.recherche.create');
    }

    /**
     * Store a newly created research publication in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required|max:200',
            'content' => 'required',
            'category' => 'required',
            'is_published' => 'required|boolean',
            'published_at' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
        ]);

        try {
            $recherche = new Recherche();
            $recherche->title = $request->title;
            $recherche->slug = Str::slug($request->title);
            $recherche->summary = $request->summary;
            $recherche->content = $request->content;
            $recherche->category = $request->category;
            $recherche->is_published = (bool)$request->input('is_published');
            
            // Set published date
            if ($request->published_at) {
                $recherche->published_at = $request->published_at;
            } elseif ($request->is_published) {
                $recherche->published_at = now();
            }
            
            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                $path = $request->file('cover_image')->store('recherche/images', 'public');
                $recherche->cover_image = $path;
            }
        
            // Handle PDF file upload
            if ($request->hasFile('pdf_file')) {
                $path = $request->file('pdf_file')->store('recherche/documents', 'public');
                $recherche->pdf_file = $path;
            }
        
            $recherche->save();
            return redirect()
                ->route('admin.recherche.index')
                ->with('success', 'Publication créée avec succès!');
                
        } catch (\Exception $e) {
            Log::error('Error creating research publication: ' . $e->getMessage());
            
            return back()
                ->with('error', 'Une erreur est survenue lors de la création de la publication.')
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified research publication.
     *
     * @param  \App\Models\Recherche  $recherche
     * @return \Illuminate\View\View
     */
    public function edit(Recherche $recherche)
    {
        return view('pages.admin.recherche.edit', compact('recherche'));
    }

    /**
     * Update the specified research publication in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recherche  $recherche
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Recherche $recherche)
    {
        $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required|max:200',
            'content' => 'required',
            'category' => 'required',
            'is_published' => 'required|boolean',
            'published_at' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'meta_keywords' => 'nullable|max:255',
            'meta_description' => 'nullable|max:160',
        ]);

        try {
            // Update recherche model
            $recherche->title = $request->title;
            
            // Only update slug if title has changed to preserve SEO
            if ($recherche->isDirty('title')) {
                $recherche->slug = Str::slug($request->title);
            }
            
            $recherche->summary = $request->summary;
            $recherche->content = $request->content;
            $recherche->category = $request->category;
            
            // Handle publication status change
            $wasPublished = $recherche->is_published;
            $recherche->is_published = (bool)$request->input('is_published');

            // Set published date if becoming published for the first time
            if (!$wasPublished && $request->is_published && empty($recherche->published_at)) {
                $recherche->published_at = now();
            }
            
            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                // Delete old image if exists
                if ($recherche->cover_image) {
                    Storage::disk('public')->delete($recherche->cover_image);
                }
                
                $path = $request->file('cover_image')->store('recherche/images', 'public');
                $recherche->cover_image = $path;
            }

            // Handle PDF file upload
            if ($request->hasFile('pdf_file')) {
                // Delete old file if exists
                if ($recherche->pdf_file) {
                    Storage::disk('public')->delete($recherche->pdf_file);
                }
                
                $path = $request->file('pdf_file')->store('recherche/documents', 'public');
                $recherche->pdf_file = $path;
            }
            
            $recherche->save();
            
            return redirect()
                ->route('admin.recherche.index')
                ->with('success', 'Publication mise à jour avec succès!');
                
        } catch (\Exception $e) {
            Log::error('Error updating research publication: ' . $e->getMessage());
            
            return back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour de la publication.')
                ->withInput();
        }
    }

    /**
     * Remove the specified research publication from storage.
     *
     * @param  \App\Models\Recherche  $recherche
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Recherche $recherche)
{
    try {
        // Delete related files
        if ($recherche->cover_image && Storage::disk('public')->exists($recherche->cover_image)) {
            Storage::disk('public')->delete($recherche->cover_image);
        }
        
        if ($recherche->pdf_file && Storage::disk('public')->exists($recherche->pdf_file)) {
            Storage::disk('public')->delete($recherche->pdf_file);
        }
        
        $recherche->delete();
        
        return redirect()
            ->route('admin.recherche.index')
            ->with('success', 'Publication supprimée avec succès!');
            
    } catch (\Exception $e) {
        Log::error('Error deleting research publication: ' . $e->getMessage());
        
        return back()
            ->with('error', 'Une erreur est survenue lors de la suppression de la publication.');
    }
}
}