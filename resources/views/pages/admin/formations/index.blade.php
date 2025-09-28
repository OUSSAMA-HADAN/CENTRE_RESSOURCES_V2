@extends('layouts.admin')

@section('title', 'Gestion des formations en ligne')
@section('page-title', 'Formations en ligne')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Formations en ligne programmées</h1>
        <a href="{{ route('admin.formations.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 me-1"></i> Ajouter une formation
        </a>
    </div>

    <!-- Filters Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filtres et recherche</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.formations.index') }}" method="GET" class="row g-3">
                <div class="col-md-4 mb-3">
                    <label for="search" class="form-label">Recherche</label>
                    <input type="text" class="form-control" id="search" name="search"
                        placeholder="Titre, description..." value="{{ request('search') }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <select class="form-control" id="category" name="category">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ ucfirst($cat) }}
                            </option>
                        @endforeach
                    </select>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total des formations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['all'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Formations publiées</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['published'] }}</div>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">En préparation</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['draft'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pencil-alt fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">À venir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['upcoming'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formations Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des formations en ligne</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="formationsDataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Durée</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($formations as $formation)
                        <tr>
                            <td>{{ $formation->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="thumbnail me-2" style="width:40px; height:40px; overflow:hidden; border-radius:3px;">
                                        @if($formation->thumbnail)
                                            <img src="{{ asset('storage/' . $formation->thumbnail) }}" alt="Thumbnail" class="img-fluid">
                                        @else
                                            <div style="width:40px; height:40px; background-color:#f0f0f0; display:flex; align-items:center; justify-content:center;">
                                                <i class="fas fa-graduation-cap text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        {{ $formation->title }}
                                        <div class="small text-muted text-truncate" style="max-width:200px;">{{ $formation->description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ ucfirst($formation->category) }}</td>
                            <td>{{ $formation->start_date ? $formation->start_date->format('d/m/Y') : 'Non définie' }}</td>
                            <td>{{ $formation->start_date ? $formation->start_date->format('d/m/Y H:i') : 'Non définie' }}</td>
                            <td>{{ $formation->duration }}</td>
                            <td>
                                @if(!$formation->is_published)
                                    <span class="badge bg-secondary">Brouillon</span>
                                @elseif($formation->hasEnded())
                                    <span class="badge bg-dark">Terminée</span>
                                @elseif($formation->hasStarted())
                                    <span class="badge bg-success">En cours</span>
                                @else
                                    <span class="badge bg-primary">À venir</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                <a href="{{ route('admin.formations.edit', $formation) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                    <form action="{{ route('admin.formations.destroy', $formation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer la formation \'{{ $formation->title }}\' ? Cette action est irréversible.')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucune formation trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $formations->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize DataTable
        if ($.fn.DataTable) {
            $('#formationsDataTable').DataTable({
                paging: false,
                searching: false,
                info: false
            });
        }
    });
</script>
@endsection