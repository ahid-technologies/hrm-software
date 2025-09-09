{{--
    resources/views/components/forms/textarea.blade.php

    # Textarea Component

    A reusable textarea component with support for validation states.

    ## Props:
    - name: Textarea name attribute (required)
    - label: Textarea label text (optional)
    - value: Textarea value (optional)
    - placeholder: Textarea placeholder (optional)
    - rows: Number of rows (default: 3)
    - required: Whether the field is required (default: false)
    - disabled: Whether the field is disabled (default: false)
    - help: Help text to display below the textarea (optional)

    ## Usage Examples:

    Basic usage:
    ```blade
    <x-forms.textarea
        name="description"
        label="Description"
        placeholder="Enter a description"
        rows="5"
    />
    ```

    With validation errors:
    ```blade
    <x-forms.textarea
        name="bio"
        label="Biography"
        :value="old('bio')"
        required
    />
    ```

    With help text:
    ```blade
    <x-forms.textarea
        name="notes"
        label="Additional Notes"
        help="Please provide any additional information"
        rows="6"
    />
    ```
--}}

@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'rows' => 3,
    'required' => false,
    'disabled' => false,
    'help' => null,
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

    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($required) required @endif @if ($disabled) disabled @endif
        {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}>{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($help)
        <div class="form-text text-muted">{{ $help }}</div>
    @endif
</div>
