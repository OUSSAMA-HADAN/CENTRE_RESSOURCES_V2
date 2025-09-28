@extends('layouts.admin')

@section('title', 'Détails du candidat')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Détails du candidat</h1>
        <div>
            <a href="{{ route('admin.candidats.index') }}" class="btn btn-sm btn-secondary shadow-sm me-2">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour à la liste
            </a>
            <a href="{{ route('admin.candidats.edit', $candidat->id) }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Modifier
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Candidate Info Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Informations du candidat</h6>
        <div>
            <span class="badge 
                @if($candidat->status == 'pending')
                    bg-warning text-dark
                @elseif($candidat->status == 'approved')
                    bg-success
                @elseif($candidat->status == 'rejected')
                    bg-danger
                @else
                    bg-secondary
                @endif
            ">
                @if($candidat->status == 'pending')
                    En attente
                @elseif($candidat->status == 'approved')
                    Accepté
                @elseif($candidat->status == 'rejected')
                    Refusé
                @else
                    {{ $candidat->status }}
                @endif
            </span>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="bg-light" width="25%">Nom complet</th>
                        <td width="25%">{{ $candidat->first_name }} {{ $candidat->last_name }}</td>
                        <th class="bg-light" width="25%">Email</th>
                        <td width="25%"><a href="mailto:{{ $candidat->email }}">{{ $candidat->email }}</a></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Date de naissance</th>
                        <td>{{ $candidat->birth_date->format('d/m/Y') }}</td>
                        <th class="bg-light">Lieu de naissance</th>
                        <td>{{ $candidat->birth_place }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Téléphone</th>
                        <td><a href="tel:{{ $candidat->phone_number }}">{{ $candidat->phone_number }}</a></td>
                        <th class="bg-light">Numéro de carte d'identité</th>
                        <td>{{ $candidat->id_card_number }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Situation familiale</th>
                        <td>
                            @switch($candidat->marital_status)
                                @case('single')
                                    Célibataire
                                    @break
                                @case('married')
                                    Marié(e)
                                    @break
                                @case('divorced')
                                    Divorcé(e)
                                    @break
                                @case('widowed')
                                    Veuf/Veuve
                                    @break
                                @default
                                    {{ $candidat->marital_status }}
                            @endswitch
                        </td>
                        <th class="bg-light">Statut</th>
                        <td>
                            @if($candidat->status == 'pending')
                                <span class="badge bg-warning text-dark">En attente</span>
                            @elseif($candidat->status == 'approved')
                                <span class="badge bg-success">Accepté</span>
                            @elseif($candidat->status == 'rejected')
                                <span class="badge bg-danger">Refusé</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Années d'expérience</th>
                        <td>{{ $candidat->years_of_experience }} ans</td>
                        <th class="bg-light">Niveau d'éducation</th>
                        <td>{{ $candidat->education_level }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Date d'inscription</th>
                        <td>{{ $candidat->created_at->format('d/m/Y H:i') }}</td>
                        <th class="bg-light">Numéro de référence</th>
                        <td>{{ $candidat->reference_number }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light">Notes administratives</th>
                        <td colspan="3">
                            @if($candidat->notes)
                                {{ $candidat->notes }}
                            @else
                                <em class="text-muted">Aucune note administrative.</em>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    
    <!-- Actions Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="{{ route('admin.candidats.edit', $candidat->id) }}" class="btn btn-primary btn-block">
                        <i class="fas fa-edit me-1"></i> Modifier le candidat
                    </a>
                </div>
                
                <div class="col-md-4 mb-3">
                    <form action="{{ route('admin.candidats.update', $candidat->id) }}" method="POST" class="d-inline status-form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="first_name" value="{{ $candidat->first_name }}">
                        <input type="hidden" name="last_name" value="{{ $candidat->last_name }}">
                        <input type="hidden" name="email" value="{{ $candidat->email }}">
                        <input type="hidden" name="birth_date" value="{{ $candidat->birth_date->format('Y-m-d') }}">
                        <input type="hidden" name="birth_place" value="{{ $candidat->birth_place }}">
                        <input type="hidden" name="id_card_number" value="{{ $candidat->id_card_number }}">
                        <input type="hidden" name="phone_number" value="{{ $candidat->phone_number }}">
                        <input type="hidden" name="marital_status" value="{{ $candidat->marital_status }}">
                        <input type="hidden" name="years_of_experience" value="{{ $candidat->years_of_experience }}">
                        <input type="hidden" name="education_level" value="{{ $candidat->education_level }}">
                        <input type="hidden" name="notes" value="{{ $candidat->notes }}">
                        
                        @if($candidat->status == 'pending' || $candidat->status == 'rejected')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-success btn-block status-btn">
                                <i class="fas fa-check-circle me-1"></i> Accepter la candidature
                            </button>
                        @endif
                    </form>
                    
                    @if($candidat->status == 'pending' || $candidat->status == 'approved')
                        <form action="{{ route('admin.candidats.update', $candidat->id) }}" method="POST" class="d-inline status-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="first_name" value="{{ $candidat->first_name }}">
                            <input type="hidden" name="last_name" value="{{ $candidat->last_name }}">
                            <input type="hidden" name="email" value="{{ $candidat->email }}">
                            <input type="hidden" name="birth_date" value="{{ $candidat->birth_date->format('Y-m-d') }}">
                            <input type="hidden" name="birth_place" value="{{ $candidat->birth_place }}">
                            <input type="hidden" name="id_card_number" value="{{ $candidat->id_card_number }}">
                            <input type="hidden" name="phone_number" value="{{ $candidat->phone_number }}">
                            <input type="hidden" name="marital_status" value="{{ $candidat->marital_status }}">
                            <input type="hidden" name="years_of_experience" value="{{ $candidat->years_of_experience }}">
                            <input type="hidden" name="education_level" value="{{ $candidat->education_level }}">
                            <input type="hidden" name="notes" value="{{ $candidat->notes }}">
                            <input type="hidden" name="status" value="rejected">
                            
                            @if($candidat->status != 'rejected')
                                <button type="submit" class="btn btn-danger btn-block status-btn mt-2">
                                    <i class="fas fa-times-circle me-1"></i> Refuser la candidature
                                </button>
                            @endif
                        </form>
                    @endif
                </div>
                
                <div class="col-md-4 mb-3">
                    <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-1"></i> Supprimer le candidat
                    </button>
                </div>
            </div>
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
                <p>Êtes-vous sûr de vouloir supprimer le candidat <strong>{{ $candidat->first_name }} {{ $candidat->last_name }}</strong> ?</p>
                <p class="text-danger">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('admin.candidats.destroy', $candidat->id) }}" method="POST">
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
        // Status form buttons
        const statusForms = document.querySelectorAll('.status-form');
        
        statusForms.forEach(form => {
            const btn = form.querySelector('.status-btn');
            if (btn) {
                btn.addEventListener('click', function() {
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Traitement...';
                    btn.disabled = true;
                    form.submit();
                });
            }
        });
    });
</script>
@endsection