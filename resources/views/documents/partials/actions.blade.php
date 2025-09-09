<x-tables.link href="{{ route('documents.edit', $item->id) }}" icon="ti ti-edit" wire:navigate />

@if ($item->file_path)
    <x-tables.link href="{{ route('documents.download', $item->id) }}" icon="ti ti-download" title="Download" />
@endif

<x-tables.button icon="ti ti-trash" wire:click="$set('documentId', {{ $item->id }})" modal="delete-modal" />
