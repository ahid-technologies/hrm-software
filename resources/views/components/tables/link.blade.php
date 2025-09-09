@props([
    'href' => '#',
    'icon' => 'ti ti-link',
    'color' => 'text-secondary', // Text color class
    'size' => 'font-xl', // Icon size class
])

<a href="{{ $href }}" class="btn btn-{{ $color }} btn-table-action {{ $size }}"
    {{ $attributes }}>
    <i class="{{ $icon }}"></i>
</a>
