@props([
    'icon' => 'ti ti-edit',
    'title' => '',
    'color' => 'text-secondary', // Text color class
    'size' => 'font-xl', // Icon size class
    'modal' => '', // Modal target ID
])

<button type="button" class="btn btn-{{ $color }} btn-table-action {{ $size }}" title="{{ $title }}"
    @if ($modal) data-bs-toggle="modal" data-bs-target="#{{ $modal }}" @endif
    {{ $attributes }}>
    <i class="{{ $icon }}"></i>
</button>
