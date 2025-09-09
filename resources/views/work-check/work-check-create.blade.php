<div>
    <x-ui.page-header title="Add New Work Check" description="Create a new work authorization check record" />

    <div class="my-4">
        <div class="container-xl">
            <form wire:submit.prevent="save" class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Employee Name</label>
                                <select class="form-select" wire:model="staff_id" required>
                                    <option value="">Select Employee</option>
                                    @foreach ($staff as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->full_name }}
                                            ({{ $employee->employee_id }})</option>
                                    @endforeach
                                </select>
                                @error('staff_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <x-forms.input name="check_date" type="date" label="Date of Check"
                                wire:model="check_date" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Document Checked</label>
                                <select class="form-select" wire:model="document_id" required>
                                    <option value="">Select Document</option>
                                    @foreach ($documents as $document)
                                        <option value="{{ $document->id }}">
                                            {{ $document->document_type }} - {{ $document->document_number }}
                                            ({{ $document->staff->full_name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('document_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <x-forms.input name="checked_by" label="Checked By" wire:model="checked_by" required
                                placeholder="Enter who performed the check" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-forms.input name="expiry_date" type="date" label="Expiry Date"
                                wire:model="expiry_date" required />
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" wire:model="notes" rows="3" placeholder="Enter any additional notes or comments"></textarea>
                                @error('notes')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('work-checks.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Create Work Check</span>
                            <span wire:loading>Creating...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
