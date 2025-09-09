<div>
    <x-modals.delete />

    <x-ui.page-header title="Work Check Management" description="Manage work authorization checks for staff">
        <x-ui.link color="primary" text="Add New Work Check" href="{{ route('work-checks.create') }}"
            class="btn btn-sm btn-md-md" />
    </x-ui.page-header>

    <div class="my-4">
        <div class="container-xl">
            <x-tables.table :items="$workChecks" :columns="[
                'employee_name' => 'Employee Name',
                'check_date' => 'Check Date',
                'document' => 'Document Checked',
                'checked_by' => 'Checked By',
                'expiry_date' => 'Expiry Date',
                'status' => 'Status',
            ]" :formatters="[
                'employee_name' => fn($item) => $item->staff->full_name,
                'check_date' => fn($item) => $item->check_date->format('M d, Y'),
                'document' => fn($item) => $item->document->document_type . ' - ' . $item->document->document_number,
                'checked_by' => fn($item) => $item->checked_by,
                'expiry_date' => fn($item) => $item->expiry_date->format('M d, Y'),
                'status' => fn($item) => view('work-check.partials.status', ['workCheck' => $item]),
            ]" showActions="true"
                actionView="work-check.partials.actions" />
        </div>
    </div>
</div>
