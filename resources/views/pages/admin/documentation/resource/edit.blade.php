@extends('layouts.admin')

@section('title', 'Modifier une ressource documentaire')
@section('page-title', 'Modifier une ressource documentaire')

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
        <h1 class="h3 mb-0 text-gray-800">Modifier la ressource</h1>
        <a href="{{ route('admin.documentation.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Retour à la liste
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations de la ressource</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.documentation.resources.update', $resource) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $resource->title) }}" required>
                            @error('title')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $resource->description) }}</textarea>
                            <div class="form-text">Une brève description de la ressource (max. 200 caractères)</div>
                            @error('description')
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
                                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $resource->category) }}" required>
                                    @error('category')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="is_published" class="form-label">Statut</label>
                                    <select class="form-select" id="is_published" name="is_published">
                                        <option value="0" {{ old('is_published', $resource->is_published) == 0 ? 'selected' : '' }}>Brouillon</option>
                                        <option value="1" {{ old('is_published', $resource->is_published) == 1 ? 'selected' : '' }}>Publié</option>
                                    </select>
                                    @error('is_published')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Fichier de ressource
                            </div>
                            <div class="card-body">
                                @if($resource->pdf_file)
                                <div class="mb-3">
                                    <label class="form-label">Fichier actuel</label>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            @php
                                                $fileExtension = pathinfo($resource->pdf_file, PATHINFO_EXTENSION);
                                                $icon = 'fas fa-file';
                                                $color = 'secondary';
                                                
                                                switch($fileExtension) {
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
                                            <i class="{{ $icon }} text-{{ $color }} fa-2x"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">{{ basename($resource->pdf_file) }}</p>
                                            <a href="{{ route('admin.documentation.resources.download', $resource) }}" class="small">Télécharger</a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="mb-3">
                                    <label for="file" class="form-label">{{ $resource->pdf_file ? 'Remplacer le fichier' : 'Télécharger un fichier' }} {{ !$resource->pdf_file ? '<span class="text-danger">*</span>' : '' }}</label>
                                    <input type="file" class="form-control" id="file" name="file" {{ !$resource->pdf_file ? 'required' : '' }}>
                                    <div class="form-text">Formats acceptés: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, ZIP (max 10MB)</div>
                                    @error('file')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="file-info mt-2 d-none">
                                    <p class="small text-muted mb-1">Informations sur le nouveau fichier:</p>
                                    <div class="file-details"></div>
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
        // Display file info when uploaded
        const fileInput = document.getElementById('file');
        const fileInfoContainer = document.querySelector('.file-info');
        const fileDetails = document.querySelector('.file-details');
        
        if (fileInput && fileInfoContainer && fileDetails) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    const fileSize = (file.size / 1024 / 1024).toFixed(2); // Convert to MB
                    const fileName = file.name;
                    const fileType = file.type;
                    
                    let fileInfo = `
                        <p class="mb-1"><strong>Nom:</strong> ${fileName}</p>
                        <p class="mb-1"><strong>Type:</strong> ${fileType}</p>
                        <p class="mb-0"><strong>Taille:</strong> ${fileSize} MB</p>
                    `;
                    
                    fileDetails.innerHTML = fileInfo;
                    fileInfoContainer.classList.remove('d-none');
                }
            });
        }
        
        // Character counter for description
        const description = document.getElementById('description');
        if (description) {
            const createCounter = () => {
                const counter = document.createElement('div');
                counter.className = 'text-muted small mt-1';
                counter.id = 'description-counter';
                description.nextElementSibling.insertAdjacentElement('afterend', counter);
                return counter;
            };
            
            const counter = createCounter();
            
            const updateCounter = () => {
                const length = description.value.length;
                counter.textContent = `${length} / 200 caractères`;
                
                if (length > 200) {
                    counter.classList.add('text-danger');
                } else {
                    counter.classList.remove('text-danger');
                }
            };
            
            description.addEventListener('input', updateCounter);
            updateCounter(); // Initial count
        }
    });
</script>
@endsection