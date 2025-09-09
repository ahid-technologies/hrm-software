@switch($notification->type)
    @case('document_expiry')
        <span class="badge bg-warning text-warning-fg">Document Expiry</span>
    @break

    @case('attendance_alert')
        <span class="badge bg-info text-info-fg">Attendance Alert</span>
    @break

    @case('general')
        <span class="badge bg-secondary text-secondary-fg">General</span>
    @break

    @default
        <span class="badge bg-secondary text-secondary-fg">{{ ucfirst($notification->type) }}</span>
@endswitch
