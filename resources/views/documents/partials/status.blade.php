@if ($document->expiry_date)
    @if ($document->expiry_date < now())
        <span class="badge bg-danger bg-danger-fg">Expired</span>
    @elseif($document->is_expiring)
        <span class="badge bg-warning text-warning-fg">Expiring Soon</span>
        <div class="text-secondary small mt-1">{{ round($document->days_until_expiry, 2) }} days left</div>
    @else
        <span class="badge bg-success text-success-fg">Valid</span>
    @endif
@else
    <span class="badge bg-secondary text-secondary-fg">No Expiry</span>
@endif
