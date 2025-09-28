@props(['name', 'label', 'options' => [], 'required' => false])

<div class="form-floating mb-3">
    <select 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-select @error($name) is-invalid @enderror"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
        <option value="" disabled selected>{{ __('form.marital_status_options.chosen') }}</option>
        @foreach ($options as $value => $option)
            <option value="{{ $value }}" {{ old($name) == $value ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
    <label for="{{ $name }}">{{ $label }} {{ $required ? '*' : '' }}</label>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>