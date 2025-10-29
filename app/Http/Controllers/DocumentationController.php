<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    /**
     * Display the documentation page with resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get search and category filters
        $search = $request->input('search');
        $categoryFilter = $request->input('category');
        
        // Get published resources with pagination
        $resourcesQuery = Resource::published()
            ->latest('created_at');
            
        // Apply search filter if provided
        if ($search) {
            $resourcesQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
            });
        }
            
        // Apply category filter if selected
        if ($categoryFilter) {
            $resourcesQuery->where('category', $categoryFilter);
        }
        
        // Get resources with pagination
        $resources = $resourcesQuery->paginate(9);
        
        // Get categories for filter
        $categories = Resource::published()
            ->select('category')
            ->distinct()
            ->pluck('category');
            
        return view('pages.documentation.index', compact(
            'resources', 
            'categories', 
            'categoryFilter',
            'search'
        ));
    }
    
    /**
     * Display a specific resource.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function showResource($slug)
    {
        // Find the resource by slug
        $resource = Resource::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
            
        // Get related resources in the same category
        $relatedResources = Resource::published()
            ->where('category', $resource->category)
            ->where('id', '!=', $resource->id)
            ->take(3)
            ->get();
            
        return view('documentation.resource', compact('resource', 'relatedResources'));
    }
    
    /**
     * Download a resource file.
     *
     * @param  string  $slug
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadResource($slug)
    {
        // Find the resource by slug
        $resource = Resource::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
            
        // Check if the file exists
        if (!$resource->pdf_file || !file_exists(storage_path('app/public/' . $resource->pdf_file))) {
            return redirect()->back()->with('error', 'Le fichier n\'est pas disponible.');
        }
        
        // Get the file path and name
        $path = storage_path('app/public/' . $resource->pdf_file);
        $fileName = $resource->file_name ?? basename($resource->pdf_file);
        
        // Increment download counter if you have one
        // $resource->increment('downloads');
        
        // Return the file download response
        return response()->download($path, $fileName);
    }
}