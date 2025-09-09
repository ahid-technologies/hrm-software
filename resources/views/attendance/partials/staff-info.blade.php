<div class="d-flex align-items-center">
    <div class="avatar avatar-sm me-2"
        style="background-image: url('{{ $attendance->staff->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($attendance->staff->full_name ?? 'N/A') . '&background=random' }}')">
    </div>
    <div>
        <div class="fw-medium">{{ $attendance->staff->full_name ?? 'N/A' }}</div>
        <div class="text-muted small">{{ $attendance->staff->position ?? 'N/A' }}</div>
    </div>
</div>
