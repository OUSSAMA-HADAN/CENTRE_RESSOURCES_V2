@props(['name', 'label', 'type' => 'text', 'value' => null, 'required' => false])

<div class="form-floating mb-3">
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-control @error($name) is-invalid @enderror" 
        placeholder="{{ $label }}" 
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
    <label for="{{ $name }}">{{ $label }} {{ $required ? '*' : '' }}</label>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>