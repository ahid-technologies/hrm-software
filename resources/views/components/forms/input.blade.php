{{--
    resources/views/components/forms/input.blade.php

    # Text Input Component

    A reusable text input component that supports various input types, icons, and validation states.

    ## Props:
    - name: Input name attribute (required)
    - label: Input label text (optional)
    - type: Input type (default: 'text')
    - value: Input value (optional)
    - placeholder: Input placeholder (optional)
    - required: Whether the field is required (default: false)
    - disabled: Whether the field is disabled (default: false)
    - help: Help text to display below the input (optional)

    ## Slots:
    - prepend: Content to prepend before the input (typically an icon)
    - append: Content to append after the input (typically an icon)

    ## Usage Examples:

    Basic usage:
    ```blade
    <x-forms.input
        name="username"
        label="Username"
        placeholder="Enter your username"
    />
    ```

    With icon:
    ```blade
    <x-forms.input name="search" placeholder="Search...">
        <x-slot:prepend>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="10" cy="10" r="7" />
                <line x1="21" y1="21" x2="15" y2="15" />
            </svg>
        </x-slot:prepend>
    </x-forms.input>
    ```

    With validation errors:
    ```blade
    <x-forms.input
        name="email"
        label="Email Address"
        type="email"
        :value="old('email')"
        required
    />
    ```

    With help text:
    ```blade
    <x-forms.input
        name="password"
        label="Password"
        type="password"
        help="Password must be at least 8 characters"
        required
    />
    ```
--}}

@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'disabled' => false,
    'help' => null,
])

<div class="mb-3">
    @if ($label)
        <label class="form-label {{ $required ? 'required' : '' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif

    <div class="input-group @error($name) is-invalid @enderror">
        @if (isset($prepend))
            <span class="input-group-text">
                {{ $prepend }}
            </span>
        @endif

        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}" @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($required) required @endif @if ($disabled) disabled @endif
            {{ $attributes->merge(['class' => 'form-control']) }} {{ $attributes }} />

        @if (isset($append))
            <span class="input-group-text">
                {{ $append }}
            </span>
        @endif
    </div>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($help)
        <div class="form-text text-muted">{{ $help }}</div>
    @endif
</div>
