<div class="{{ !$notification->is_read ? 'fw-bold' : '' }}">
    <a href="#" wire:click.prevent="viewNotification({{ $notification->id }})"
        class="text-decoration-none {{ !$notification->is_read ? 'text-primary' : 'text-secondary' }}">
        {{ $notification->title }}
    </a>
</div>
