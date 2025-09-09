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
    'optionValue' => 'id',
    'optionText' => 'name',
    'optionAttributes' => null,
])

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
                    'form-select' => !$attributes->has('class'),
                ])->merge() }}>

            @if ($placeholder)
                <option value="">{{ $placeholder }}</option>
            @endif

            @foreach ($options as $option)
                @php
                    $value = data_get($option, $optionValue);
                    $text = data_get($option, $optionText);
                    $attrs = is_callable($optionAttributes) ? $optionAttributes($option) : [];
                @endphp

                <option value="{{ $value }}" @if (is_array($selected) ? in_array($value, $selected) : $value == $selected) selected @endif
                    @foreach ($attrs as $attrName => $attrValue)
                        {{ $attrName }}="{{ $attrValue }}" @endforeach>
                    {{ $text }}
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
