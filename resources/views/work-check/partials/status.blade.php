@php
    $daysUntilExpiry = $workCheck->days_until_expiry;
    $isExpiring = $workCheck->isExpiring();
@endphp

@if ($daysUntilExpiry < 0)
    <span class="badge badge-outline text-red">
        Expired {{ abs($daysUntilExpiry) }} day{{ abs($daysUntilExpiry) !== 1 ? 's' : '' }} ago
    </span>
@elseif($isExpiring)
    <span class="badge badge-outline text-yellow">
        Expires in {{ $daysUntilExpiry }} day{{ $daysUntilExpiry !== 1 ? 's' : '' }}
    </span>
@else
    <span class="badge badge-outline text-green">
        Valid ({{ $daysUntilExpiry }} day{{ $daysUntilExpiry !== 1 ? 's' : '' }} left)
    </span>
@endif
