@props(['name', 'label', 'accept' => null, 'required' => false, 'helpText' => null, 'multiple' => false])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }} {{ $required ? '*' : '' }}</label>
    <input 
        type="file" 
        name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
        id="{{ $name }}" 
        class="form-control @error($name) is-invalid @enderror" 
        {{ $accept ? 'accept='.$accept : '' }}
        {{ $multiple ? 'multiple' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
    @if($helpText)
        <div class="form-text">{{ $helpText }}</div>
    @endif
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>