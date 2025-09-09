{{-- backend/documents/form.blade.php --}}
<div>
    <x-ui.page-header :title="$documentId ? 'Edit Document' : 'Add New Document'" description="Manage staff documents" />

    <div class="my-4">
        <div class="container-xl">
            <form wire:submit.prevent="save" class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Staff Member</label>
                                        <select class="form-select" wire:model="staff_id" required>
                                            <option value="">Select Staff Member</option>
                                            @foreach ($staff as $member)
                                                <option value="{{ $member->id }}">{{ $member->employee_id }} -
                                                    {{ $member->full_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('staff_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Document Type</label>
                                        <select class="form-select" wire:model="document_type" required>
                                            @foreach ($documentTypes as $key => $type)
                                                <option value="{{ $key }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('document_type')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <x-forms.input name="document_number" label="Document Number"
                                        wire:model="document_number" placeholder="Enter document number" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Issue Date</label>
                                        <input type="date" class="form-control" wire:model="issue_date">
                                        @error('issue_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="date" class="form-control" wire:model="expiry_date">
                                        @error('expiry_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" wire:model="notes" rows="3" placeholder="Enter any notes about the document"></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Document File</label>
                                        <input type="file" class="form-control" wire:model="file"
                                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                        <small class="form-hint">Supported formats: PDF, JPG, PNG, DOC, DOCX (Max:
                                            2MB)</small>
                                        @error('file')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

                                        @if ($currentFile)
                                            <div class="mt-2">
                                                <div class="alert alert-info">
                                                    <strong>Current file:</strong> {{ $currentFile }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ $documentId ? 'Update Document' : 'Add Document' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
