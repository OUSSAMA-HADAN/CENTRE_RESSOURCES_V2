@extends('layouts.admin')

@section('title', 'Modifier l\'éducatrice')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-edit me-2"></i>Modifier l'éducatrice
        </h1>
        <a href="{{ route('admin.educatrices.show', $educatrice) }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm me-1"></i> Retour
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-edit me-2"></i>Formulaire de modification
            </h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation</h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.educatrices.update', $educatrice) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Section: Informations Personnelles -->
                <div class="row mb-4">
                    <div class="col-12 mb-3">
                        <h5 class="text-primary border-bottom pb-2">
                            <i class="fas fa-user me-2"></i>Informations Personnelles
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nom_fr" class="form-label fw-bold">
                            Nom (Français) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nom_fr') is-invalid @enderror" 
                               id="nom_fr" 
                               name="nom_fr" 
                               value="{{ old('nom_fr', $educatrice->nom_fr) }}" 
                               required>
                        @error('nom_fr')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="prenom_fr" class="form-label fw-bold">
                            Prénom (Français) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('prenom_fr') is-invalid @enderror" 
                               id="prenom_fr" 
                               name="prenom_fr" 
                               value="{{ old('prenom_fr', $educatrice->prenom_fr) }}" 
                               required>
                        @error('prenom_fr')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nom_ar" class="form-label fw-bold">الإسم العائلي</label>
                        <input type="text" 
                               class="form-control text-end @error('nom_ar') is-invalid @enderror" 
                               id="nom_ar" 
                               name="nom_ar" 
                               value="{{ old('nom_ar', $educatrice->nom_ar) }}" 
                               dir="rtl">
                        @error('nom_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="prenom_ar" class="form-label fw-bold">الإسم الشخصي</label>
                        <input type="text" 
                               class="form-control text-end @error('prenom_ar') is-invalid @enderror" 
                               id="prenom_ar" 
                               name="prenom_ar" 
                               value="{{ old('prenom_ar', $educatrice->prenom_ar) }}" 
                               dir="rtl">
                        @error('prenom_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="cin" class="form-label fw-bold">
                            CIN <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('cin') is-invalid @enderror" 
                               id="cin" 
                               name="cin" 
                               value="{{ old('cin', $educatrice->cin) }}" 
                               required>
                        @error('cin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="date_naissance" class="form-label fw-bold">Date de naissance</label>
                        <input type="date" 
                               class="form-control @error('date_naissance') is-invalid @enderror" 
                               id="date_naissance" 
                               name="date_naissance" 
                               value="{{ old('date_naissance', $educatrice->date_naissance ? $educatrice->date_naissance->format('Y-m-d') : '') }}">
                        @error('date_naissance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $educatrice->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telephone" class="form-label fw-bold">Téléphone</label>
                        <input type="tel" 
                               class="form-control @error('telephone') is-invalid @enderror" 
                               id="telephone" 
                               name="telephone" 
                               value="{{ old('telephone', $educatrice->telephone) }}">
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Section: Informations Professionnelles -->
                <div class="row mb-4">
                    <div class="col-12 mb-3">
                        <h5 class="text-primary border-bottom pb-2">
                            <i class="fas fa-school me-2"></i>Informations Professionnelles
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="etablissement" class="form-label fw-bold">
                            Établissement <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('etablissement') is-invalid @enderror" 
                               id="etablissement" 
                               name="etablissement" 
                               value="{{ old('etablissement', $educatrice->etablissement) }}" 
                               required>
                        @error('etablissement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="type_etablissement" class="form-label fw-bold">
                            Type d'établissement <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('type_etablissement') is-invalid @enderror" 
                                id="type_etablissement" 
                                name="type_etablissement" 
                                required>
                            <option value="">Sélectionner...</option>
                            <option value="private" {{ old('type_etablissement', $educatrice->type_etablissement) == 'private' ? 'selected' : '' }}>
                                Privé
                            </option>
                            <option value="public" {{ old('type_etablissement', $educatrice->type_etablissement) == 'public' ? 'selected' : '' }}>
                                Public
                            </option>
                        </select>
                        @error('type_etablissement')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="niveau_scolaire" class="form-label fw-bold">
                            Niveau scolaire <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('niveau_scolaire') is-invalid @enderror" 
                               id="niveau_scolaire" 
                               name="niveau_scolaire" 
                               value="{{ old('niveau_scolaire', $educatrice->niveau_scolaire) }}" 
                               required>
                        @error('niveau_scolaire')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="annees_experience" class="form-label fw-bold">
                            Années d'expérience <span class="text-danger">*</span>
                        </label>
                        <input type="number" 
                               class="form-control @error('annees_experience') is-invalid @enderror" 
                               id="annees_experience" 
                               name="annees_experience" 
                               value="{{ old('annees_experience', $educatrice->annees_experience) }}" 
                               min="0" 
                               required>
                        @error('annees_experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="status" class="form-label fw-bold">
                            Statut <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" 
                                name="status" 
                                required>
                            <option value="pending" {{ old('status', $educatrice->status) == 'pending' ? 'selected' : '' }}>
                                En attente
                            </option>
                            <option value="approved" {{ old('status', $educatrice->status) == 'approved' ? 'selected' : '' }}>
                                Approuvé
                            </option>
                            <option value="rejected" {{ old('status', $educatrice->status) == 'rejected' ? 'selected' : '' }}>
                                Rejeté
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-12">
                        <hr class="my-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.educatrices.show', $educatrice) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-label {
    font-size: 0.9rem;
    color: #5a5c69;
}

.form-control:focus,
.form-select:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
}

.text-danger {
    font-weight: bold;
}
</style>
@endsection