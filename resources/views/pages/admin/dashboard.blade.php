@extends('layouts.admin')

@section('title', 'Tableau de Bord')
@section('page-title', 'Tableau de Bord')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
        <a href="{{ route('admin.candidats.export-excel') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Générer Rapport
        </a>
    </div>

    <!-- Content Row - Statistics Cards -->
    <div class="row">
        <!-- Total Candidats Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Candidats</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['applicants']['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- En Attente Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                En Attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['applicants']['pending'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
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
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Publications Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Publications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statistics['recherches']['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Statistics -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques du Contenu</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Formations <span class="float-right">{{ $statistics['formations']['published'] }} / {{ $statistics['formations']['total'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $statistics['formations']['total'] > 0 ? ($statistics['formations']['published'] / $statistics['formations']['total']) * 100 : 0 }}%"
                            aria-valuenow="{{ $statistics['formations']['published'] }}" aria-valuemin="0" aria-valuemax="{{ $statistics['formations']['total'] }}"></div>
                    </div>
                    
                    <h4 class="small font-weight-bold">Publications <span class="float-right">{{ $statistics['recherches']['published'] }} / {{ $statistics['recherches']['total'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $statistics['recherches']['total'] > 0 ? ($statistics['recherches']['published'] / $statistics['recherches']['total']) * 100 : 0 }}%"
                            aria-valuenow="{{ $statistics['recherches']['published'] }}" aria-valuemin="0" aria-valuemax="{{ $statistics['recherches']['total'] }}"></div>
                    </div>
                    
                    <h4 class="small font-weight-bold">Ressources <span class="float-right">{{ $statistics['resources']['published'] }} / {{ $statistics['resources']['total'] }}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $statistics['resources']['total'] > 0 ? ($statistics['resources']['published'] / $statistics['resources']['total']) * 100 : 0 }}%"
                            aria-valuenow="{{ $statistics['resources']['published'] }}" aria-valuemin="0" aria-valuemax="{{ $statistics['resources']['total'] }}"></div>
                    </div>
                    
                    <h4 class="small font-weight-bold">Éducatrices <span class="float-right">{{ $statistics['educatrices']['total'] ?? 0 }}</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                            aria-valuenow="{{ $statistics['educatrices']['total'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Cards -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <div class="font-weight-bold">Formations Publiées</div>
                            <div class="h5 mb-0">{{ $statistics['formations']['published'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            <div class="font-weight-bold">Publications</div>
                            <div class="h5 mb-0">{{ $statistics['recherches']['published'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            <div class="font-weight-bold">Ressources</div>
                            <div class="h5 mb-0">{{ $statistics['resources']['published'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            <div class="font-weight-bold">En Attente</div>
                            <div class="h5 mb-0">{{ $statistics['applicants']['pending'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Rapides -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Actions Rapides</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.formations.create') }}" class="btn btn-success btn-icon-split btn-lg mb-3 w-100">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Nouvelle Formation</span>
                    </a>
                    
                    <a href="{{ route('admin.recherche.create') }}" class="btn btn-info btn-icon-split btn-lg mb-3 w-100">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Nouvelle Publication</span>
                    </a>
                    
                    <a href="{{ route('admin.documentation.resources.create') }}" class="btn btn-primary btn-icon-split btn-lg mb-3 w-100">
                        <span class="icon text-white-50">
                            <i class="fas fa-folder-plus"></i>
                        </span>
                        <span class="text">Nouvelle Ressource</span>
                    </a>
                    
                    <a href="{{ route('admin.candidats.index', ['statut' => 'pending']) }}" class="btn btn-warning btn-icon-split btn-lg w-100">
                        <span class="icon text-white-50">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <span class="text">{{ $statistics['applicants']['pending'] }} Candidatures en Attente</span>
                    </a>
                </div>
            </div>

            <!-- Statistiques Éducatrices -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Éducatrices</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $statistics['educatrices']['total'] ?? 0 }}</div>
                            <div class="text-xs text-uppercase text-muted">Total</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $statistics['educatrices']['recent'] ?? 0 }}</div>
                            <div class="text-xs text-uppercase text-muted">Ce Mois</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="h2 mb-0 font-weight-bold text-gray-800">{{ $statistics['educatrices']['schools'] ?? 0 }}</div>
                            <div class="text-xs text-uppercase text-muted">Établissements</div>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('admin.educatrices.index') }}" class="btn btn-danger btn-block">
                        <i class="fas fa-list mr-2"></i>Voir toutes les éducatrices
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables - Candidatures Récentes -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Candidatures Récentes</h6>
            <a href="{{ route('admin.candidats.index') }}" class="btn btn-sm btn-primary">
                Voir tout
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
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
                            <td>{{ $applicant->nom_fr ?? $applicant->first_name ?? 'N/A' }}</td>
                            <td>{{ $applicant->prenom_fr ?? $applicant->last_name ?? 'N/A' }}</td>
                            <td>{{ $applicant->email ?? 'N/A' }}</td>
                            <td>{{ $applicant->telephone ?? $applicant->phone_number ?? 'N/A' }}</td>
                            <td>{{ $applicant->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if($applicant->status == 'pending')
                                    <span class="badge badge-warning text-black">En attente</span>
                                @elseif($applicant->status == 'approved')
                                    <span class="badge badge-success text-black">Accepté</span>
                                @else
                                    <span class="badge badge-danger text-black">Refusé</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.candidats.show', $applicant->id) }}" class="btn btn-info btn-circle btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.candidats.edit', $applicant->id) }}" class="btn btn-primary btn-circle btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                                <p class="text-muted mb-0">Aucune candidature récente</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Éducatrices Récentes -->
    @if(isset($recentEducatrices) && count($recentEducatrices) > 0)
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-danger">Éducatrices Récentes</h6>
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
                            <th>Prénom</th>
                            <th>Établissement</th>
                            <th>Type</th>
                            <th>Date d'inscription</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentEducatrices as $educatrice)
                        <tr>
                            <td>{{ $educatrice->nom_fr }}</td>
                            <td>{{ $educatrice->prenom_fr }}</td>
                            <td>{{ $educatrice->etablissement }}</td>
                            <td>
                                @if($educatrice->type_etablissement == 'private')
                                    <span class="badge badge-primary text-black">Privé</span>
                                @else
                                    <span class="badge badge-secondary text-black">Public</span>
                                @endif
                            </td>
                            <td>{{ $educatrice->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.border-left-danger {
    border-left: 0.25rem solid #e74a3b !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.btn-circle {
    border-radius: 100%;
    width: 2rem;
    height: 2rem;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-icon-split {
    display: inline-flex;
    overflow: hidden;
}

.btn-icon-split .icon {
    background: rgba(0, 0, 0, 0.15);
    padding: 0.5rem 0.75rem;
    display: flex;
    align-items: center;
}

.btn-icon-split .text {
    padding: 0.5rem 1rem;
    display: flex;
    align-items: center;
}
</style>
@endpush