{{-- backend/attendance/form.blade.php --}}
<div>
    <x-ui.page-header :title="$attendanceId ? 'Edit Attendance' : 'Add Attendance'" description="Manage staff attendance records" />

    <div class="my-4">
        <div class="container-xl">
            <form wire:submit.prevent="save" class="card">
                <div class="card-body">
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

                            <div class="mb-3">
                                <label class="form-label required">Date</label>
                                <input type="date" class="form-control" wire:model="date" required>
                                @error('date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Check In Time</label>
                                        <input type="time" class="form-control" wire:model="check_in">
                                        @error('check_in')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Check Out Time</label>
                                        <input type="time" class="form-control" wire:model="check_out">
                                        @error('check_out')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Status</label>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="status" value="present"
                                            class="form-selectgroup-input" wire:model="status">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Present</strong>
                                                <div class="text-secondary">Full day attendance</div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="status" value="late"
                                            class="form-selectgroup-input" wire:model="status">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Late</strong>
                                                <div class="text-secondary">Late arrival</div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="status" value="half_day"
                                            class="form-selectgroup-input" wire:model="status">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Half Day</strong>
                                                <div class="text-secondary">Partial attendance</div>
                                            </div>
                                        </div>
                                    </label>
                                    <label class="form-selectgroup-item flex-fill">
                                        <input type="radio" name="status" value="absent"
                                            class="form-selectgroup-input" wire:model="status">
                                        <div class="form-selectgroup-label d-flex align-items-center p-3">
                                            <div class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </div>
                                            <div>
                                                <strong>Absent</strong>
                                                <div class="text-secondary">No attendance</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Remarks</label>
                                <textarea class="form-control" wire:model="remarks" rows="3" placeholder="Enter any remarks"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ $attendanceId ? 'Update Attendance' : 'Add Attendance' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
