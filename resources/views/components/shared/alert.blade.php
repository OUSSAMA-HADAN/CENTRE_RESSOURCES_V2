@props(['type' => 'info', 'dismissible' => true, 'icon' => null])

@php
    $icons = [
        'success' => 'check-circle',
        'danger' => 'exclamation-triangle',
        'warning' => 'exclamation-circle',
        'info' => 'info-circle'
    ];
    
    $iconToUse = $icon ?? $icons[$type] ?? 'info-circle';
@endphp

<div class="alert alert-{{ $type }} {{ $dismissible ? 'alert-dismissible fade show' : '' }}" role="alert">
    <i class="fas fa-{{ $iconToUse }} me-2"></i>
    {{ $slot }}
    
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>