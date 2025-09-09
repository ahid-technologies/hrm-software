{{--
    resources/views/components/forms/file-upload.blade.php

    # File Upload Component

    A reusable file upload component with support for validation states and file previews.

    ## Props:
    - name: Input name attribute (required)
    - label: Input label text (optional)
    - required: Whether the field is required (default: false)
    - disabled: Whether the field is disabled (default: false)
    - help: Help text to display below the input (optional)
    - multiple: Allow multiple file uploads (default: false)
    - accept: File types to accept (e.g., 'image/*,.pdf') (optional)
    - preview: URL of existing file for preview (optional)
    - previewType: Type of file preview ('image' or 'document') (default: determined automatically)

    ## Usage Examples:

    Basic usage:
    ```blade
    <x-forms.file-upload
        name="document"
        label="Upload Document"
        accept=".pdf,.doc,.docx"
    />
    ```

    Image upload with preview:
    ```blade
    <x-forms.file-upload
        name="avatar"
        label="Profile Picture"
        accept="image/*"
        :preview="$user->avatar_url"
        previewType="image"
    />
    ```

    Multiple file upload:
    ```blade
    <x-forms.file-upload
        name="attachments[]"
        label="Attachments"
        multiple
        accept=".pdf,.jpg,.png,.doc,.docx"
        help="Upload up to 5 files (max 2MB each)"
    />
    ```
--}}

@props([
    'name',
    'label' => null,
    'required' => false,
    'disabled' => false,
    'help' => null,
    'multiple' => false,
    'accept' => null,
    'preview' => null,
    'previewType' => null,
])

@php
    // Determine preview type if not specified
    if ($preview && $previewType === null) {
        $extension = pathinfo($preview, PATHINFO_EXTENSION);
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        $previewType = in_array(strtolower($extension), $imageExtensions) ? 'image' : 'document';
    }
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

    @if ($preview)
        <div class="mb-2">
            @if ($previewType === 'image')
                <div class="avatar avatar-lg">
                    <img src="{{ $preview }}" class="rounded" alt="Preview">
                </div>
            @else
                <div class="d-flex align-items-center">
                    <span class="avatar bg-blue-lt">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <line x1="9" y1="9" x2="10" y2="9" />
                            <line x1="9" y1="13" x2="15" y2="13" />
                            <line x1="9" y1="17" x2="15" y2="17" />
                        </svg>
                    </span>
                    <div class="ms-2">
                        <a href="{{ $preview }}" target="_blank" class="text-body">Current file</a>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="input-group @error($name) is-invalid @enderror">
        <input type="file" name="{{ $name }}" id="{{ str_replace('[]', '', $name) }}"
            @if ($multiple) multiple @endif @if ($required) required @endif
            @if ($disabled) disabled @endif
            @if ($accept) accept="{{ $accept }}" @endif
            {{ $attributes->merge(['class' => 'form-control']) }} />
    </div>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($help)
        <div class="form-text text-muted">{{ $help }}</div>
    @endif
</div>
