{{-- backend/documents/index.blade.php --}}
<div>
    <x-modals.delete />
    <x-ui.page-header title="Documents Management" description="Manage staff documents and track expiries">
        <x-ui.link color="primary" text="Add Document" href="{{ route('documents.create') }}"
            class="btn btn-sm btn-md-md" />
    </x-ui.page-header>

    <div class="my-4">
        <div class="container-xl">
            {{-- Filters --}}
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Document Type</label>
                                <select class="form-select" wire:model.live="filterType">
                                    <option value="">All Types</option>
                                    @foreach ($documentTypes as $type)
                                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Staff Member</label>
                                <select class="form-select" wire:model.live="filterStaff">
                                    <option value="">All Staff</option>
                                    @foreach ($staff as $member)
                                        <option value="{{ $member->id }}">{{ $member->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-check form-switch mt-4">
                                    <input class="form-check-input" type="checkbox" wire:model.live="filterExpiring">
                                    <span class="form-check-label">Show Expiring Soon</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-tables.table :items="$documents" :columns="[
                'staff' => 'Staff',
                'document_type' => 'Type',
                'document_number' => 'Number',
                'issue_date' => 'Issue Date',
                'expiry_date' => 'Expiry Date',
                'status' => 'Status',
                'file' => 'File',
            ]" :formatters="[
                'staff' => fn($item) => view('documents.partials.staff', ['document' => $item]),
                'document_type' => fn($item) => view('documents.partials.type', ['document' => $item]),
                'document_number' => fn($item) => $item->document_number ?? 'N/A',
                'issue_date' => fn($item) => $item->issue_date ? $item->issue_date->format('M d, Y') : 'N/A',
                'expiry_date' => fn($item) => $item->expiry_date ? $item->expiry_date->format('M d, Y') : 'N/A',
                'status' => fn($item) => view('documents.partials.status', ['document' => $item]),
                'file' => fn($item) => view('documents.partials.file', ['document' => $item]),
            ]" showActions="true"
                actionView="documents.partials.actions" />
        </div>
    </div>
</div>
