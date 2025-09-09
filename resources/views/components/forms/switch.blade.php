@props(['name', 'label', 'value' => 1, 'checked' => false, 'disabled' => false, 'help' => null, 'mb' => null])

<label class="form-check form-switch {{ $mb ?? '' }}">
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => 'form-check-input ' . ($errors->has($name) ? 'is-invalid' : '')]) }}>
    <span class="form-check-label">{{ $label }}</span>
</label>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

@if ($help)
    <small class="form-hint">{{ $help }}</small>
@endif
