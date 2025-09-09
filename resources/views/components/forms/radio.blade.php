{{--
    resources/views/components/forms/radio.blade.php

    # Radio Button Component

    A reusable radio button component with support for validation states.

    ## Props:
    - name: Radio button name attribute (required)
    - label: Radio button label text (required)
    - value: Radio button value attribute (required)
    - checked: Whether the radio button is checked (default: false)
    - disabled: Whether the radio button is disabled (default: false)
    - help: Help text to display below the radio button (optional)

    ## Usage Examples:

    Basic usage:
    ```blade
    <div class="mb-3">
        <label class="form-label">Gender</label>
        <x-forms.radio
            name="gender"
            label="Male"
            value="male"
            :checked="old('gender', $user->gender) === 'male'"
        />
        <x-forms.radio
            name="gender"
            label="Female"
            value="female"
            :checked="old('gender', $user->gender) === 'female'"
        />
        <x-forms.radio
            name="gender"
            label="Other"
            value="other"
            :checked="old('gender', $user->gender) === 'other'"
        />
    </div>
    ```

    With help text on one option:
    ```blade
    <x-forms.radio
        name="payment_method"
        label="Credit Card"
        value="credit_card"
        :checked="old('payment_method') === 'credit_card'"
        help="We accept Visa, Mastercard, and American Express"
    />
    ```

    With disabled option:
    ```blade
    <x-forms.radio
        name="shipping"
        label="Express Shipping (Unavailable)"
        value="express"
        disabled
    />
    ```
--}}

@props(['name', 'label', 'value', 'checked' => false, 'disabled' => false, 'help' => null])

<div class="form-check mb-2">
    <input type="radio" name="{{ $name }}" id="{{ $name }}_{{ $value }}"
        value="{{ $value }}" @checked(old($name, $checked)) @if ($disabled) disabled @endif
        {{ $attributes->merge(['class' => 'form-check-input ' . ($errors->has($name) ? 'is-invalid' : '')]) }} />

    <label class="form-check-label" for="{{ $name }}_{{ $value }}">
        {{ $label }}
    </label>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($help)
        <div class="form-text text-muted">{{ $help }}</div>
    @endif
</div>
