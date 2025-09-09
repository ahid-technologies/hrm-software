{{--
    resources/views/components/forms/checkbox.blade.php

    # Checkbox Component

    A reusable checkbox component with support for validation states.

    ## Props:
    - name: Checkbox name attribute (required)
    - label: Checkbox label text (required)
    - value: Checkbox value attribute (default: 1)
    - checked: Whether the checkbox is checked (default: false)
    - disabled: Whether the checkbox is disabled (default: false)
    - help: Help text to display below the checkbox (optional)

    ## Usage Examples:

    Basic usage:
    ```blade
    <x-forms.checkbox
        name="remember"
        label="Remember me"
    />
    ```

    With custom value and checked state:
    ```blade
    <x-forms.checkbox
        name="newsletter"
        label="Subscribe to newsletter"
        value="subscribe"
        :checked="old('newsletter', $user->newsletter === 'subscribe')"
    />
    ```

    With help text:
    ```blade
    <x-forms.checkbox
        name="terms"
        label="I agree to the terms and conditions"
        :checked="old('terms')"
        help="By checking this box, you agree to our Terms of Service"
    />
    ```

    Multiple checkboxes with array name:
    ```blade
    <div class="mb-3">
        <label class="form-label">Hobbies</label>
        <x-forms.checkbox
            name="hobbies[]"
            label="Reading"
            value="reading"
            :checked="in_array('reading', old('hobbies', $userHobbies))"
        />
        <x-forms.checkbox
            name="hobbies[]"
            label="Sports"
            value="sports"
            :checked="in_array('sports', old('hobbies', $userHobbies))"
        />
        <x-forms.checkbox
            name="hobbies[]"
            label="Cooking"
            value="cooking"
            :checked="in_array('cooking', old('hobbies', $userHobbies))"
        />
    </div>
    ```
--}}

@props(['name', 'label', 'value' => 1, 'checked' => false, 'disabled' => false, 'help' => null])

<div class="form-check mb-0">
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}_{{ $value }}"
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
