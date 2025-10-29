@props(['name', 'label', 'value' => null, 'required' => false, 'helpText' => null])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {{ $required ? '*' : '' }}</label>
    <textarea 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-control rich-editor @error($name) is-invalid @enderror" 
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >{{ old($name, $value) }}</textarea>
    @if($helpText)
        <div class="form-text">{{ $helpText }}</div>
    @endif
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@push('styles')
<link href="{{ asset('node_modules/summernote/dist/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('node_modules/summernote/dist/summernote-bs4.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Summernote editors
        const editors = document.querySelectorAll('.rich-editor');
        editors.forEach(function(editor) {
            $(editor).summernote({
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    });
</script>
@endpush