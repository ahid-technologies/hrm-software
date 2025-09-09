<x-tables.link href="{{ route('attendance.edit', $item->id) }}" icon="ti ti-edit" wire:navigate />

<x-tables.button icon="ti ti-trash" wire:click="$dispatch('confirm-delete', { id: {{ $item->id }} })"
    modal="delete-modal" />
