@extends('layouts.admin')

@section('title', 'Ajouter une publication')
@section('page-title', 'Ajouter une publication')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajouter une nouvelle publication</h1>
        <a href="{{ route('admin.recherche.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour à la liste
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la publication</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p><i class="fas fa-exclamation-triangle me-2"></i> Veuillez corriger les erreurs suivantes :</p>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.recherche.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">Résumé <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="summary" name="summary" rows="3" required>{{ old('summary') }}</textarea>
                            <div class="form-text">Un bref résumé de la publication (max. 200 caractères)</div>
                            @error('summary')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="15">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Sidebar Information -->
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                Publication
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Catégorie <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
                                    @error('category')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                

                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Date de publication</label>
                                    <input type="date" class="form-control" id="published_at" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}">
                                    @error('published_at')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block">Statut de publication</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_published" id="status-draft" value="0" >
                                        <label class="form-check-label" for="status-draft">Brouillon</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_published" id="status-published" value="1">
                                        <label class="form-check-label" for="status-published">Publié</label>
                                    </div>
                                    @error('is_published')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Image de couverture
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="cover_image" class="form-label">Télécharger une image</label>
                                    <input type="file" class="form-control" id="cover_image" name="cover_image">
                                    <div class="form-text">Format recommandé: 1200x630px, max 2MB</div>
                                    @error('cover_image')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="image-preview-container mt-2 d-none">
                                    <p class="small text-muted mb-1">Aperçu:</p>
                                    <img src="#" class="img-fluid preview-image" style="max-height: 150px;">
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Documents
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="pdf_file" class="form-label">PDF de la publication</label>
                                    <input type="file" class="form-control" id="pdf_file" name="pdf_file">
                                    <div class="form-text">Format PDF uniquement, max 10MB</div>
                                    @error('pdf_file')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.recherche.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Publier</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize rich text editor for content
        // Note: This is just a placeholder, you would integrate a real editor like CKEditor or TinyMCE
        if (document.getElementById('content')) {
            // Initialize your rich text editor here
            console.log('Rich text editor should be initialized here');
        }
        
        // Preview image when uploaded
        const coverImageInput = document.getElementById('cover_image');
        const previewContainer = document.querySelector('.image-preview-container');
        const previewImage = document.querySelector('.preview-image');
        
        if (coverImageInput && previewContainer && previewImage) {
            coverImageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('d-none');
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
        
        // Form validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(event) {
                let isValid = true;
                
                // Check required fields
                const requiredFields = form.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    event.preventDefault();
                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
                }
            });
        }
        
        // Character counter for meta description
        const metaDescription = document.getElementById('meta_description');
        if (metaDescription) {
            const createCounter = () => {
                const counter = document.createElement('div');
                counter.className = 'text-muted small mt-1';
                counter.id = 'meta-description-counter';
                metaDescription.parentNode.insertBefore(counter, metaDescription.nextSibling);
                return counter;
            };
            
            const counter = createCounter();
            
            const updateCounter = () => {
                const length = metaDescription.value.length;
                counter.textContent = `${length} / 160 caractères`;
                
                if (length > 160) {
                    counter.classList.add('text-danger');
                } else {
                    counter.classList.remove('text-danger');
                }
            };
            
            metaDescription.addEventListener('input', updateCounter);
            updateCounter(); // Initial count
        }
        
        // Character counter for summary
        const summary = document.getElementById('summary');
        if (summary) {
            const createCounter = () => {
                const counter = document.createElement('div');
                counter.className = 'text-muted small mt-1';
                counter.id = 'summary-counter';
                summary.nextElementSibling.insertAdjacentElement('afterend', counter);
                return counter;
            };
            
            const counter = createCounter();
            
            const updateCounter = () => {
                const length = summary.value.length;
                counter.textContent = `${length} / 200 caractères`;
                
                if (length > 200) {
                    counter.classList.add('text-danger');
                } else {
                    counter.classList.remove('text-danger');
                }
            };
            
            summary.addEventListener('input', updateCounter);
            updateCounter(); // Initial count
        }
    });
</script>
@endsection