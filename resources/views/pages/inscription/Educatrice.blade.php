@extends('layouts.app')

@section('content')
<div class="container py-5" style="margin-top: 80px;"> <!-- Ajout du margin-top pour éviter le chevauchement avec la navbar fixe -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header text-center py-4 bg-light border-0">
                    <h2 class="mb-0" style="color: #10b981;">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Inscription des Éducatrices
                    </h2>
                    <p class="text-muted mb-0">Formation dédiée aux éducatrices des écoles privées</p>
                </div>
                
                <div class="card-body p-md-5 p-3">
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle fa-2x me-3" style="color: #10b981;"></i>
                                <div>
                                    <h5 class="alert-heading mb-1">Inscription réussie !</h5>
                                    <p class="mb-0">{{ session('success') }}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inscription.educatrice.store') }}">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h4 class="form-section-title">
                                    <i class="fas fa-user me-2" style="color: #f7a223;"></i>Informations Personnelles
                                </h4>
                                <hr>
                            </div>
                            
                            <!-- Nom en français -->
                            <div class="col-md-6 mb-3">
                                <label for="nom_fr" class="form-label fw-bold">Nom (en français) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('nom_fr') is-invalid @enderror" 
                                       id="nom_fr" name="nom_fr" value="{{ old('nom_fr') }}" required>
                                @error('nom_fr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Prénom en français -->
                            <div class="col-md-6 mb-3">
                                <label for="prenom_fr" class="form-label fw-bold">Prénom (en français) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('prenom_fr') is-invalid @enderror" 
                                       id="prenom_fr" name="prenom_fr" value="{{ old('prenom_fr') }}" required>
                                @error('prenom_fr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Nom en arabe -->
                            <div class="col-md-6 mb-3">
                                <label for="nom_ar" class="form-label fw-bold">الإسم العائلي</label>
                                <input type="text" class="form-control form-control-lg text-end @error('nom_ar') is-invalid @enderror" 
                                       id="nom_ar" name="nom_ar" value="{{ old('nom_ar') }}" dir="rtl">
                                @error('nom_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Prénom en arabe -->
                            <div class="col-md-6 mb-3">
                                <label for="prenom_ar" class="form-label fw-bold">الإسم الشخصي</label>
                                <input type="text" class="form-control form-control-lg text-end @error('prenom_ar') is-invalid @enderror" 
                                       id="prenom_ar" name="prenom_ar" value="{{ old('prenom_ar') }}" dir="rtl">
                                @error('prenom_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- CIN -->
                            <div class="col-md-6 mb-3">
                                <label for="cin" class="form-label fw-bold">Numéro CIN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('cin') is-invalid @enderror" 
                                       id="cin" name="cin" value="{{ old('cin') }}" required>
                                @error('cin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Téléphone -->
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label fw-bold">Téléphone</label>
                                <input type="tel" class="form-control form-control-lg @error('telephone') is-invalid @enderror" 
                                       id="telephone" name="telephone" value="{{ old('telephone') }}">
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Adresse -->
                            
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <h4 class="form-section-title">
                                    <i class="fas fa-school me-2" style="color: #f7a223;"></i>Informations Professionnelles
                                </h4>
                                <hr>
                            </div>
                            
                            <!-- Établissement -->
                            <div class="col-md-12 mb-3">
                                <label for="etablissement" class="form-label fw-bold">Établissement <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('etablissement') is-invalid @enderror" 
                                       id="etablissement" name="etablissement" value="{{ old('etablissement') }}" required>
                                @error('etablissement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Niveau scolaire -->
                            <div class="col-md-6 mb-3">
                                <label for="niveau_scolaire" class="form-label fw-bold">Niveau scolaire <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('niveau_scolaire') is-invalid @enderror" 
                                       id="niveau_scolaire" name="niveau_scolaire" value="{{ old('niveau_scolaire') }}" required>
                                @error('niveau_scolaire')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Années d'expérience -->
                            <div class="col-md-6 mb-3">
                                <label for="annees_experience" class="form-label fw-bold">Années d'expérience <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-lg @error('annees_experience') is-invalid @enderror" 
                                       id="annees_experience" name="annees_experience" value="{{ old('annees_experience') }}" min="0" required>
                                @error('annees_experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-lg px-5 py-3" style="background-color: #f7a223; color: white; border-radius: 10px;">
                                <i class="fas fa-paper-plane me-2"></i>Soumettre ma candidature
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-section-title {
        color: #333;
        font-size: 1.25rem;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
    }
    
    .btn {
        transition: all 0.3s ease;
        font-weight: 600;
    }
    
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        background-color: #e89417 !important;
    }
    
    .alert-success {
        background-color: rgba(16, 185, 129, 0.1);
        border-color: rgba(16, 185, 129, 0.2);
        color: #0f8a60;
        border-radius: 8px;
        padding: 1.25rem;
    }
    
    /* Animation pour le message de succès */
    .alert-success {
        animation: fadeInDown 0.5s ease-in-out;
    }
    
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- Script pour faire disparaître le message de succès après un certain temps -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Faire disparaître le message de succès après 8 secondes
        const alertSuccess = document.querySelector('.alert-success');
        if (alertSuccess) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alertSuccess);
                bsAlert.close();
            }, 8000);
        }
    });
</script>
@endsection