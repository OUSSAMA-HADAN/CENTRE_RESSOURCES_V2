@props(['placeholder' => 'Rechercher...', 'name' => 'search', 'route' => null])

<form action="{{ $route ?? request()->url() }}" method="GET" class="search-form {{ $attributes->get('class') }}">
    <div class="input-group">
        <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-search text-muted"></i>
        </span>
        <input 
            type="text" 
            name="{{ $name }}" 
            class="form-control border-start-0 shadow-none ps-0" 
            placeholder="{{ $placeholder }}" 
            value="{{ request($name) }}"
            {{ $attributes->except('class') }}
        >
        @if(request()->has($name) && request($name))
            <a href="{{ url()->current() }}" class="input-group-text bg-white border-start-0 text-decoration-none">
                <i class="fas fa-times text-muted"></i>
            </a>
        @endif
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </div>
</form>