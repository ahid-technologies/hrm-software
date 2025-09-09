@props(['text', 'color' => 'primary', 'lt' => true])

@php
    $bgClass = "bg-{$color}";
    $bgColor = str_replace('bg-', '', $bgClass);
    $class = 'badge ' . ($lt ? "{$bgClass}-lt" : "$bgClass text-$bgColor-fg");
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>
    {{ ucwords($text) }}
</span>
