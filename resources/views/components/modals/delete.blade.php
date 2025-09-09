@props([
    'cancelAction' => '',
    'submitAction' => 'destroy',
])

<div class="modal modal-blur fade delete-modal" id="delete-modal" wire:ignore.self tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-danger"></div>
            <div class="modal-body text-center py-4">
                <i class="ti ti-alert-triangle mb-2 text-danger font-6xl"></i>
                <h3>Are you sure?</h3>
                <div class="text-secondary">Are you sure you want to delete this record? You will not be able to revert
                    this action.</div>
            </div>
            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col">
                            <button wire.loading.attr="disabled" wire:click="{{ $cancelAction }}"
                                class="btn btn-3 w-100" data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                        <div class="col">
                            <button wire.loading.attr="disabled" wire:click="{{ $submitAction }}"
                                class="btn btn-danger btn-4 w-100" data-bs-dismiss="modal">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
