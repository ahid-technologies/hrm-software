<span class="badge bg-{{ $staff->isActive() ? 'success' : 'secondary' }}-lt">
    {{ $staff->isActive() ? 'Active' : 'Inactive' }}
</span>
