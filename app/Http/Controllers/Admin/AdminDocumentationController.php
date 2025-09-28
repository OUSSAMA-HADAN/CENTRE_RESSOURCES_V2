<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Recherche;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminDocumentationController extends Controller
{
    /**
     * Display a listing of the documentation and resources.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Query builders
        $publicationsQuery = Recherche::orderBy('created_at', 'desc');
        $resourcesQuery = Resource::orderBy('created_at', 'desc');
        
        // Apply publication filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $publicationsQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('category')) {
            $publicationsQuery->where('category', $request->input('category'));
        }
        
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $isPublished = $request->input('status') === 'published';
            $publicationsQuery->where('is_published', $isPublished);
        }
        
        // Apply resource filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $resourcesQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $isPublished = $request->input('status') === 'published';
            $resourcesQuery->where('is_published', $isPublished);
        }
        
        // Execute queries
        $publications = $publicationsQuery->get();
        $resources = $resourcesQuery->get();
        
        // Count metrics for dashboard cards
        $publicationCounts = [
            'all' => Recherche::count(),
            'published' => Recherche::where('is_published', true)->count(),
            'draft' => Recherche::where('is_published', false)->count(),
        ];
        
        $resourceCounts = [
            'all' => Resource::count(),
            'published' => Resource::where('is_published', true)->count(),
            'draft' => Resource::where('is_published', false)->count(),
        ];
        
        return view('pages.admin.documentation.index', compact(
            'publications', 
            'resources', 
            'publicationCounts', 
            'resourceCounts'
        ));
    }

    /**
     * Show the form for creating a new publication.
     *
     * @return \Illuminate\View\View
     */
    public function createPublication()
    {
        return view('pages.admin.documentation.publication.create');
    }

    /**
     * Store a newly created publication in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePublication(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:recherches',
            'summary' => 'required|string|max:1000',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('publications/covers', 'public');
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('publications/files', 'public');
        }

        // Set slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set default values for optional fields
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;
        $validated['published_at'] = $validated['published_at'] ?? now();

        Recherche::create($validated);

        return redirect()->route('admin.documentation.index')
            ->with('success', 'Publication created successfully.');
    }

    /**
     * Show the form for editing the specified publication.
     *
     * @param  \App\Models\Recherche  $publication
     * @return \Illuminate\View\View
     */
    public function editPublication(Recherche $publication)
    {
        return view('pages.admin.documentation.publication.edit', compact('publication'));
    }

    /**
     * Update the specified publication in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recherche  $publication
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePublication(Request $request, Recherche $publication)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('recherches')->ignore($publication->id)
            ],
            'summary' => 'required|string|max:1000',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'is_published' => 'nullable|boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old file
            if ($publication->cover_image && Storage::disk('public')->exists($publication->cover_image)) {
                Storage::disk('public')->delete($publication->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('publications/covers', 'public');
        }

        // Handle PDF file upload
        if ($request->hasFile('pdf_file')) {
            // Delete old file
            if ($publication->pdf_file && Storage::disk('public')->exists($publication->pdf_file)) {
                Storage::disk('public')->delete($publication->pdf_file);
            }
            $validated['pdf_file'] = $request->file('pdf_file')->store('publications/files', 'public');
        }

        // Set slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set is_published
        $validated['is_published'] = $request->has('is_published') ? 1 : 0;

        $publication->update($validated);

        return redirect()->route('admin.documentation.index')
            ->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified publication from storage.
     *
     * @param  \App\Models\Recherche  $publication
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyPublication(Recherche $publication)
    {
        // Delete associated files
        if ($publication->cover_image && Storage::disk('public')->exists($publication->cover_image)) {
            Storage::disk('public')->delete($publication->cover_image);
        }
        
        if ($publication->pdf_file && Storage::disk('public')->exists($publication->pdf_file)) {
            Storage::disk('public')->delete($publication->pdf_file);
        }

        $publication->delete();

        return redirect()->route('admin.documentation.index')
            ->with('success', 'Publication deleted successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function createResource()
    {
        return view('pages.admin.documentation.resource.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function storeResource(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:200',
        'category' => 'required|string|max:255',
        'is_published' => 'required',
        'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip|max:10240',
    ]);

    // Create a new resource
    $resource = new Resource();
    $resource->title = $validated['title'];
    $resource->slug = Str::slug($validated['title']);
    $resource->description = $validated['description'];
    $resource->category = $validated['category'];
    $resource->is_published = $validated['is_published'];
    $resource->published_at = $validated['is_published'] ? now() : null;

    // Handle file upload
    if ($request->hasFile('file')) {
        $resource->pdf_file = $request->file('file')->store('resources/files', 'public');
    }

    $resource->save();

    return redirect()->route('admin.documentation.index')
        ->with('success', 'Resource created successfully.');
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Models\Resource  $resource
 * @return \Illuminate\View\View
 */
public function editResource(Resource $resource)
{
    return view('pages.admin.documentation.resource.edit', compact('resource'));
}

/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\Resource  $resource
 * @return \Illuminate\Http\RedirectResponse
 */
public function updateResource(Request $request, Resource $resource)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:200',
        'category' => 'required|string|max:255',
        'is_published' => 'required',
        'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip|max:10240',
    ]);

    // Update resource fields
    $resource->title = $validated['title'];
    $resource->slug = Str::slug($validated['title']);
    $resource->description = $validated['description'];
    $resource->category = $validated['category'];
    $resource->is_published = $validated['is_published'];
    
    // Only update published_at if the status changed
    if ($resource->is_published != $validated['is_published']) {
        $resource->published_at = $validated['is_published'] ? now() : null;
    }

    // Handle file upload if present
    if ($request->hasFile('file')) {
        // Delete old file
        if ($resource->pdf_file && Storage::disk('public')->exists($resource->pdf_file)) {
            Storage::disk('public')->delete($resource->pdf_file);
        }
        $resource->pdf_file = $request->file('file')->store('resources/files', 'public');
    }

    $resource->save();

    return redirect()->route('admin.documentation.index')
        ->with('success', 'Resource updated successfully.');
}

/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Models\Resource  $resource
 * @return \Illuminate\Http\RedirectResponse
 */
public function destroyResource(Resource $resource)
{
    // Delete associated file
    if ($resource->pdf_file && Storage::disk('public')->exists($resource->pdf_file)) {
        Storage::disk('public')->delete($resource->pdf_file);
    }

    $resource->delete();

    return redirect()->route('admin.documentation.index')
        ->with('success', 'Resource deleted successfully.');
}

/**
 * Download the resource file.
 *
 * @param  \App\Models\Resource  $resource
 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
 */
public function downloadResource(Resource $resource)
{
    if (!$resource->pdf_file || !Storage::disk('public')->exists($resource->pdf_file)) {
        return redirect()->back()->with('error', 'Le fichier n\'existe pas.');
    }
    
    $path = storage_path('app/public/' . $resource->pdf_file);
    $fileName = basename($resource->pdf_file);
    
    return response()->download($path, $fileName);
}
}