@if ($notification->is_read)
    <span class="badge bg-success text-success-fg">Read</span>
@else
    <span class="badge bg-warning text-warning-fg">Unread</span>
@endif
