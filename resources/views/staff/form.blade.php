<div>
    <x-ui.page-header :title="$staffId ? 'Edit Staff Member' : 'Add New Staff'" description="Manage staff information" />

    <div class="my-4">
        <div class="container-xl">
            <form wire:submit.prevent="save" class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <x-forms.input name="employee_id" label="Employee ID" wire:model="employee_id"
                                        required placeholder="Enter employee ID" />
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Status</label>
                                        <div class="form-selectgroup">
                                            <label class="form-selectgroup-item">
                                                <input type="radio" name="status" value="active"
                                                    class="form-selectgroup-input" wire:model="status">
                                                <span class="form-selectgroup-label">Active</span>
                                            </label>
                                            <label class="form-selectgroup-item">
                                                <input type="radio" name="status" value="inactive"
                                                    class="form-selectgroup-input" wire:model="status">
                                                <span class="form-selectgroup-label">Inactive</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <x-forms.input name="first_name" label="First Name" wire:model="first_name" required
                                        placeholder="Enter first name" />
                                </div>
                                <div class="col-md-6">
                                    <x-forms.input name="last_name" label="Last Name" wire:model="last_name" required
                                        placeholder="Enter last name" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <x-forms.input name="email" type="email" label="Email" wire:model="email"
                                        required placeholder="Enter email address" />
                                </div>
                                <div class="col-md-6">
                                    <x-forms.input name="phone" label="Phone" wire:model="phone"
                                        placeholder="Enter phone number" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <x-forms.input name="ni_number" label="National Insurance Number"
                                        wire:model="ni_number" placeholder="e.g. AB123456C" maxlength="13" />
                                    @error('ni_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <x-forms.input name="utr_number" label="Unique Tax Reference"
                                        wire:model="utr_number" placeholder="Enter 10-digit UTR number"
                                        maxlength="10" />
                                    @error('utr_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" wire:model="date_of_birth">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label required">Joining Date</label>
                                        <input type="date" class="form-control" wire:model="joining_date" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" wire:model="address" rows="2" placeholder="Enter address"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <x-forms.input name="position" label="Position" wire:model="position" required
                                        placeholder="Enter position" />
                                </div>
                                <div class="col-md-6">
                                    <x-forms.input name="department" label="Department" wire:model="department"
                                        placeholder="Enter department" />
                                </div>
                            </div>

                            <div class="mb-3">
                                <x-forms.input name="basic_salary" type="number" label="Basic Salary"
                                    wire:model="basic_salary" step="0.01" placeholder="Enter basic salary" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ $staffId ? 'Update Staff' : 'Add Staff' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
