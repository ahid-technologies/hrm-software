{{--
    resources/views/components/forms/date-picker.blade.php

    # Date Picker Component

    A reusable date picker component using Tabler's built-in datepicker.

    ## Props:
    - name: Input name attribute (required)
    - label: Input label text (optional)
    - value: Input value (optional)
    - placeholder: Input placeholder (default: 'Select date')
    - required: Whether the field is required (default: false)
    - disabled: Whether the field is disabled (default: false)
    - help: Help text to display below the input (optional)
    - format: Date format (default: 'YYYY-MM-DD')
    - minDate: Minimum selectable date (optional)
    - maxDate: Maximum selectable date (optional)

    ## Slots:
    - prepend: Content to prepend before the input (typically an icon)

    ## Usage Notes:
    This component uses Tabler's built-in datepicker functionality. Make sure to include
    the necessary Tabler.io JavaScript files in your layout.

    ## Usage Examples:

    Basic usage:
    ```blade
    <x-forms.date-picker
        name="birthdate"
        label="Date of Birth"
    />
    ```

    With default value:
    ```blade
    <x-forms.date-picker
        name="appointment_date"
        label="Appointment Date"
        value="{{ old('appointment_date', $appointment->date) }}"
    />
    ```

    With min/max date constraints:
    ```blade
    <x-forms.date-picker
        name="event_date"
        label="Event Date"
        minDate="2023-01-01"
        maxDate="2023-12-31"
    />
    ```

    With calendar icon (using the prepend slot):
    ```blade
    <x-forms.date-picker name="start_date" label="Start Date">
        <x-slot:prepend>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <rect x="4" y="5" width="16" height="16" rx="2" />
                <line x1="16" y1="3" x2="16" y2="7" />
                <line x1="8" y1="3" x2="8" y2="7" />
                <line x1="4" y1="11" x2="20" y2="11" />
                <line x1="11" y1="15" x2="12" y2="15" />
                <line x1="12" y1="15" x2="12" y2="18" />
            </svg>
        </x-slot:prepend>
    </x-forms.date-picker>
    ```
--}}

@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => 'Select date',
    'required' => false,
    'disabled' => false,
    'help' => null,
    'format' => 'YYYY-MM-DD',
    'minDate' => null,
    'maxDate' => null,
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
        @if (isset($prepend))
            <span class="input-group-text">
                {{ $prepend }}
            </span>
        @else
            <span class="input-group-text">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="5" width="16" height="16" rx="2" />
                    <line x1="16" y1="3" x2="16" y2="7" />
                    <line x1="8" y1="3" x2="8" y2="7" />
                    <line x1="4" y1="11" x2="20" y2="11" />
                    <line x1="11" y1="15" x2="12" y2="15" />
                    <line x1="12" y1="15" x2="12" y2="18" />
                </svg>
            </span>
        @endif

        <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}" @if ($required) required @endif
            @if ($disabled) disabled @endif data-datepicker data-input
            @if ($format) data-format="{{ $format }}" @endif
            @if ($minDate) data-min-date="{{ $minDate }}" @endif
            @if ($maxDate) data-max-date="{{ $maxDate }}" @endif
            {{ $attributes->merge(['class' => 'form-control datepicker-input']) }} />
    </div>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($help)
        <div class="form-text text-muted">{{ $help }}</div>
    @endif
</div>
