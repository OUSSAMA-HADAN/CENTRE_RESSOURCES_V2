@extends('layouts.app')
{{-- @php dd($formation->formateur) @endphp --}}
@section('title', $formation->title)

@section('content')
<div class="container py-5 " style="margin-top: 70px">
    <div class="row">
        <div class="col-lg-8">
            <!-- Formation Header -->
            <div class="mb-4">
                @php
                    $statusClass = match($status) {
                        'upcoming' => 'bg-primary',
                        'ongoing' => 'bg-success',
                        'completed' => 'bg-secondary',
                        default => 'bg-info'
                    };
                @endphp
                <span class="badge {{ $statusClass }} mb-3">
                    @switch($status)
                        @case('upcoming')
                            À venir
                            @break
                        @case('ongoing')
                            En cours
                            @break
                        @case('completed')
                            Terminée
                            @break
                        @default
                            Statut inconnu
                    @endswitch
                </span>
                
                <h1 class="display-5 fw-bold mb-3">{{ $formation->title }}</h1>
                
                <div class="d-flex align-items-center text-muted mb-4">
                    <div class="me-3">
                        <i class="fas fa-user-tie me-2"></i>
                        <span>{{ $formation->formateur }}</span>
                    </div>
                    <div class="me-3">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span>
                            {{ $formation->start_date ? $formation->start_date->format('d/m/Y H:i') : 'Date non définie' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Formation Image -->
            @if($formation->thumbnail)
                <div class="mb-4">
                    <img src="{{ $formation->thumbnail_url }}" 
                         alt="{{ $formation->title }}" 
                         class="img-fluid rounded shadow-sm" 
                         style="width: 100%; max-height: 500px; object-fit: cover;">
                </div>
            @endif

            <!-- Formation Description -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-3">Description</h4>
                    <p class="text-muted">{{ $formation->description }}</p>
                </div>
            </div>

            <!-- Formation Details -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-3">Détails de la formation</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock text-primary me-3 fa-2x"></i>
                                <div>
                                    <h6 class="mb-1">Durée</h6>
                                    <p class="text-muted mb-0">
                                        {{ $formation->duration ?? 'Durée non spécifiée' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-globe text-primary me-3 fa-2x"></i>
                                <div>
                                    <h6 class="mb-1">Plateforme</h6>
                                    <p class="text-muted mb-0">
                                        {{ $formation->platform ?? 'Plateforme non spécifiée' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-check text-primary me-3 fa-2x"></i>
                                <div>
                                    <h6 class="mb-1">Date de début</h6>
                                    <p class="text-muted mb-0">
                                        {{ $formation->start_date ? $formation->start_date->format('d/m/Y H:i') : 'Date non définie' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-times text-primary me-3 fa-2x"></i>
                                <div>
                                    <h6 class="mb-1">Date de fin</h6>
                                    <p class="text-muted mb-0">
                                        {{ $formation->end_date ? $formation->end_date->format('d/m/Y H:i') : 'Date non définie' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Time Information -->
            @if($timeInfo['durationDetails'])
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ $timeInfo['durationDetails'] }}
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Formations -->
            @if($relatedFormations->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Formations similaires</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($relatedFormations as $relatedFormation)
                                <a href="{{ route('formation.show', $relatedFormation->slug) }}" 
                                   class="list-group-item list-group-item-action d-flex align-items-center py-3">
                                    @if($relatedFormation->thumbnail)
                                        <img src="{{ $relatedFormation->thumbnail_url }}" 
                                             alt="{{ $relatedFormation->title }}" 
                                             class="rounded me-3" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="rounded me-3 bg-light d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-1">{{ $relatedFormation->title }}</h6>
                                        <small class="text-muted">
                                            {{ $relatedFormation->start_date ? $relatedFormation->start_date->format('d/m/Y') : 'Date non définie' }}
                                        </small>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Additional custom styles for the formation details page */
    .list-group-item-action:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
</style>
@endpush