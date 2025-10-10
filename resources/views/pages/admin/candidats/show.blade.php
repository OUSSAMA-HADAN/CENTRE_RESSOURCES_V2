@extends('layouts.admin')

@section('title', 'Détails de l\'éducatrice')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-circle me-2"></i>Détails de l'éducatrice
        </h1>
        <div>
            <a href="{{ route('admin.educatrices.index') }}" class="btn btn-sm btn-secondary shadow-sm me-2">
                <i class="fas fa-arrow-left fa-sm me-1"></i> Retour
            </a>
            <a href="{{ route('admin.educatrices.edit', $educatrice) }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-edit fa-sm me-1"></i> Modifier
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Information Card -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle me-2"></i>Informations Personnelles
                    </h6>
                    @php
                        $statusBadge = [
                            'pending' => ['class' => 'warning', 'icon' => 'clock', 'text' => 'En attente'],
                            'approved' => ['class' => 'success', 'icon' => 'check-circle', 'text' => 'Approuvé'],
                            'rejected' => ['class' => 'danger', 'icon' => 'times-circle', 'text' => 'Rejeté']
                        ];
                        $status = $statusBadge[$educatrice->status] ?? $statusBadge['pending'];
                    @endphp
                    <span class="badge bg-{{ $status['class'] }}">
                        <i class="fas fa-{{ $status['icon'] }} me-1"></i>{{ $status['text'] }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-user me-1"></i>Nom complet (Français)
                                </label>
                                <p class="fw-bold mb-0">{{ $educatrice->prenom_fr }} {{ $educatrice->nom_fr }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-user me-1"></i>الاسم الكامل (Arabe)
                                </label>
                                <p class="fw-bold mb-0" dir="rtl">{{ $educatrice->prenom_ar }} {{ $educatrice->nom_ar }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-id-card me-1"></i>CIN
                                </label>
                                <p class="fw-bold mb-0">{{ $educatrice->cin }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-calendar me-1"></i>Date de naissance / Âge
                                </label>
                                <p class="fw-bold mb-0">
                                    {{ $educatrice->date_naissance ? $educatrice->date_naissance->format('d/m/Y') : 'Non renseignée' }}
                                    @if($educatrice->age)
                                        <span class="text-muted">({{ $educatrice->age }} ans)</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-envelope me-1"></i>Email
                                </label>
                                <p class="fw-bold mb-0">
                                    @if($educatrice->email)
                                        <a href="mailto:{{ $educatrice->email }}">{{ $educatrice->email }}</a>
                                    @else
                                        <span class="text-muted">Non renseigné</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-phone me-1"></i>Téléphone
                                </label>
                                <p class="fw-bold mb-0">
                                    @if($educatrice->telephone)
                                        <a href="tel:{{ $educatrice->telephone }}">{{ $educatrice->telephone }}</a>
                                    @else
                                        <span class="text-muted">Non renseigné</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-school me-2"></i>Informations Professionnelles
                    </h6>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-building me-1"></i>Établissement
                                </label>
                                <p class="fw-bold mb-0">{{ $educatrice->etablissement }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-landmark me-1"></i>Type d'établissement
                                </label>
                                <p class="fw-bold mb-0">
                                    @if($educatrice->type_etablissement == 'private')
                                        <span class="badge bg-info">Privé</span>
                                    @else
                                        <span class="badge bg-secondary">Public</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-graduation-cap me-1"></i>Niveau scolaire
                                </label>
                                <p class="fw-bold mb-0">{{ $educatrice->niveau_scolaire }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="text-muted small mb-1">
                                    <i class="fas fa-briefcase me-1"></i>Années d'expérience
                                </label>
                                <p class="fw-bold mb-0">{{ $educatrice->annees_experience }} ans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status Update Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-toggle-on me-2"></i>Gestion du Statut
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.educatrices.update-status', $educatrice) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Statut actuel</label>
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $educatrice->status == 'pending' ? 'selected' : '' }}>
                                    En attente
                                </option>
                                <option value="approved" {{ $educatrice->status == 'approved' ? 'selected' : '' }}>
                                    Approuvé
                                </option>
                                <option value="rejected" {{ $educatrice->status == 'rejected' ? 'selected' : '' }}>
                                    Rejeté
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>Mettre à jour le statut
                        </button>
                    </form>
                </div>
            </div>

            <!-- Metadata Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info me-2"></i>Métadonnées
                    </h6>
                </div>
                <div class="card-body">
                    <div class="info-item mb-3">
                        <label class="text-muted small mb-1">
                            <i class="fas fa-calendar-plus me-1"></i>Date d'inscription
                        </label>
                        <p class="mb-0">{{ $educatrice->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    
                    <div class="info-item mb-3">
                        <label class="text-muted small mb-1">
                            <i class="fas fa-clock me-1"></i>Dernière modification
                        </label>
                        <p class="mb-0">{{ $educatrice->updated_at->format('d/m/Y à H:i') }}</p>
                    </div>

                    <div class="info-item">
                        <label class="text-muted small mb-1">
                            <i class="fas fa-hashtag me-1"></i>ID
                        </label>
                        <p class="mb-0">{{ $educatrice->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cogs me-2"></i>Actions
                    </h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.educatrices.edit', $educatrice) }}" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                    
                    <form action="{{ route('admin.educatrices.destroy', $educatrice) }}" method="POST" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette éducatrice ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-item {
    padding: 10px;
    border-radius: 5px;
    background-color: #f8f9fc;
}

.info-item label {
    font-weight: 600;
    margin-bottom: 0.25rem;
}
</style>
@endsection