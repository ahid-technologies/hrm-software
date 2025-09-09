@props([
    'color' => 'primary',
    'text' => 'Submit',
    'loading' => false,
])

<button {{ $attributes->merge(['class' => "btn btn-$color"]) }} {{ $attributes }} wire:loading.attr="disabled">
    {{ $text }}
</button>
