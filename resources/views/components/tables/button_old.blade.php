@props([
    'color' => '',
    'text' => '',
    'loading' => false,
    'icon' => 'ti ti-pencil',
    'spinner' => false,
])

<button {{ $attributes->merge(['class' => "btn btn-$color btn-text-secondary btn-table-action border-none font-xl"]) }}
    {{ $attributes }} wire:loading.attr="disabled">
    <span {{ $spinner ? 'wire:loading.remove' : '' }}><i class="{{ $icon }}"></i>
        {{ $text }}</span>
    @if ($spinner)
        <span wire:loading>
            <span class="spinner spinner-border spinner-border-sm" role="status"></span>
        </span>
    @endif
</button>
