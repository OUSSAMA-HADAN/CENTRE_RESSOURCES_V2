<?php

namespace App\Http\Controllers;

use App\Models\Educatrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EducatriceController extends Controller
{
    /**
     * Affiche le formulaire d'inscription pour les éducatrices.
     */
    public function create()
    {
        return view('pages.inscription.Educatrice');
    }

    /**
     * Enregistre une nouvelle éducatrice dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nom_fr' => 'required|string|max:255',
            'nom_ar' => 'nullable|string|max:255',
            'prenom_fr' => 'required|string|max:255',
            'prenom_ar' => 'nullable|string|max:255',
            'cin' => 'required|string|max:20|unique:educatrices',
            'etablissement' => 'required|string|max:255',
            'niveau_scolaire' => 'required|string|max:255',
            'annees_experience' => 'required|integer|min:0',
            'email' => 'nullable|email|max:255|unique:educatrices',
            'telephone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Création de l'éducatrice
        $educatrice = Educatrice::create($request->all());

        // Retourner à la même page avec message de succès
        return redirect()->back()
            ->with('success', 'Inscription réussie ! Nous vous contacterons bientôt.');
    }
}