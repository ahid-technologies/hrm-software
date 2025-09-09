@props([
    'icon' => '',
    'title' => '',
    'route' => '',
])

<li class="nav-item">
    <a class="nav-link" wire:current.exact="active" wire:navigate href="{{ $route }}">
        <i class="{{ $icon }} me-2"></i>
        <span class="nav-link-title">
            {{ $title }}
        </span>
    </a>
</li>
