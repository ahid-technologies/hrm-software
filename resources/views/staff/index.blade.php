<div>
    <x-modals.delete />

    <x-ui.page-header title="Staff Management" description="Manage your staff members">
        <x-ui.link color="primary" text="Add New Staff" href="{{ route('staff.create') }}" class="btn btn-sm btn-md-md" />
    </x-ui.page-header>

    <div class="my-4">
        <div class="container-xl">
            <x-tables.table :items="$staff" :columns="[
                'employee_id' => 'Employee ID',
                'name' => 'Name',
                'email' => 'Email',
                'ni_number' => 'NI Number',
                'utr_number' => 'UTR Number',
                'position' => 'Position',
                'department' => 'Department',
                'joining_date' => 'Joining Date',
                'documents' => 'Documents',
                'status' => 'Status',
            ]" :formatters="[
                'employee_id' => fn($item) => $item->employee_id,
                'name' => fn($item) => $item->full_name,
                'email' => fn($item) => $item->email,
                'ni_number' => fn($item) => $item->ni_number ?? 'N/A',
                'utr_number' => fn($item) => $item->utr_number ?? 'N/A',
                'position' => fn($item) => $item->position,
                'department' => fn($item) => $item->department ?? 'N/A',
                'joining_date' => fn($item) => $item->joining_date->format('M d, Y'),
                'documents' => fn($item) => view('components.badges.number', [
                    'value' => $item->documents_count,
                    'color' => 'info',
                ]),
                'status' => fn($item) => view('staff.partials.status', ['staff' => $item]),
            ]" showActions="true"
                actionView="staff.partials.actions" />
        </div>
    </div>
</div>
