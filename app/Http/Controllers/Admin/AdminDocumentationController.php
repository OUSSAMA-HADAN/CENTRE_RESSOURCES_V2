<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $resourcesQuery = Resource::orderBy('created_at', 'desc');
        
        // Apply resource filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $resourcesQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $isPublished = $request->input('status') === 'published';
            $resourcesQuery->where('is_published', $isPublished);
        }
        
        // Execute queries
        $resources = $resourcesQuery->get();
        
        // Count metrics for dashboard cards
        $resourceCounts = [
            'all' => Resource::count(),
            'published' => Resource::where('is_published', true)->count(),
            'draft' => Resource::where('is_published', false)->count(),
        ];
        
        return view('pages.admin.documentation.index', compact(
            'resources', 
            'resourceCounts'
        ));
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
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('resources', $filename, 'public');
            $resource->pdf_file = $path;
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

        $resource->title = $validated['title'];
        $resource->slug = Str::slug($validated['title']);
        $resource->description = $validated['description'];
        $resource->category = $validated['category'];
        $resource->is_published = $validated['is_published'];
        $resource->published_at = $validated['is_published'] ? now() : null;

        // Handle file upload if new file is provided
        if ($request->hasFile('file')) {
            // Delete old file
            if ($resource->pdf_file && Storage::disk('public')->exists($resource->pdf_file)) {
                Storage::disk('public')->delete($resource->pdf_file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('resources', $filename, 'public');
            $resource->pdf_file = $path;
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
     * Download the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function downloadResource(Resource $resource)
    {
        if (!$resource->pdf_file || !Storage::disk('public')->exists($resource->pdf_file)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($resource->pdf_file, $resource->file_name);
    }
}