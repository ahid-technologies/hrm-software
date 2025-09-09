@props([
    'color' => 'primary',
    'value' => 0,
    'lt' => true,
])

@php
    $bgClass = "bg-{$color}";
    $bgColor = str_replace('bg-', '', $bgClass);
    $class = 'badge ' . ($lt ? "{$bgClass}-lt" : "$bgClass text-$bgColor-fg");
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>
    {{ rtrim(rtrim(number_format($value, 2, '.', ''), '0'), '.') }}
</span>
