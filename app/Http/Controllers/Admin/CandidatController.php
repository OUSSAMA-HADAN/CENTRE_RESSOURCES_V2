<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CandidatController extends Controller
{
    /**
     * Display a listing of the applicants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Applicant::query()->latest();
        
        // Search functionality
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }
        
        // Status filter
        if ($status = $request->get('statut')) {
            switch ($status) {
                case 'en_attente':
                    $query->where('status', 'pending');
                    break;
                case 'accepte':
                    $query->where('status', 'approved');
                    break;
                case 'refuse':
                    $query->where('status', 'rejected');
                    break;
            }
        }
        
        // Date filter
        if ($date = $request->get('date')) {
            $query->whereDate('created_at', $date);
        }
        
        $candidats = $query->paginate(15);
        
        return view('pages.admin.candidats.index', compact('candidats'));
    }

    /**
     * Display the specified applicant.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\View\View
     */
    public function show(Applicant $candidat)
    {
        return view('pages.admin.candidats.show', ['candidat' => $candidat]);
    }

    /**
     * Show the form for editing the specified applicant.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\View\View
     */
    public function edit(Applicant $candidat)
    {
        return view('pages.admin.candidats.edit', ['candidat' => $candidat]);
    }

    /**
     * Update the specified applicant in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Applicant $candidat)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:applicants,email,' . $candidat->id,
        'birth_date' => 'required|date|before:today',
        'birth_place' => 'required|string|max:255',
        'id_card_number' => 'required|string|max:50|unique:applicants,id_card_number,' . $candidat->id,
        'phone_number' => 'required|string|max:20',
        'marital_status' => 'required|in:single,married,divorced,widowed',
        'years_of_experience' => 'required|integer|min:0|max:100',
        'education_level' => 'required|string|max:255',
        'status' => 'required|in:pending,approved,rejected',
        'notes' => 'nullable|string',
    ]);

    try {
        $candidat->update($request->all());
        
        return redirect()
            ->route('admin.candidats.index', $candidat)
            ->with('success', 'Candidat mis à jour avec succès.');
    } catch (\Exception $e) {
        Log::error('Error updating applicant: ' . $e->getMessage());
        
        return back()
            ->with('error', 'Une erreur est survenue lors de la mise à jour du candidat.')
            ->withInput();
    }
}
    /**
     * Remove the specified applicant from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Applicant $candidat)
    {
        try {
            $candidat->delete();
            
            return redirect()
                ->route('admin.candidats.index')
                ->with('success', 'Candidat supprimé avec succès.');
        } catch (\Exception $e) {
            Log::error('Error deleting applicant: ' . $e->getMessage());
            
            return back()
                ->with('error', 'Une erreur est survenue lors de la suppression du candidat.');
        }
    }
}