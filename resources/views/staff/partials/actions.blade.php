<x-tables.link href="{{ route('staff.edit', $item->id) }}" icon="ti ti-edit" wire:navigate />

<x-tables.link href="{{ route('documents.index', ['filterStaff' => $item->id]) }}" icon="ti ti-file-text"
    title="View Documents" />

<x-tables.link href="{{ route('attendance.index', ['filterStaff' => $item->id]) }}" icon="ti ti-calendar"
    title="View Attendance" />

<x-tables.button icon="ti ti-trash" wire:click="$dispatch('confirm-delete', { id: {{ $item->id }} })"
    modal="delete-modal" />
