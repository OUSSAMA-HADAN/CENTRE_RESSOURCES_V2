@extends('layouts.admin')

@section('title', 'Gestion Unité de Recherche')
@section('page-title', 'Unité de Recherche')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gestion de l'Unité de Recherche</h1>
            <a href="{{ route('admin.recherche.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Ajouter une publication
            </a>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Publications</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counts['all'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Publiées</div>
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
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Brouillons</div>
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
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Chercheurs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $authorsCount ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filtres et recherche</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.recherche.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4 mb-3">
                        <label for="search" class="form-label">Recherche</label>
                        <input type="text" class="form-control" id="search" name="search"
                            placeholder="Titre, résumé..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="category" class="form-label">Catégorie</label>
                        <input type="text" class="form-control" id="category" name="category" placeholder="Catégorie" value="{{ request('category') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-control" id="status" name="status">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tous les statuts
                            </option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publié
                            </option>
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

        <!-- Publications Section -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Publications</h6>
                        <div>
                            <a href="{{ route('admin.recherche.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus fa-sm"></i> Ajouter
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Date de publication</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recherches as $recherche)
                                        <tr>
                                            <td>{{ $recherche->title }}</td>
                                            <td>{{ $recherche->category }}</td>
                                            <td>{{ $recherche->published_at ? $recherche->published_at->format('d/m/Y') : 'Non publiée' }}
                                            </td>
                                            <td>
                                                @if ($recherche->is_published)
                                                    <span class="badge bg-success">Publié</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Brouillon</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.recherche.edit', $recherche) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.recherche.destroy', $recherche) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer la publication \'{{ $recherche->title }}\' ? Cette action est irréversible.')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Aucune publication trouvée</td>
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