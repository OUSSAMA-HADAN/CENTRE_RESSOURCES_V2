@extends('layouts.admin')

@section('title', 'Gestion des Candidats')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestion des Candidats</h1>
        <a href="{{route('inscription.form')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Ajouter un candidat
        </a>
    </div>

    <!-- Filters and Search -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filtres de recherche</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.candidats.index') }}" method="GET" class="row g-3">
                <div class="col-md-3 mb-3">
                    <label for="search" class="form-label">Recherche</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Nom, prénom, email..." value="{{ request('search') }}">
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-control" id="statut" name="statut">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="accepte" {{ request('statut') == 'accepte' ? 'selected' : '' }}>Accepté</option>
                        <option value="refuse" {{ request('statut') == 'refuse' ? 'selected' : '' }}>Refusé</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date" class="form-label">Date d'inscription</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filtrer
                    </button>
                    <a href="{{ route('admin.candidats.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Candidates List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Liste des candidats</h6>
           
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="candidatsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom complet</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Etablissement</th>
                            <th>Niveau d'éducation</th>
                            <th>Statut</th>
                            <th>Date d'inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($candidats ?? [] as $candidat)
                        <tr>
                            <td>{{ $candidat->id }}</td>
                            <td>{{ $candidat->first_name }} {{ $candidat->last_name }}</td>
                            <td>{{ $candidat->email }}</td>
                            <td>{{ $candidat->phone_number }}</td>
                            <td>{{ $candidat->etablissement }}</td>
                            <td>{{ $candidat->education_level }}</td>
                            <td>
                                @switch($candidat->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">En attente</span>
                                        @break
                                    @case('approved')
                                        <span class="badge bg-success">Accepté</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">Refusé</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">Non défini</span>
                                @endswitch
                            </td>
                            <td>{{ $candidat->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.candidats.show', $candidat->id) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.candidats.edit', $candidat->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger delete-btn" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#deleteModal" 
                                           data-id="{{ $candidat->id }}"
                                           data-name="{{ $candidat->first_name }} {{ $candidat->last_name }}"
                                           title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Aucun candidat trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!--Pagination -->
            @if(isset($candidats) && $candidats->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $candidats->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer le candidat <strong id="candidat-name"></strong> ?</p>
                <p class="text-danger">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="delete-form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Handle delete modal
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                
                const candidatName = deleteModal.querySelector('#candidat-name');
                const deleteForm = deleteModal.querySelector('#delete-form');
                
                candidatName.textContent = name;
                deleteForm.action = `/admin/candidats/${id}`;
            });
        }
    });
</script>
@endsection