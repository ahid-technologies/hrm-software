<div>
    <!-- Page Header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler me-2" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <rect x="4" y="5" width="16" height="16" rx="2" />
                            <line x1="16" y1="3" x2="16" y2="7" />
                            <line x1="8" y1="3" x2="8" y2="7" />
                            <line x1="4" y1="11" x2="20" y2="11" />
                            <rect x="8" y="15" width="2" height="2" />
                        </svg>
                        Attendance Calendar
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="9" y1="6" x2="20" y2="6" />
                                <line x1="9" y1="12" x2="20" y2="12" />
                                <line x1="9" y1="18" x2="20" y2="18" />
                                <line x1="5" y1="6" x2="5" y2="6.01" />
                                <line x1="5" y1="12" x2="5" y2="12.01" />
                                <line x1="5" y1="18" x2="5" y2="18.01" />
                            </svg>
                            List View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">
        <div class="container-xl">
            <!-- Calendar Controls -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    <button wire:click="previousMonth" class="btn btn-outline-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="15,18 9,12 15,6"></polyline>
                                        </svg>
                                    </button>
                                </div>
                                <div class="col text-center">
                                    <h3 class="mb-0">{{ $monthName }}</h3>
                                </div>
                                <div class="col-auto">
                                    <button wire:click="nextMonth" class="btn btn-outline-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="9,18 15,12 9,6"></polyline>
                                        </svg>
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <button wire:click="goToToday" class="btn btn-primary btn-sm">Today</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label">View Mode</label>
                                    <select wire:model.live="viewMode" class="form-select">
                                        <option value="all">All Staff</option>
                                        <option value="individual">Individual Staff</option>
                                    </select>
                                </div>
                                @if ($viewMode === 'individual')
                                    <div class="col-md-6">
                                        <label class="form-label">Select Staff</label>
                                        <select wire:model.live="selectedStaff" class="form-select">
                                            <option value="">Choose Staff</option>
                                            @foreach ($staff as $member)
                                                <option value="{{ $member->id }}">{{ $member->first_name }}
                                                    {{ $member->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Statistics -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm border-0 bg-green-lt">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-green text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20,6 9,17 4,12"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        {{ $monthlyStats['total_present'] }}</div>
                                                    <div class="text-muted">Present</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm border-0 bg-red-lt">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-red text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6"
                                                                y2="18"></line>
                                                            <line x1="6" y1="6" x2="18"
                                                                y2="18"></line>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">{{ $monthlyStats['total_absent'] }}
                                                    </div>
                                                    <div class="text-muted">Absent</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm border-0 bg-yellow-lt">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-yellow text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <polyline points="12,6 12,12 16,14"></polyline>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">{{ $monthlyStats['total_late'] }}
                                                    </div>
                                                    <div class="text-muted">Late</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card card-sm border-0 bg-blue-lt">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-blue text-white avatar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M12 2v6l3-3"></path>
                                                            <path d="M12 8v6l3-3"></path>
                                                            <circle cx="12" cy="20" r="2"></circle>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium">
                                                        {{ $monthlyStats['total_half_day'] }}</div>
                                                    <div class="text-muted">Half Day</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th class="text-center">Sun</th>
                                    <th class="text-center">Mon</th>
                                    <th class="text-center">Tue</th>
                                    <th class="text-center">Wed</th>
                                    <th class="text-center">Thu</th>
                                    <th class="text-center">Fri</th>
                                    <th class="text-center">Sat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (collect($calendarDays)->chunk(7) as $week)
                                    <tr>
                                        @foreach ($week as $day)
                                            <td class="calendar-day {{ $day->month != $currentMonth ? 'text-muted' : '' }} {{ $day->isToday() ? 'bg-primary-lt' : '' }}"
                                                style="height: 120px; vertical-align: top; width: 14.28%;">
                                                <div class="d-flex flex-column h-100">
                                                    <div class="fw-bold mb-1">{{ $day->day }}</div>
                                                    <div class="flex-fill">
                                                        @php
                                                            $dayAttendance = $attendanceData->get(
                                                                $day->format('Y-m-d'),
                                                                collect(),
                                                            );
                                                        @endphp

                                                        @if ($dayAttendance->isNotEmpty())
                                                            @if ($viewMode === 'all')
                                                                <!-- Show summary for all staff -->
                                                                @php
                                                                    $statusCounts = $dayAttendance
                                                                        ->groupBy('status')
                                                                        ->map->count();
                                                                @endphp
                                                                @foreach ($statusCounts as $status => $count)
                                                                    <span
                                                                        class="badge badge-sm mb-1
                                                                @switch($status)
                                                                    @case('present') bg-green text-green-fg @break
                                                                    @case('absent') bg-red text-red-fg @break
                                                                    @case('late') bg-yellow text-yellow-fg @break
                                                                    @case('half_day') bg-blue text-blue-fg @break
                                                                    @default bg-secondary
                                                                @endswitch">
                                                                        {{ ucfirst(str_replace('_', ' ', $status)) }}:
                                                                        {{ $count }}
                                                                    </span>
                                                                @endforeach
                                                            @else
                                                                <!-- Show individual staff attendance -->
                                                                @foreach ($dayAttendance as $attendance)
                                                                    <div class="mb-1">
                                                                        <span
                                                                            class="badge badge-sm
                                                                    @switch($attendance->status)
                                                                        @case('present') bg-green text-green-fg @break
                                                                        @case('absent') bg-red text-red-fg @break
                                                                        @case('late') bg-yellow text-yellow-fg @break
                                                                        @case('half_day') bg-blue text-blue-fg @break
                                                                        @default bg-secondary text-secondary-fg
                                                                    @endswitch">
                                                                            {{ ucfirst(str_replace('_', ' ', $attendance->status)) }}
                                                                        </span>
                                                                        @if ($attendance->check_in || $attendance->check_out)
                                                                            <div class="small text-muted">
                                                                                @if ($attendance->check_in)
                                                                                    In:
                                                                                    {{ $attendance->check_in->format('H:i') }}
                                                                                @endif
                                                                                @if ($attendance->check_out)
                                                                                    Out:
                                                                                    {{ $attendance->check_out->format('H:i') }}
                                                                                @endif
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Legend</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="badge bg-green text-green-fg me-2">Present</span>
                                    Employee was present
                                </div>
                                <div class="col-md-3">
                                    <span class="badge bg-red text-red-fg me-2">Absent</span>
                                    Employee was absent
                                </div>
                                <div class="col-md-3">
                                    <span class="badge bg-yellow text-yellow-fg me-2">Late</span>
                                    Employee came late
                                </div>
                                <div class="col-md-3">
                                    <span class="badge bg-blue text-blue-fg me-2">Half Day</span>
                                    Employee worked half day
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
    <style>
        .calendar-day {
            position: relative;
            border: 1px solid #e6e6e6;
        }

        .calendar-day:hover {
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            .calendar-day {
                height: 80px !important;
                font-size: 0.8rem;
            }

            .badge-sm {
                font-size: 0.7rem;
            }
        }
    </style>
@endassets
