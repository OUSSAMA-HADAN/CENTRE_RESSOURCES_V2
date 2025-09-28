{{-- resources/views/components/public/card.blade.php --}}
@props([
    'title' => '',
    'description' => '',
    'icon' => 'fas fa-file-pdf',
    'date' => null,
    'previewUrl' => '#',
    'downloadUrl' => '#',
    'category' => null,
])

<div {{ $attributes->merge(['class' => 'card border-0 rounded overflow-hidden shadow-sm h-100']) }}>
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <i class="{{ $icon }} text-primary me-3 fa-2x"></i>
            <h5 class="card-title mb-0">{{ $title }}</h5>
        </div>
        
        @if($description)
            <p class="card-text text-muted mb-3">
                {{ $description }}
            </p>
        @endif
        
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted small">
                @if($date)
                    <i class="fas fa-calendar-alt me-1"></i>{{ $date }}
                @endif
                
                @if($category)
                    <span class="ms-2">
                        <i class="fas fa-tag me-1"></i>{{ $category }}
                    </span>
                @endif
            </span>
            
            <div>
                @if($previewUrl)
                    <a href="{{ $previewUrl }}" class="text-primary me-2" title="{{ __('general.preview') }}">
                        {{-- <i class="fas fa-eye"></i> --}}
                    </a>
                @endif
                
                @if($downloadUrl)
                    <a href="{{ $downloadUrl }}" class="text-success" title="{{ __('general.download') }}">
                        <i class="fas fa-download"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>