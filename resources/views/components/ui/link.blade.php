@props([
    'color' => 'primary',
    'text' => 'Click Here',
    'href' => '#',
])

<a {{ $attributes->merge(['class' => "btn btn-$color"]) }} {{ $attributes }} href="{{ $href }}" wire:navigate>
    {{ $text }}
</a>
