@extends('layouts.admin')

@section('title', 'Modifier une publication')
@section('page-title', 'Modifier une publication')

@section('content')
<div class="container-fluid">
    <!-- Error messages -->
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Modifier la publication</h1>
        <a href="{{ route('admin.documentation.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour à la liste
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la publication</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.documentation.publications.update', $publication) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $publication->title) }}" required>
                            @error('title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $publication->slug) }}">
                            <div class="form-text">Laissez vide pour générer automatiquement à partir du titre</div>
                            @error('slug')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">Résumé <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="summary" name="summary" rows="3" required>{{ old('summary', $publication->summary) }}</textarea>
                            @error('summary')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Contenu <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content', $publication->content) }}</textarea>
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
                                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $publication->category) }}" required>
                                    @error('category')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Date de publication</label>
                                    <input type="date" class="form-control" id="published_at" name="published_at" value="{{ old('published_at', $publication->published_at ? $publication->published_at->format('Y-m-d') : '') }}">
                                    @error('published_at')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $publication->is_published) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_published">
                                            Publier immédiatement
                                        </label>
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
                                @if($publication->cover_image)
                                <div class="mb-3">
                                    <label class="form-label">Image actuelle</label>
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $publication->cover_image) }}" alt="Image de couverture" class="img-fluid img-thumbnail" style="max-height: 150px;">
                                    </div>
                                </div>
                                @endif

                                <div class="mb-3">
                                    <label for="cover_image" class="form-label">{{ $publication->cover_image ? 'Remplacer l\'image' : 'Ajouter une image' }}</label>
                                    <input type="file" class="form-control" id="cover_image" name="cover_image">
                                    <div class="form-text">Formats acceptés: JPG, JPEG, PNG, GIF (max 2MB)</div>
                                    @error('cover_image')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Fichier PDF
                            </div>
                            <div class="card-body">
                                @if($publication->pdf_file)
                                <div class="mb-3">
                                    <label class="form-label">Fichier actuel</label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ basename($publication->pdf_file) }}</p>
                                            <a href="{{ asset('storage/' . $publication->pdf_file) }}" target="_blank" class="small">Télécharger</a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="mb-3">
                                    <label for="pdf_file" class="form-label">{{ $publication->pdf_file ? 'Remplacer le fichier PDF' : 'Ajouter un fichier PDF' }}</label>
                                    <input type="file" class="form-control" id="pdf_file" name="pdf_file">
                                    <div class="form-text">Format accepté: PDF (max 10MB)</div>
                                    @error('pdf_file')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.documentation.index') }}" class="btn btn-secondary me-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from title
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        
        if (titleInput && slugInput) {
            titleInput.addEventListener('blur', function() {
                if (slugInput.value === '') {
                    const slug = this.value
                        .toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/[\s_-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                    
                    slugInput.value = slug;
                }
            });
        }
    });
</script>
@endsection