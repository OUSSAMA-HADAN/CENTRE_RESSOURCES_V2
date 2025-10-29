@extends('layouts.admin')

@section('title', 'Tableau de bord - Unité de Documentation')
@section('page-title', 'Gestion de la Documentation')

@section('content')
<div class="container-fluid">
    <!-- Page Header with Tabs -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Unité de Documentation</h1>
        <div class="d-flex">
            <a href="{{ route('admin.documentation.resources.create') }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50 me-1"></i> Ajouter une ressource
            </a>
        </div>
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs mb-4" id="contentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="resources-tab" data-bs-toggle="tab" data-bs-target="#resources" type="button" role="tab" aria-controls="resources" aria-selected="true">
                <i class="fas fa-book me-1"></i> Ressources disponibles
            </button>
        </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content" id="contentTabsContent">
        <!-- Resources Tab Content -->
        <div class="tab-pane fade show active" id="resources" role="tabpanel" aria-labelledby="resources-tab">
            <!-- Filters Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Filtres et recherche</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('documentation.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4 mb-3">
                            <label for="search" class="form-label">Recherche</label>
                            <input type="text" class="form-control" id="search" name="search" placeholder="Titre, description..." value="{{ request('search') }}">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="documentation_id" class="form-label">Documentation</label>
                            <input type="text" class="form-control" id="documentation_id" name="documentation_id" placeholder="ID de la documentation" value="{{ request('documentation_id') }}">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-control" id="status" name="status">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tous les statuts</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                            </select>
                        </div>
                        
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search"></i> Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Overview Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ressources Totales</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $resourceCounts['all'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-2x text-gray-300"></i>
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
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ressources Publiées</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $resourceCounts['published'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">En Brouillon</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $resourceCounts['draft'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-pencil-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resources Table -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ressources disponibles</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="resourcesDataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Type</th>
                                    <th>Format</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($resources ?? [] as $resource)
                                <tr>
                                    <td>{{ $resource->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="thumbnail me-2" style="width:40px; height:40px; overflow:hidden; border-radius:3px; display:flex; align-items:center; justify-content:center; background-color:#f0f0f0;">
                                                @php
                                                    $icon = 'fas fa-file';
                                                    $color = 'secondary';
                                                    
                                                    switch($resource->file_type) {
                                                        case 'pdf':
                                                            $icon = 'fas fa-file-pdf';
                                                            $color = 'danger';
                                                            break;
                                                        case 'doc':
                                                        case 'docx':
                                                            $icon = 'fas fa-file-word';
                                                            $color = 'primary';
                                                            break;
                                                        case 'xls':
                                                        case 'xlsx':
                                                            $icon = 'fas fa-file-excel';
                                                            $color = 'success';
                                                            break;
                                                        case 'ppt':
                                                        case 'pptx':
                                                            $icon = 'fas fa-file-powerpoint';
                                                            $color = 'warning';
                                                            break;
                                                        case 'zip':
                                                            $icon = 'fas fa-file-archive';
                                                            $color = 'info';
                                                            break;
                                                    }
                                                @endphp
                                                <i class="{{ $icon }} text-{{ $color }} fa-lg"></i>
                                            </div>
                                            <div>
                                                {{ $resource->title }}
                                                <div class="small text-muted text-truncate" style="max-width:200px;">{{ $resource->description }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $resource->category }}</td>
                                    <td><span class="badge bg-{{ $color }}">{{ strtoupper($resource->file_type) }}</span></td>
                                    <td>{{ $resource->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if($resource->is_published)
                                            <span class="badge bg-success">Publié</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Brouillon</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                           
                                            <a href="{{ route('admin.documentation.resources.download', $resource) }}" 
                                               class="btn btn-sm btn-info" 
                                               title="Télécharger">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <a href="{{ route('admin.documentation.resources.edit', $resource) }}" 
                                               class="btn btn-sm btn-warning" 
                                               title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.documentation.resources.destroy', $resource) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette ressource? Cette action est irréversible.')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucune ressource trouvée</td>
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
    /* Admin Documentation Styling */
    .card {
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 0.25rem 2rem 0 rgba(58, 59, 69, 0.15);
    }

    .btn {
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .table th {
        background-color: #f8f9fa;
        border-top: none;
        font-weight: 600;
        color: #495057;
    }

    .table td {
        vertical-align: middle;
    }

    .thumbnail {
        transition: all 0.3s ease;
    }

    .thumbnail:hover {
        transform: scale(1.1);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.5em 0.75em;
    }

    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }

    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }

    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }

    .text-xs {
        font-size: 0.7rem;
    }

    .font-weight-bold {
        font-weight: 700 !important;
    }

    .text-gray-800 {
        color: #5a5c69 !important;
    }

    .text-gray-300 {
        color: #dddfeb !important;
    }

    .text-primary {
        color: #4e73df !important;
    }

    .text-success {
        color: #1cc88a !important;
    }

    .text-warning {
        color: #f6c23e !important;
    }

    /* Action buttons styling */
    .d-flex.gap-1 .btn {
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
    }

    /* Responsive table */
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .thumbnail {
            width: 30px !important;
            height: 30px !important;
        }
    }
</style>
@endpush

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTables
        if ($.fn.DataTable) {
            $('#resourcesDataTable').DataTable({
                paging: false,
                searching: false,
                info: false
            });
        }
        
        // Handle edit category modal
        const editCategoryModal = document.getElementById('editCategoryModal');
        if (editCategoryModal) {
            editCategoryModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const icon = button.getAttribute('data-icon');
                const color = button.getAttribute('data-color');
                const description = button.getAttribute('data-description');
                
                const form = document.getElementById('editCategoryForm');
                form.action = form.action.replace(/\/\d+$/, '/' + id);
                
                document.getElementById('editCategoryId').value = id;
                document.getElementById('editCategoryName').value = name;
                document.getElementById('editCategoryIcon').value = icon;
                document.getElementById('editCategoryColor').value = color;
                document.getElementById('editCategoryDescription').value = description;
            });
        }
        
        // Style for category icons
        document.querySelectorAll('.circle-icon').forEach(icon => {
            icon.style.width = '30px';
            icon.style.height = '30px';
            icon.style.borderRadius = '50%';
            icon.style.display = 'flex';
            icon.style.alignItems = 'center';
            icon.style.justifyContent = 'center';
            icon.style.fontSize = '0.9rem';
        });
    });
</script>
@endsection