@props(['status', 'lt' => false])

@php
    $statusClasses = [
        'quotation' => 'bg-pink',
        'received' => 'bg-cyan',
        'diagnosing' => 'bg-yellow',
        'waiting_for_parts' => 'bg-secondary',
        'approved' => 'bg-green',
        'in_progress' => 'bg-blue',
        'awaiting_customer_response' => 'bg-orange',
        'repaired' => 'bg-teal',
        'quality_check' => 'bg-purple',
        'completed' => 'bg-lime',
        'awaiting_pickup' => 'bg-light',
        'picked_up' => 'bg-dark',
        'shipped' => 'bg-azure',
        'returned' => 'bg-red',
        'canceled' => 'bg-pink',
        'not_repairable' => 'bg-brown',
        'refunded' => 'bg-indigo',
    ];

    $bgClass = $statusClasses[$status] ?? 'bg-secondary';
    $bgColor = str_replace('bg-', '', $bgClass);
    $class = 'badge ' . ($lt ? "{$bgClass}-lt" : "$bgClass text-$bgColor-fg");
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>
    {{ ucwords(str_replace('_', ' ', $status)) }}
</span>
