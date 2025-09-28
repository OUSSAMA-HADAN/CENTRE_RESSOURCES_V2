<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApplicantController extends Controller
{
    /**
     * Display the application form
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.inscription.form');
    }

    /**
     * Process the incoming application form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate form input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:applicants',
            'birth_date' => 'required|date|before:today',
            'birth_place' => 'required|string|max:255',
            'id_card_number' => 'required|string|max:50|unique:applicants',
            'phone_number' => 'required|string|max:20',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'years_of_experience' => 'required|integer|min:0|max:100',
            'education_level' => 'required|string|max:255',
        ], [
            'email.unique' => __('form.validation.email_unique'),
            'id_card_number.unique' => __('form.validation.id_card_unique'),
            'birth_date.before' => __('form.validation.birth_date_past'),
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Create new applicant
            $applicant = Applicant::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'id_card_number' => $request->id_card_number,
                'phone_number' => $request->phone_number,
                'marital_status' => $request->marital_status,
                'years_of_experience' => $request->years_of_experience,
                'education_level' => $request->education_level,
                'status' => 'pending',
                'reference_number' => $this->generateReferenceNumber(),
            ]);

            return back()->with('success', __('form.submission.success', ['reference' => $applicant->reference_number]));
        } catch (\Exception $e) {
            Log::error('Application submission error: ' . $e->getMessage());
            return back()->with('error', __('form.submission.error'))->withInput();
        }
    }

    /**
     * Generate a unique reference number for the application
     *
     * @return string
     */
    private function generateReferenceNumber()
    {
        $prefix = 'APP';
        $timestamp = now()->format('YmdHis');
        $random = rand(1000, 9999);
        
        return $prefix . $timestamp . $random;
    }
}