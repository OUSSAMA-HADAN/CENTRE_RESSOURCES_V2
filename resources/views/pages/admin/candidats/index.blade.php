@extends('layouts.admin')

@section('title', 'Gestion des Candidats')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Gestion des Candidats</h1>
            <p class="text-muted mb-0">Total: {{ $educatrices->total() }} candidat(s)</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.educatrices.export-excel', request()->all()) }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-file-excel fa-sm text-white-50"></i> Exporter Excel
            </a>
            <a href="{{route('inscription.form')}}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Ajouter un candidat
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">En attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Acceptés</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['approved'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Refusés</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['rejected'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $educatrices->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Filters and Search -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter"></i> Filtres de recherche
            </h6>
            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="filterCollapse">
            <div class="card-body">
                <form action="{{ route('admin.candidats.index') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <!-- Search Bar -->
                        <div class="col-md-4 mb-3">
                            <label for="search" class="form-label">
                                <i class="fas fa-search"></i> Recherche globale
                            </label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   placeholder="Nom, prénom, email, téléphone..." 
                                   value="{{ request('search') }}">
                        </div>
                        
                        <!-- Status Filter -->
                        <div class="col-md-3 mb-3">
                            <label for="statut" class="form-label">
                                <i class="fas fa-flag"></i> Statut
                            </label>
                            <select class="form-control" id="statut" name="statut">
                                <option value="">Tous les statuts</option>
                                <option value="pending" {{ request('statut') == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="approved" {{ request('statut') == 'approved' ? 'selected' : '' }}>Accepté</option>
                                <option value="rejected" {{ request('statut') == 'rejected' ? 'selected' : '' }}>Refusé</option>
                            </select>
                        </div>

                        <!-- Institution Type Filter -->
                        <div class="col-md-3 mb-3">
                            <label for="type_etablissement" class="form-label">
                                <i class="fas fa-building"></i> Type d'établissement
                            </label>
                            <select class="form-control" id="type_etablissement" name="type_etablissement">
                                <option value="">Tous les types</option>
                                <option value="public" {{ request('type_etablissement') == 'public' ? 'selected' : '' }}>Public</option>
                                <option value="prive" {{ request('type_etablissement') == 'prive' ? 'selected' : '' }}>Privé</option>
                                <option value="association" {{ request('type_etablissement') == 'association' ? 'selected' : '' }}>Association</option>
                            </select>
                        </div>

                        <!-- Education Level Filter -->
                        <div class="col-md-2 mb-3">
                            <label for="niveau_scolaire" class="form-label">
                                <i class="fas fa-graduation-cap"></i> Niveau
                            </label>
                            <select class="form-control" id="niveau_scolaire" name="niveau_scolaire">
                                <option value="">Tous les niveaux</option>
                                <option value="primaire" {{ request('niveau_scolaire') == 'primaire' ? 'selected' : '' }}>Primaire</option>
                                <option value="college" {{ request('niveau_scolaire') == 'college' ? 'selected' : '' }}>Collège</option>
                                <option value="lycee" {{ request('niveau_scolaire') == 'lycee' ? 'selected' : '' }}>Lycée</option>
                                <option value="universitaire" {{ request('niveau_scolaire') == 'universitaire' ? 'selected' : '' }}>Universitaire</option>
                            </select>
                        </div>

                        <!-- Age Range Filter -->
                        <div class="col-md-3 mb-3">
                            <label for="age_min" class="form-label">
                                <i class="fas fa-birthday-cake"></i> Tranche d'âge
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="age_min" name="age_min" 
                                       placeholder="Min" value="{{ request('age_min') }}" min="18" max="100">
                                <span class="input-group-text">-</span>
                                <input type="number" class="form-control" id="age_max" name="age_max" 
                                       placeholder="Max" value="{{ request('age_max') }}" min="18" max="100">
                            </div>
                        </div>
                        
                        <!-- Date Range Filter -->
                        <div class="col-md-3 mb-3">
                            <label for="date_debut" class="form-label">
                                <i class="fas fa-calendar"></i> Période d'inscription
                            </label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="date_debut" name="date_debut" 
                                       value="{{ request('date_debut') }}">
                                <span class="input-group-text">à</span>
                                <input type="date" class="form-control" id="date_fin" name="date_fin" 
                                       value="{{ request('date_fin') }}">
                            </div>
                        </div>

                        <!-- Establishment Filter -->
                        <div class="col-md-3 mb-3">
                            <label for="etablissement" class="form-label">
                                <i class="fas fa-school"></i> Établissement
                            </label>
                            <input type="text" class="form-control" id="etablissement" name="etablissement" 
                                   placeholder="Nom de l'établissement" 
                                   value="{{ request('etablissement') }}">
                        </div>

                        <!-- Sort By -->
                        <div class="col-md-2 mb-3">
                            <label for="sort_by" class="form-label">
                                <i class="fas fa-sort"></i> Trier par
                            </label>
                            <select class="form-control" id="sort_by" name="sort_by">
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date d'inscription</option>
                                <option value="nom_fr" {{ request('sort_by') == 'nom_fr' ? 'selected' : '' }}>Nom</option>
                                <option value="age" {{ request('sort_by') == 'age' ? 'selected' : '' }}>Âge</option>
                                <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Statut</option>
                            </select>
                        </div>

                        <!-- Sort Direction -->
                        <div class="col-md-1 mb-3">
                            <label for="sort_direction" class="form-label">
                                <i class="fas fa-arrows-alt-v"></i> Ordre
                            </label>
                            <select class="form-control" id="sort_direction" name="sort_direction">
                                <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>↓</option>
                                <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>↑</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filtrer
                                </button>
                                <a href="{{ route('admin.candidats.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-redo"></i> Réinitialiser
                                </a>
                                <button type="button" class="btn btn-info" id="saveFilterBtn">
                                    <i class="fas fa-save"></i> Sauvegarder le filtre
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Candidates List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list"></i> Liste des candidats
                @if(request()->hasAny(['search', 'statut', 'type_etablissement', 'niveau_scolaire', 'age_min', 'age_max', 'date_debut', 'date_fin', 'etablissement']))
                    <span class="badge bg-info">Filtré</span>
                @endif
            </h6>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm" id="bulkAction" style="width: auto;">
                    <option value="">Actions groupées</option>
                    <option value="approve">Approuver sélectionnés</option>
                    <option value="reject">Refuser sélectionnés</option>
                    <option value="delete">Supprimer sélectionnés</option>
                </select>
                <button type="button" class="btn btn-sm btn-primary" id="applyBulkAction" disabled>
                    <i class="fas fa-check"></i> Appliquer
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="candidatsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 40px;">
                                <input type="checkbox" id="selectAll" class="form-check-input">
                            </th>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Âge</th>
                            <th>Téléphone</th>
                            <th>Établissement</th>
                            <th>Type</th>
                            <th>Niveau</th>
                            <th>Date d'inscription</th>
                            <th>Statut</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($educatrices as $educatrice)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input candidate-checkbox" value="{{ $educatrice->id }}">
                            </td>
                            <td>{{ $educatrice->id }}</td>
                            <td>{{ $educatrice->nom_fr }} / {{ $educatrice->nom_ar }}</td>
                            <td>{{ $educatrice->prenom_fr }} / {{ $educatrice->prenom_ar }}</td>
                            <td>{{ $educatrice->age ?? 'N/A' }} ans</td>
                            <td>{{ $educatrice->telephone }}</td>
                            <td>{{ $educatrice->etablissement }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($educatrice->type_etablissement) }}</span>
                            </td>
                            <td>{{ ucfirst($educatrice->niveau_scolaire) }}</td>
                            <td>{{ $educatrice->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @switch($educatrice->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock"></i> En attente
                                        </span>
                                        @break
                                    @case('approved')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle"></i> Accepté
                                        </span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle"></i> Refusé
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">Non défini</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.candidats.show', $educatrice->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       data-bs-toggle="tooltip" 
                                       title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.candidats.edit', $educatrice->id) }}" 
                                       class="btn btn-sm btn-primary" 
                                       data-bs-toggle="tooltip" 
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                           class="btn btn-sm btn-danger delete-btn" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#deleteModal" 
                                           data-id="{{ $educatrice->id }}"
                                           data-name="{{ $educatrice->nom_fr }} {{ $educatrice->prenom_fr }}"
                                           title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="12" class="text-center">
                                <div class="py-4">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Aucun candidat trouvé</p>
                                    @if(request()->hasAny(['search', 'statut', 'type_etablissement']))
                                        <a href="{{ route('admin.candidats.index') }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-redo"></i> Réinitialiser les filtres
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($educatrices->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Affichage de {{ $educatrices->firstItem() }} à {{ $educatrices->lastItem() }} sur {{ $educatrices->total() }} résultats
                </div>
                <div>
                    {{ $educatrices->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Confirmation de suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer le candidat <strong id="candidat-name"></strong> ?</p>
                <p class="text-danger mb-0">
                    <i class="fas fa-exclamation-circle"></i> Cette action est irréversible.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <form id="delete-form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Confirmer la suppression
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Action Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1" aria-labelledby="bulkActionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkActionModalLabel">Confirmation d'action groupée</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="bulkActionMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="confirmBulkAction">Confirmer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
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

        // Select All functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const candidateCheckboxes = document.querySelectorAll('.candidate-checkbox');
        const bulkActionSelect = document.getElementById('bulkAction');
        const applyBulkActionBtn = document.getElementById('applyBulkAction');

        selectAllCheckbox?.addEventListener('change', function() {
            candidateCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkActionButton();
        });

        candidateCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActionButton);
        });

        function updateBulkActionButton() {
            const checkedCount = document.querySelectorAll('.candidate-checkbox:checked').length;
            applyBulkActionBtn.disabled = checkedCount === 0;
            
            if (checkedCount > 0) {
                applyBulkActionBtn.innerHTML = `<i class="fas fa-check"></i> Appliquer (${checkedCount})`;
            } else {
                applyBulkActionBtn.innerHTML = '<i class="fas fa-check"></i> Appliquer';
            }
        }

        // Bulk Action Handler
        applyBulkActionBtn?.addEventListener('click', function() {
            const action = bulkActionSelect.value;
            const selectedIds = Array.from(document.querySelectorAll('.candidate-checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (!action || selectedIds.length === 0) {
                alert('Veuillez sélectionner une action et au moins un candidat.');
                return;
            }

            let message = '';
            switch(action) {
                case 'approve':
                    message = `Êtes-vous sûr de vouloir approuver ${selectedIds.length} candidat(s) ?`;
                    break;
                case 'reject':
                    message = `Êtes-vous sûr de vouloir refuser ${selectedIds.length} candidat(s) ?`;
                    break;
                case 'delete':
                    message = `Êtes-vous sûr de vouloir supprimer ${selectedIds.length} candidat(s) ? Cette action est irréversible.`;
                    break;
            }

            document.getElementById('bulkActionMessage').textContent = message;
            const bulkModal = new bootstrap.Modal(document.getElementById('bulkActionModal'));
            bulkModal.show();

            document.getElementById('confirmBulkAction').onclick = function() {
                // Send AJAX request for bulk action
                fetch('{{ route("admin.candidats.bulk-action") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        action: action,
                        ids: selectedIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    bulkModal.hide();
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Une erreur est survenue: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Une erreur est survenue lors de l\'exécution de l\'action.');
                });
            };
        });

        // Save Filter functionality
        document.getElementById('saveFilterBtn')?.addEventListener('click', function() {
            const filterData = new FormData(document.getElementById('filterForm'));
            const filterName = prompt('Donnez un nom à ce filtre:');
            
            if (filterName) {
                localStorage.setItem('filter_' + filterName, JSON.stringify(Object.fromEntries(filterData)));
                alert('Filtre sauvegardé avec succès!');
            }
        });

        // Auto-submit on filter change (optional)
        const autoSubmitElements = document.querySelectorAll('#sort_by, #sort_direction, #statut');
        autoSubmitElements.forEach(element => {
            element.addEventListener('change', function() {
                if (confirm('Appliquer ce filtre maintenant?')) {
                    document.getElementById('filterForm').submit();
                }
            });
        });
    });
</script>
@endsection

@section('styles')
<style>
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-danger {
        border-left: 0.25rem solid #e74a3b !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    
    .table th {
        background-color: #f8f9fc;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fc;
    }
    
    .btn-group .btn {
        padding: 0.25rem 0.5rem;
    }
    
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 600;
    }
    
    #filterCollapse {
        transition: all 0.3s ease;
    }
    
    .gap-2 {
        gap: 0.5rem;
    }
</style>
@endsection