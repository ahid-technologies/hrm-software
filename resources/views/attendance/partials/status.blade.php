@php
    $statusConfig = [
        'present' => ['class' => 'bg-green text-green-fg', 'text' => 'Present', 'icon' => 'check'],
        'absent' => ['class' => 'bg-red text-red-fg', 'text' => 'Absent', 'icon' => 'x'],
        'late' => ['class' => 'bg-yellow text-yellow-fg', 'text' => 'Late', 'icon' => 'clock'],
        'half_day' => ['class' => 'bg-blue text-blue-fg', 'text' => 'Half Day', 'icon' => 'clock-hour-6'],
    ];
    $config = $statusConfig[$attendance->status] ?? [
        'class' => 'bg-secondary',
        'text' => ucfirst($attendance->status),
        'icon' => 'help',
    ];
@endphp

<span class="badge {{ $config['class'] }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler me-1" width="16" height="16" viewBox="0 0 24 24"
        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        @switch($config['icon'])
            @case('check')
                <polyline points="20,6 9,17 4,12"></polyline>
            @break

            @case('x')
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            @break

            @case('clock')
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12,6 12,12 16,14"></polyline>
            @break

            @case('clock-hour-6')
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12,6 12,12"></polyline>
                <polyline points="12,12 12,18"></polyline>
            @break

            @default
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="9" y1="9" x2="15" y2="15"></line>
                <line x1="15" y1="9" x2="9" y2="15"></line>
        @endswitch
    </svg>
    {{ $config['text'] }}
</span>
