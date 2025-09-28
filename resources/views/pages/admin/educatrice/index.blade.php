@extends('layouts.admin')

@section('title', 'Gestion des Éducatrices')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestion des Éducatrices</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active">Éducatrices</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-chalkboard-teacher me-1"></i>
                Liste des éducatrices inscrites
            </div>
            {{-- <div>
                <a href="{{ route('admin.educatrices.export') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-csv me-1"></i> Exporter en CSV
                </a>
            </div> --}}
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="educatricesTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>CIN</th>
                            <th>Établissement</th>
                            <th>telephone</th>
                            <th>Exp.</th>
                            <th>Date d'inscription</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($educatrices as $educatrice)
                            <tr>
                                <td>{{ $educatrice->id }}</td>
                                <td>{{ $educatrice->nom_fr }}</td>
                                <td>{{ $educatrice->prenom_fr }}</td>
                                <td>{{ $educatrice->cin }}</td>
                                <td class="col-3">{{ $educatrice->etablissement }}</td>
                                <td>{{ $educatrice->telephone }}</td>

                                <td>{{ $educatrice->annees_experience }} an(s)</td>
                                <td>{{ $educatrice->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.educatrices.show', $educatrice) }}" class="btn btn-info btn-sm" title="Voir les détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.educatrices.edit', $educatrice) }}" class="btn btn-primary btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.educatrices.destroy', $educatrice) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette éducatrice ?')" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Aucune éducatrice inscrite pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $educatrices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation du tableau avec DataTables si disponible
        if ($.fn.DataTable) {
            $('#educatricesTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json'
                },
                paging: false, // Désactivé car nous utilisons la pagination Laravel
                searching: true,
                ordering: true,
                info: false
            });
        }
    });
</script>
@endsection