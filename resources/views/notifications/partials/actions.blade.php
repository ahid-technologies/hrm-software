{{-- View Button --}}
<x-tables.button icon="ti ti-eye" wire:click="viewNotification({{ $item->id }})" title="View Details" />

@if (!$item->is_read)
    <x-tables.button icon="ti ti-check" wire:click="markAsRead({{ $item->id }})" title="Mark as Read" />
@endif

<x-tables.button icon="ti ti-trash" wire:click="$dispatch('confirm-delete', { id: {{ $item->id }} })"
    modal="delete-modal" />
