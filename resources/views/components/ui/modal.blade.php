{{-- resources/views/components/ui/modal.blade.php --}}
@props([
    'id',
    'title' => 'Modal',
    'size' => 'md', // Options: sm, md, lg, xl
    'centered' => false,
    'scrollable' => false,
])

{{-- Define size classes --}}
@php
    $sizeClasses = [
        'sm' => 'modal-sm',
        'md' => '',
        'lg' => 'modal-lg',
        'xl' => 'modal-xl',
    ];

    $modalDialogClasses = [
        'modal-dialog',
        $sizeClasses[$size] ?? '',
        $centered ? 'modal-dialog-centered' : '',
        $scrollable ? 'modal-dialog-scrollable' : '',
    ];
@endphp

<div wire:ignore.self class="modal modal-blur fade" id="{{ $id }}" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="{{ implode(' ', array_filter($modalDialogClasses)) }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>

            @if (isset($footer))
                <div class="modal-footer">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Add custom script to handle modal events --}}
@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            const modal = document.getElementById('{{ $id }}');

            // Handle success event to close modal
            @this.on('success', () => {
                var modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }
            });

            // Optional: Add any additional modal event listeners
            modal.addEventListener('show.bs.modal', function(event) {
                // You can add custom logic here if needed
            });
        });
    </script>
@endpush
