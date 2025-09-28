@props(['type' => 'submit', 'color' => 'primary', 'icon' => null])

<button 
    type="{{ $type }}" 
    class="btn btn-{{ $color }} {{ $attributes->get('class') }}"
    {{ $attributes->except('class') }}
>
    @if($icon)
        <i class="fas fa-{{ $icon }} me-2"></i>
    @endif
    {{ $slot }}
</button>