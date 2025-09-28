@props(['name', 'label', 'value' => null, 'required' => false, 'rows' => 4, 'helpText' => null])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {{ $required ? '*' : '' }}</label>
    <textarea 
        name="{{ $name }}" 
        id="{{ $name }}" 
        rows="{{ $rows }}"
        class="form-control @error($name) is-invalid @enderror" 
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