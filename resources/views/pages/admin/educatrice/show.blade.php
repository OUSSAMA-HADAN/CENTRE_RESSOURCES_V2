@extends('layouts.admin')
@section('title', 'Détails de l\'éducatrice')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Détails de l'éducatrice</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.educatrices.index') }}">Éducatrices</a></li>
        <li class="breadcrumb-item active">Détails</li>
    </ol>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-user me-1"></i>
                        Information de l'éducatrice
                    </div>
                    <div>
                        <a href="{{ route('admin.educatrices.edit', $educatrice) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i> Modifier
                        </a>
                        <a href="{{ route('admin.educatrices.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2 mb-3">Informations personnelles</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Nom (français):</div>
                                <div class="col-md-8">{{ $educatrice->nom_fr }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Prénom (français):</div>
                                <div class="col-md-8">{{ $educatrice->prenom_fr }}</div>
                            </div>
                            
                            @if($educatrice->nom_ar)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Nom (arabe):</div>
                                <div class="col-md-8 text-end" dir="rtl">{{ $educatrice->nom_ar }}</div>
                            </div>
                            @endif
                            
                            @if($educatrice->prenom_ar)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Prénom (arabe):</div>
                                <div class="col-md-8 text-end" dir="rtl">{{ $educatrice->prenom_ar }}</div>
                            </div>
                            @endif
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">CIN:</div>
                                <div class="col-md-8">{{ $educatrice->cin }}</div>
                            </div>
                            
                            @if($educatrice->email)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Email:</div>
                                <div class="col-md-8">
                                    <a href="mailto:{{ $educatrice->email }}">{{ $educatrice->email }}</a>
                                </div>
                            </div>
                            @endif
                            
                            @if($educatrice->telephone)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Téléphone:</div>
                                <div class="col-md-8">
                                    <a href="tel:{{ $educatrice->telephone }}">{{ $educatrice->telephone }}</a>
                                </div>
                            </div>
                            @endif
                            
                            @if($educatrice->adresse)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Adresse:</div>
                                <div class="col-md-8">{{ $educatrice->adresse }}</div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2 mb-3">Informations professionnelles</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Établissement:</div>
                                <div class="col-md-8">{{ $educatrice->etablissement }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Niveau scolaire:</div>
                                <div class="col-md-8">{{ $educatrice->niveau_scolaire }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Années d'expérience:</div>
                                <div class="col-md-8">{{ $educatrice->annees_experience }} an(s)</div>
                            </div>
                            
                            <h5 class="border-bottom pb-2 mb-3 mt-4">Informations système</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Date d'inscription:</div>
                                <div class="col-md-8">{{ $educatrice->created_at->format('d/m/Y à H:i') }}</div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Dernière mise à jour:</div>
                                <div class="col-md-8">{{ $educatrice->updated_at->format('d/m/Y à H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection