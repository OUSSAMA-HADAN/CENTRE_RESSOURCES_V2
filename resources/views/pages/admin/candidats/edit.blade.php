@extends('layouts.admin')

@section('title', isset($candidat) ? 'Modifier un candidat' : 'Ajouter un candidat')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($candidat) ? 'Modifier un candidat' : 'Ajouter un candidat' }}</h1>
        <a href="{{ route('admin.candidats.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour à la liste
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations du candidat</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p><i class="fas fa-exclamation-triangle me-2"></i> Veuillez corriger les erreurs suivantes :</p>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="applicationForm" method="POST" action="{{ isset($candidat) ? route('admin.candidats.update', $candidat->id) : route('admin.candidats.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($candidat))
                    @method('PUT')
                @endif
                
                <div class="row g-4">
                    <!-- Informations personnelles -->
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">Informations personnelles</h5>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="first_name" class="form-label">Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                  id="first_name" name="first_name" 
                                  value="{{ $candidat->first_name ?? old('first_name') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="last_name" class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                  id="last_name" name="last_name" 
                                  value="{{ $candidat->last_name ?? old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                  id="email" name="email" 
                                  value="{{ $candidat->email ?? old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="birth_date" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                  id="birth_date" name="birth_date" 
                                  value="{{ isset($candidat) ? $candidat->birth_date->format('Y-m-d') : old('birth_date') }}" required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="birth_place" class="form-label">Lieu de naissance <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('birth_place') is-invalid @enderror" 
                                  id="birth_place" name="birth_place" 
                                  value="{{ $candidat->birth_place ?? old('birth_place') }}" required>
                            @error('birth_place')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="id_card_number" class="form-label">Numéro de carte d'identité <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('id_card_number') is-invalid @enderror" 
                                  id="id_card_number" name="id_card_number" 
                                  value="{{ $candidat->id_card_number ?? old('id_card_number') }}" required>
                            @error('id_card_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone_number" class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                                  id="phone_number" name="phone_number" 
                                  value="{{ $candidat->phone_number ?? old('phone_number') }}" required>
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="marital_status" class="form-label">Situation familiale <span class="text-danger">*</span></label>
                            <select class="form-control @error('marital_status') is-invalid @enderror" 
                                   id="marital_status" name="marital_status" required>
                                <option value="">Sélectionner</option>
                                <option value="single" {{ (isset($candidat) && $candidat->marital_status == 'single') || old('marital_status') == 'single' ? 'selected' : '' }}>Célibataire</option>
                                <option value="married" {{ (isset($candidat) && $candidat->marital_status == 'married') || old('marital_status') == 'married' ? 'selected' : '' }}>Marié(e)</option>
                                <option value="divorced" {{ (isset($candidat) && $candidat->marital_status == 'divorced') || old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorcé(e)</option>
                                <option value="widowed" {{ (isset($candidat) && $candidat->marital_status == 'widowed') || old('marital_status') == 'widowed' ? 'selected' : '' }}>Veuf/Veuve</option>
                            </select>
                            @error('marital_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Informations professionnelles -->
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 mt-4">Informations professionnelles</h5>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="years_of_experience" class="form-label">Années d'expérience <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('years_of_experience') is-invalid @enderror" 
                                  id="years_of_experience" name="years_of_experience" min="0" 
                                  value="{{ $candidat->years_of_experience ?? old('years_of_experience') }}" required>
                            @error('years_of_experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="education_level" class="form-label">Niveau d'éducation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('education_level') is-invalid @enderror" 
                                  id="education_level" name="education_level" 
                                  value="{{ $candidat->education_level ?? old('education_level') }}" required>
                            @error('education_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Statut de la demande</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                   id="status" name="status">
                                <option value="pending" {{ (isset($candidat) && $candidat->status == 'pending') || old('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="approved" {{ (isset($candidat) && $candidat->status == 'approved') || old('status') == 'approved' ? 'selected' : '' }}>Accepté</option>
                                <option value="rejected" {{ (isset($candidat) && $candidat->status == 'rejected') || old('status') == 'rejected' ? 'selected' : '' }}>Refusé</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Notes internes -->
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 mt-4">Notes internes</h5>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="notes" class="form-label">Notes administratives</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="4">{{ $candidat->notes ?? old('notes') }}</textarea>
                            <small class="form-text text-muted">Ces notes sont visibles uniquement par l'administration et ne seront pas partagées avec le candidat.</small>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.candidats.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-times me-1"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-save me-1"></i> {{ isset($candidat) ? 'Mettre à jour' : 'Enregistrer' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        const form = document.getElementById('applicationForm');
        form.addEventListener('submit', function(event) {
            // Enable submit button on form submission
            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Traitement en cours...';
                submitBtn.disabled = true;
            }
        });
    });
</script>
@endsection