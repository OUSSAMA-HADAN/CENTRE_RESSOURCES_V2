<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Educatrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducatriceAdminController extends Controller
{
    /**
     * Display a listing of educatrices with filters and search.
     */
    public function index(Request $request)
    {
        $query = Educatrice::orderBy('created_at', 'desc');

        // Search functionality
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('nom_fr', 'like', "%{$search}%")
                  ->orWhere('prenom_fr', 'like', "%{$search}%")
                  ->orWhere('cin', 'like', "%{$search}%")
                  ->orWhere('etablissement', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telephone', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        // Filter by type of establishment
        if ($type = $request->get('type_etablissement')) {
            $query->where('type_etablissement', $type);
        }

        // Filter by date
        if ($date = $request->get('date')) {
            $query->whereDate('created_at', $date);
        }

        // Get educatrices with pagination
        $educatrices = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get statistics for the dashboard cards
        $stats = [
            'total' => Educatrice::count(),
            'pending' => Educatrice::where('status', 'pending')->count(),
            'approved' => Educatrice::where('status', 'approved')->count(),
            'rejected' => Educatrice::where('status', 'rejected')->count(),
            'private' => Educatrice::where('type_etablissement', 'private')->count(),
            'public' => Educatrice::where('type_etablissement', 'public')->count(),
        ];

        return view('pages.admin.candidats.index', compact('educatrices', 'stats'));
    }

    /**
     * Display the specified educatrice with full details.
     */
    public function show(Educatrice $educatrice)
    {
        return view('pages.admin.candidats.show', compact('educatrice'));
    }

    /**
     * Show the form for editing the specified educatrice.
     */
    public function edit(Educatrice $educatrice)
    {
        return view('pages.admin.candidats.edit', compact('educatrice'));
    }

    /**
     * Update the specified educatrice in storage.
     */
    public function update(Request $request, Educatrice $educatrice)
    {
        $validator = Validator::make($request->all(), [
            'nom_fr' => 'required|string|max:255',
            'nom_ar' => 'nullable|string|max:255',
            'prenom_fr' => 'required|string|max:255',
            'prenom_ar' => 'nullable|string|max:255',
            'cin' => 'required|string|max:20|unique:educatrices,cin,' . $educatrice->id,
            'etablissement' => 'required|string|max:255',
            'type_etablissement' => 'required|in:private,public',
            'niveau_scolaire' => 'required|string|max:255',
            'annees_experience' => 'required|integer|min:0',
            'email' => 'nullable|email|max:255|unique:educatrices,email,' . $educatrice->id,
            'telephone' => 'nullable|string|max:20',
            'date_naissance' => 'nullable|date|before:today',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $educatrice->update($request->all());

            return redirect()->route('admin.educatrices.index')
                ->with('success', 'Les informations ont été mises à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update only the status of the educatrice.
     */
    public function updateStatus(Request $request, Educatrice $educatrice)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $educatrice->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Le statut a été mis à jour avec succès.');
    }

    /**
     * Remove the specified educatrice from storage (soft delete).
     */
    public function destroy(Educatrice $educatrice)
    {
        try {
            $educatrice->delete();
            
            return redirect()->route('admin.educatrices.index')
                ->with('success', 'L\'éducatrice a été supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }

    /**
     * Export educatrices data to CSV.
     */
    public function export(Request $request)
    {
        $query = Educatrice::query();

        // Apply same filters as index
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('nom_fr', 'like', "%{$search}%")
                  ->orWhere('prenom_fr', 'like', "%{$search}%")
                  ->orWhere('cin', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($type = $request->get('type_etablissement')) {
            $query->where('type_etablissement', $type);
        }

        $educatrices = $query->get();
        
        $filename = 'educatrices_' . date('Y-m-d_His') . '.csv';
        
        $headers = array(
            "Content-type" => "text/csv; charset=utf-8",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        
        $columns = [
            'ID', 'Nom (FR)', 'Prénom (FR)', 'Nom (AR)', 'Prénom (AR)', 
            'CIN', 'Établissement', 'Type Établissement', 'Niveau Scolaire', 
            'Années d\'expérience', 'Email', 'Téléphone', 'Date de naissance',
            'Âge', 'Statut', 'Date d\'inscription'
        ];

        $callback = function() use($educatrices, $columns) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, $columns);

            foreach($educatrices as $educatrice) {
                $row = [
                    $educatrice->id,
                    $educatrice->nom_fr,
                    $educatrice->prenom_fr,
                    $educatrice->nom_ar,
                    $educatrice->prenom_ar,
                    $educatrice->cin,
                    $educatrice->etablissement,
                    $educatrice->type_etablissement == 'private' ? 'Privé' : 'Public',
                    $educatrice->niveau_scolaire,
                    $educatrice->annees_experience,
                    $educatrice->email,
                    $educatrice->telephone,
                    $educatrice->date_naissance ? $educatrice->date_naissance->format('d/m/Y') : 'N/A',
                    $educatrice->age ?? 'N/A',
                    ucfirst($educatrice->status),
                    $educatrice->created_at->format('d/m/Y H:i')
                ];
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}