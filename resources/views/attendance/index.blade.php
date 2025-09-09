<div>
    <x-modals.delete />
    <x-ui.page-header title="Attendance Management" description="Track staff attendance records">
        <x-ui.link color="primary" text="Add Attendance" href="{{ route('attendance.create') }}"
            class="btn btn-sm btn-md-md" />
    </x-ui.page-header>

    <div class="my-4">
        <div class="container-xl">
            {{-- Filters --}}
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Filter by Date</label>
                                <input type="date" class="form-control" wire:model.live="filterDate">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Filter by Staff</label>
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
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button class="btn btn-outline-primary" wire:click="$set('filterDate', '')">Clear
                                        Date</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-tables.table :items="$attendance" :columns="[
                'staff' => 'Staff',
                'date' => 'Date',
                'check_in' => 'Check In',
                'check_out' => 'Check Out',
                'total_hours' => 'Total Hours',
                'status' => 'Status',
                'remarks' => 'Remarks',
            ]" :formatters="[
                'staff' => fn($item) => view('attendance.partials.staff', ['attendance' => $item]),
                'date' => fn($item) => $item->date->format('M d, Y'),
                'check_in' => fn($item) => $item->check_in ? $item->check_in->format('H:i') : 'N/A',
                'check_out' => fn($item) => $item->check_out ? $item->check_out->format('H:i') : 'N/A',
                'total_hours' => fn($item) => $item->total_hours_formatted,
                'status' => fn($item) => view('attendance.partials.status', ['attendance' => $item]),
                'remarks' => fn($item) => $item->remarks ? Str::limit($item->remarks, 30) : 'N/A',
            ]" showActions="true"
                actionView="attendance.partials.actions" />
        </div>
    </div>
</div>
