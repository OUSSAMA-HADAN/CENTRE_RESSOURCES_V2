@extends('layouts.admin')

@section('title', 'Tableau de Bord')
@section('page-title', 'Tableau de Bord')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Générer un rapport
        </a> --}}
    </div>

    <!-- Top Stats Cards -->
    <div class="row">
        <!-- Candidats Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Candidats</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['applicants']['total'] }}</div>
                            <div class="text-xs text-gray-600 mt-1">{{ $statistics['applicants']['pending'] }} en attente</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Éducatrices Card - NOUVELLE CARTE -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Éducatrices</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['educatrices']['total'] ?? 0 }}</div>
                            <div class="text-xs text-gray-600 mt-1">{{ $statistics['educatrices']['recent'] ?? 0 }} récentes</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Formations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['formations']['total'] }}</div>
                            <div class="text-xs text-gray-600 mt-1">{{ $statistics['formations']['published'] }} publiées</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recherches Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Publications
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['recherches']['total'] }}</div>
                            <div class="text-xs text-gray-600 mt-1">{{ $statistics['recherches']['published'] }} publiées</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Main Content -->
    <div class="row">
        <!-- Left Column - Applicant Stats -->
        <div class="col-lg-6 mb-4">
            <!-- Application Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques des candidatures</h6>
                    <div class="dropdown no-arrow">
                        
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Options:</div>
                            <a class="dropdown-item" href="#">Cette semaine</a>
                            <a class="dropdown-item" href="#">Ce mois</a>
                            <a class="dropdown-item" href="#">Cette année</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="stat-circle bg-primary mx-auto d-flex align-items-center justify-content-center mb-2">
                                        <i class="fas fa-user-plus text-white"></i>
                                    </div>
                                    <h5 class="card-title mb-0">{{ $statistics['applicants']['total'] }}</h5>
                                    <p class="card-text text-muted">Total</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="stat-circle bg-warning mx-auto d-flex align-items-center justify-content-center mb-2">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                    <h5 class="card-title mb-0">{{ $statistics['applicants']['pending'] }}</h5>
                                    <p class="card-text text-muted">En attente</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="stat-circle bg-success mx-auto d-flex align-items-center justify-content-center mb-2">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <h5 class="card-title mb-0">{{ $statistics['applicants']['total'] - $statistics['applicants']['pending'] }}</h5>
                                    <p class="card-text text-muted">Traitées</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('admin.candidats.index') }}" class="btn btn-sm btn-primary">
                            Voir toutes les candidatures
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Content Stats -->
        <div class="col-lg-6 mb-4">
            <!-- NOUVELLE SECTION : Statistiques des Éducatrices -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-danger">Éducatrices des écoles privées</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="stat-circle bg-danger mx-auto d-flex align-items-center justify-content-center mb-2">
                                        <i class="fas fa-chalkboard-teacher text-white"></i>
                                    </div>
                                    <h5 class="card-title mb-0">{{ $statistics['educatrices']['total'] ?? 0 }}</h5>
                                    <p class="card-text text-muted">Total</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="stat-circle bg-info mx-auto d-flex align-items-center justify-content-center mb-2">
                                        <i class="fas fa-calendar-day text-white"></i>
                                    </div>
                                    <h5 class="card-title mb-0">{{ $statistics['educatrices']['recent'] ?? 0 }}</h5>
                                    <p class="card-text text-muted">Ce mois</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="card border-0">
                                <div class="card-body">
                                    <div class="stat-circle bg-secondary mx-auto d-flex align-items-center justify-content-center mb-2">
                                        <i class="fas fa-school text-white"></i>
                                    </div>
                                    <h5 class="card-title mb-0">{{ $statistics['educatrices']['schools'] ?? 0 }}</h5>
                                    <p class="card-text text-muted">Écoles</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('admin.educatrices.index') }}" class="btn btn-sm btn-danger">
                            Gérer les éducatrices
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Content Stats -->
        <div class="col-lg-6 mb-4">
            <!-- Content Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Contenu par type</h6>
                    <div class="dropdown no-arrow">
                        
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownContentLink">
                            <div class="dropdown-header">Filtrer par:</div>
                            <a class="dropdown-item" href="#">Récemment ajouté</a>
                            <a class="dropdown-item" href="#">Plus populaire</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="content-type-card mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="font-weight-bold text-primary">Formations</h6>
                            <span class="badge bg-light text-dark">{{ $statistics['formations']['total'] }}</span>
                        </div>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                style="width: {{ ($statistics['formations']['published'] / max($statistics['formations']['total'], 1)) * 100 }}%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{ $statistics['formations']['published'] }} publiées</small>
                            <small class="text-muted">{{ $statistics['formations']['total'] - $statistics['formations']['published'] }} brouillons</small>
                        </div>
                    </div>
                    
                    <div class="content-type-card mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="font-weight-bold text-success">Publications</h6>
                            <span class="badge bg-light text-dark">{{ $statistics['recherches']['total'] }}</span>
                        </div>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                style="width: {{ ($statistics['recherches']['published'] / max($statistics['recherches']['total'], 1)) * 100 }}%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{ $statistics['recherches']['published'] }} publiées</small>
                            <small class="text-muted">{{ $statistics['recherches']['total'] - $statistics['recherches']['published'] }} brouillons</small>
                        </div>
                    </div>
                    
                    <div class="content-type-card">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="font-weight-bold text-info">Ressources</h6>
                            <span class="badge bg-light text-dark">{{ $statistics['resources']['total'] }}</span>
                        </div>
                        <div class="progress mb-2" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" 
                                style="width: {{ ($statistics['resources']['published'] / max($statistics['resources']['total'], 1)) * 100 }}%"></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">{{ $statistics['resources']['published'] }} publiées</small>
                            <small class="text-muted">{{ $statistics['resources']['total'] - $statistics['resources']['published'] }} brouillons</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column -->
        <div class="col-lg-6 mb-4">
            <!-- Recent Activity -->
            
        </div>
    </div>

    <!-- Recent Applications and Educatrices Tables -->
    <div class="row">
        <!-- Recent Applications Table -->
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Candidatures récentes</h6>
                    <div>
                        <a href="{{ route('admin.candidats.index', ['status' => 'pending']) }}" class="btn btn-sm btn-warning me-2">
                            En attente ({{ $statistics['applicants']['pending'] }})
                        </a>
                        <a href="{{ route('admin.candidats.index') }}" class="btn btn-sm btn-primary">
                            Voir tout
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentApplicants as $applicant)
                                <tr>
                                    <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                                    <td>{{ $applicant->email }}</td>
                                    <td>{{ $applicant->phone_number }}</td>
                                    <td>{{ $applicant->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($applicant->status == 'pending')
                                            <span class="badge bg-warning text-dark">En attente</span>
                                        @elseif($applicant->status == 'approved')
                                            <span class="badge bg-success">Accepté</span>
                                        @elseif($applicant->status == 'rejected')
                                            <span class="badge bg-danger">Refusé</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.candidats.show', $applicant) }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.candidats.edit', $applicant) }}" class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucune candidature récente</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- NOUVELLE SECTION : Éducatrices récentes -->
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger">Éducatrices récentes</h6>
                    <a href="{{ route('admin.educatrices.index') }}" class="btn btn-sm btn-danger">
                        Voir tout
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Établissement</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEducatrices ?? [] as $educatrice)
                                <tr>
                                    <td>{{ $educatrice->prenom_fr }} {{ $educatrice->nom_fr }}</td>
                                    <td>{{ Str::limit($educatrice->etablissement, 20) }}</td>
                                    <td>{{ $educatrice->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.educatrices.show', $educatrice) }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.educatrices.edit', $educatrice) }}" class="btn btn-primary btn-circle btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Aucune éducatrice récente</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.stat-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.progress {
    height: 8px;
    border-radius: 4px;
}

.content-type-card {
    padding: 15px;
    border-radius: 8px;
    background-color: #f8f9fc;
}

.activity-icon {
    min-width: 40px;
}

.referral-item {
    padding: 10px 15px;
    border-radius: 5px;
    background-color: #f8f9fc;
}

.referral-item:hover {
    background-color: #eaecf4;
}

.list-group-item:hover {
    background-color: #f8f9fc;
}
</style>
@endpush