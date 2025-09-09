@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'multiple' => false,
    'help' => null,
])

@php
    $selectClass = $multiple ? 'tom-select w-100' : 'form-select';
@endphp

<div class="mb-3">
    @if ($label)
        <label class="form-label" for="{{ $name }}">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <div class="input-group @error($name) is-invalid @enderror">
        <select name="{{ $name }}" id="{{ str_replace('[]', '', $name) }}"
            @if ($multiple) multiple @endif @if ($required) required @endif
            @if ($disabled) disabled @endif
            {{ $attributes->class([
                    $selectClass => !$attributes->has('class'),
                ])->merge() }}>

            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach ($options as $key => $option)
                <option value="{{ $key }}" @if (is_array($selected) ? in_array($key, $selected) : $key == $selected) selected @endif>
                    {{ $option }}
                </option>
            @endforeach

            {{-- enable slot if no options are provided --}}
            @if (empty($options) && $slot)
                {{ $slot }}
            @endif
        </select>
    </div>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($help)
        <div class="form-text text-muted">{{ $help }}</div>
    @endif
</div>
