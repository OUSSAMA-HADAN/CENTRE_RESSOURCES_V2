<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Educatrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducatriceAdminController extends Controller
{
    /**
     * Affiche la liste des éducatrices inscrites.
     */
    public function index()
    {
        $educatrices = Educatrice::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.candidats.index', compact('educatrices'));
    }

    /**
     * Affiche les détails d'une éducatrice.
     */
    public function show(Educatrice $educatrice)
    {
        return view('pages.admin.educatrice.show', compact('educatrice'));
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit(Educatrice $educatrice)
    {
        return view('pages.admin.educatrice.edit', compact('educatrice'));
    }

    /**
     * Met à jour les informations d'une éducatrice.
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
            'niveau_scolaire' => 'required|string|max:255',
            'annees_experience' => 'required|integer|min:0',
            'email' => 'nullable|email|max:255|unique:educatrices,email,' . $educatrice->id,
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $educatrice->update($request->all());

        return redirect()->route('admin.educatrices.index')
            ->with('success', 'Les informations ont été mises à jour avec succès.');
    }

    /**
     * Supprime une éducatrice (soft delete).
     */
    public function destroy(Educatrice $educatrice)
    {
        $educatrice->delete();
        return redirect()->route('admin.educatrices.index')
            ->with('success', 'L\'éducatrice a été supprimée avec succès.');
    }

    /**
     * Exporte les données des éducatrices au format CSV.
     */
    public function export()
    {
        $educatrices = Educatrice::all();
        
        $filename = 'educatrices_' . date('Y-m-d') . '.csv';
        
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        
        $columns = [
            'ID', 'Nom (FR)', 'Prénom (FR)', 'Nom (AR)', 'Prénom (AR)', 
            'CIN', 'Établissement', 'Niveau Scolaire', 'Années d\'expérience',
            'Email', 'Téléphone', 'Adresse', 'Date d\'inscription'
        ];

        $callback = function() use($educatrices, $columns) {
            $file = fopen('php://output', 'w');
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
                    $educatrice->niveau_scolaire,
                    $educatrice->annees_experience,
                    $educatrice->email,
                    $educatrice->telephone,
                    $educatrice->adresse,
                    $educatrice->created_at->format('d/m/Y H:i')
                ];
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}