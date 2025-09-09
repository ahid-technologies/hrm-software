<div>
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <h3 class="card-title mb-3">
                <i class="ti ti-file-text me-2"></i>
                Document Expiry Notifications
            </h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <x-forms.input name="document_warning_days" type="number" label="Warning Days"
                            wire:model="document_warning_days" required help="Days before expiry to show warnings" />
                    </div>
                    <div class="col-md-4">
                        <x-forms.input name="document_critical_days" type="number" label="Critical Days"
                            wire:model="document_critical_days" required
                            help="Days before expiry to show critical warnings" />
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Notification Frequency</label>
                            <select class="form-select" wire:model="document_notification_frequency" required>
                                @foreach ($frequencyOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('document_notification_frequency')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="mb-4">
            <h3 class="card-title mb-3">
                <i class="ti ti-file-check me-2"></i>
                Work Check Expiry Notifications
            </h3>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <x-forms.input name="work_check_warning_days" type="number" label="Warning Days"
                            wire:model="work_check_warning_days" required
                            help="Days before work check expiry to show warnings" />
                    </div>
                    <div class="col-md-4">
                        <x-forms.input name="work_check_critical_days" type="number" label="Critical Days"
                            wire:model="work_check_critical_days" required
                            help="Days before work check expiry to show critical warnings" />
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label required">Notification Frequency</label>
                            <select class="form-select" wire:model="work_check_notification_frequency" required>
                                @foreach ($frequencyOptions as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('work_check_notification_frequency')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <h3 class="card-title">
            <i class="ti ti-bell me-2"></i>
            Notification Recipients
        </h3>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-forms.input name="hr_email" type="email" label="HR Email" wire:model="hr_email" required
                        placeholder="hr@company.com" />
                </div>
                <div class="col-md-6">
                    <x-forms.input name="manager_email" type="email" label="Manager Email" wire:model="manager_email"
                        required placeholder="manager@company.com" />
                </div>
            </div>
        </div>

        {{-- Save Button --}}
        <div class="card-footer border-0 bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>
                        <i class="ti ti-device-floppy me-1"></i>
                        Save Notification Settings
                    </span>
                    <span wire:loading>
                        <i class="ti ti-loader-2 me-1 rotating"></i>
                        Saving...
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
