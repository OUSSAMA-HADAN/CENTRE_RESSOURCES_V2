@extends('layouts.admin')

@section('title', 'Modifier l\'éducatrice')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Modifier l'éducatrice</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.educatrices.index') }}">Éducatrices</a></li>
        <li class="breadcrumb-item active">Modifier</li>
    </ol>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Formulaire de modification
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.educatrices.update', $educatrice) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h5 class="border-bottom pb-2">
                                    <i class="fas fa-user me-2 text-primary"></i>Informations Personnelles
                                </h5>
                            </div>
                            
                            <!-- Nom en français -->
                            <div class="col-md-6 mb-3">
                                <label for="nom_fr" class="form-label">Nom (en français) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nom_fr') is-invalid @enderror" 
                                       id="nom_fr" name="nom_fr" value="{{ old('nom_fr', $educatrice->nom_fr) }}" required>
                                @error('nom_fr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Prénom en français -->
                            <div class="col-md-6 mb-3">
                                <label for="prenom_fr" class="form-label">Prénom (en français) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('prenom_fr') is-invalid @enderror" 
                                       id="prenom_fr" name="prenom_fr" value="{{ old('prenom_fr', $educatrice->prenom_fr) }}" required>
                                @error('prenom_fr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Nom en arabe -->
                            <div class="col-md-6 mb-3">
                                <label for="nom_ar" class="form-label">Nom (en arabe)</label>
                                <input type="text" class="form-control text-end @error('nom_ar') is-invalid @enderror" 
                                       id="nom_ar" name="nom_ar" value="{{ old('nom_ar', $educatrice->nom_ar) }}" dir="rtl">
                                @error('nom_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Prénom en arabe -->
                            <div class="col-md-6 mb-3">
                                <label for="prenom_ar" class="form-label">Prénom (en arabe)</label>
                                <input type="text" class="form-control text-end @error('prenom_ar') is-invalid @enderror" 
                                       id="prenom_ar" name="prenom_ar" value="{{ old('prenom_ar', $educatrice->prenom_ar) }}" dir="rtl">
                                @error('prenom_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- CIN -->
                            <div class="col-md-6 mb-3">
                                <label for="cin" class="form-label">Numéro CIN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('cin') is-invalid @enderror" 
                                       id="cin" name="cin" value="{{ old('cin', $educatrice->cin) }}" required>
                                @error('cin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $educatrice->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Téléphone -->
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control @error('telephone') is-invalid @enderror" 
                                       id="telephone" name="telephone" value="{{ old('telephone', $educatrice->telephone) }}">
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Adresse -->
                            <div class="col-md-6 mb-3">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control @error('adresse') is-invalid @enderror" 
                                       id="adresse" name="adresse" value="{{ old('adresse', $educatrice->adresse) }}">
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h5 class="border-bottom pb-2">
                                    <i class="fas fa-school me-2 text-primary"></i>Informations Professionnelles
                                </h5>
                            </div>
                            
                            <!-- Établissement -->
                            <div class="col-md-12 mb-3">
                                <label for="etablissement" class="form-label">Établissement <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('etablissement') is-invalid @enderror" 
                                       id="etablissement" name="etablissement" value="{{ old('etablissement', $educatrice->etablissement) }}" required>
                                @error('etablissement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Niveau scolaire -->
                            <div class="col-md-6 mb-3">
                                <label for="niveau_scolaire" class="form-label">Niveau scolaire <span class="text-danger">*</span></label>
                                <select class="form-select @error('niveau_scolaire') is-invalid @enderror" 
                                        id="niveau_scolaire" name="niveau_scolaire" required>
                                    <option value="" disabled>Sélectionnez un niveau</option>
                                    <option value="Baccalauréat" {{ old('niveau_scolaire', $educatrice->niveau_scolaire) == 'Baccalauréat' ? 'selected' : '' }}>Baccalauréat</option>
                                    <option value="Bac+2" {{ old('niveau_scolaire', $educatrice->niveau_scolaire) == 'Bac+2' ? 'selected' : '' }}>Bac+2</option>
                                    <option value="Licence" {{ old('niveau_scolaire', $educatrice->niveau_scolaire) == 'Licence' ? 'selected' : '' }}>Licence</option>
                                    <option value="Master" {{ old('niveau_scolaire', $educatrice->niveau_scolaire) == 'Master' ? 'selected' : '' }}>Master</option>
                                    <option value="Doctorat" {{ old('niveau_scolaire', $educatrice->niveau_scolaire) == 'Doctorat' ? 'selected' : '' }}>Doctorat</option>
                                    <option value="Autre" {{ old('niveau_scolaire', $educatrice->niveau_scolaire) == 'Autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('niveau_scolaire')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Années d'expérience -->
                            <div class="col-md-6 mb-3">
                                <label for="annees_experience" class="form-label">Années d'expérience <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('annees_experience') is-invalid @enderror" 
                                       id="annees_experience" name="annees_experience" value="{{ old('annees_experience', $educatrice->annees_experience) }}" min="0" required>
                                @error('annees_experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.educatrices.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection