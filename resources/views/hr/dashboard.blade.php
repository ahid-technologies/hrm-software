<div>
    <x-ui.page-header title="HR Dashboard" description="Human Resource Management Overview" />

    <div class="my-4">
        <div class="container-xl">
            {{-- Stats Cards --}}
            <div class="row mb-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">
                                        <i class="ti ti-users"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $totalStaff }} Staff Members
                                    </div>
                                    <div class="text-secondary">
                                        {{ $activeStaff }} Active
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-success text-white avatar">
                                        <i class="ti ti-calendar-check"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $todayAttendance }} Present Today
                                    </div>
                                    <div class="text-secondary">
                                        Out of {{ $activeStaff }} active staff
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-warning text-white avatar">
                                        <i class="ti ti-file-alert"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $expiringDocuments }} Expiring Soon
                                    </div>
                                    <div class="text-secondary">
                                        Out of {{ $totalDocuments }} documents
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-info text-white avatar">
                                        <i class="ti ti-bell"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $unreadNotifications }} Notifications
                                    </div>
                                    <div class="text-secondary">
                                        Unread alerts
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Work Check Stats Row --}}
            <div class="row mb-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-purple text-white avatar">
                                        <i class="ti ti-file-check"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $totalWorkChecks }} Work Checks
                                    </div>
                                    <div class="text-secondary">
                                        Total authorization checks
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-yellow text-white avatar">
                                        <i class="ti ti-alert-triangle"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $expiringWorkChecks }} Expiring Soon
                                    </div>
                                    <div class="text-secondary">
                                        Work checks need renewal
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-red text-white avatar">
                                        <i class="ti ti-alert-triangle"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        {{ $criticalWorkChecks }} Critical
                                    </div>
                                    <div class="text-secondary">
                                        Require immediate attention
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-teal text-white avatar">
                                        <i class="ti ti-settings"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">
                                        <a href="{{ route('settings.notifications') }}" class="text-decoration-none">
                                            Settings
                                        </a>
                                    </div>
                                    <div class="text-secondary">
                                        Configure notifications
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Recent Notifications --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Notifications</h3>
                        </div>
                        <div class="card-body">
                            @forelse($recentNotifications as $notification)
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        @if ($notification->type === 'document_expiry')
                                            <span class="avatar avatar-sm bg-warning text-white">
                                                <i class="ti ti-file-alert"></i>
                                            </span>
                                        @else
                                            <span class="avatar avatar-sm bg-info text-white">
                                                <i class="ti ti-bell"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">{{ $notification->title }}</div>
                                        <div class="text-secondary">{{ Str::limit($notification->message, 60) }}</div>
                                        <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No recent notifications</p>
                            @endforelse

                            @if ($recentNotifications->count() > 0)
                                <div class="text-center">
                                    <a href="{{ route('notifications.index') }}" class="btn btn-link">View
                                        All</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Expiring Documents --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Documents Expiring Soon</h3>
                        </div>
                        <div class="card-body">
                            @forelse($expiringDocs as $document)
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <span class="avatar avatar-sm bg-warning text-white">
                                            <i class="ti ti-file"></i>
                                        </span>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">{{ $document->staff->full_name }}</div>
                                        <div class="text-secondary">
                                            {{ ucfirst($document->document_type) }}
                                            @if ($document->document_number)
                                                - {{ $document->document_number }}
                                            @endif
                                        </div>
                                        <div class="text-danger small">
                                            Expires: {{ $document->expiry_date->format('M d, Y') }}
                                            ({{ $document->days_until_expiry }} days)
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No documents expiring soon</p>
                            @endforelse

                            @if ($expiringDocs->count() > 0)
                                <div class="text-center">
                                    <a href="{{ route('documents.index', ['filterExpiring' => true]) }}"
                                        class="btn btn-link">View All</a>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Expiring Work Checks --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Work Checks Expiring Soon</h3>
                        </div>
                        <div class="card-body">
                            @forelse($expiringWorkChecksDetails as $workCheck)
                                <div class="d-flex mb-3">
                                    <div class="me-3">
                                        <span class="avatar avatar-sm bg-purple text-white">
                                            <i class="ti ti-file-check"></i>
                                        </span>
                                    </div>
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">{{ $workCheck->staff->full_name }}</div>
                                        <div class="text-secondary">
                                            {{ ucfirst($workCheck->document->document_type) }}
                                            @if ($workCheck->checked_by)
                                                - Checked by {{ $workCheck->checked_by }}
                                            @endif
                                        </div>
                                        <div class="text-danger small">
                                            Expires: {{ $workCheck->expiry_date->format('M d, Y') }}
                                            ({{ $workCheck->daysUntilExpiry }} days)
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No work checks expiring soon</p>
                            @endforelse

                            @if ($expiringWorkChecksDetails->count() > 0)
                                <div class="text-center">
                                    <a href="{{ route('work-checks.index', ['filterExpiring' => true]) }}"
                                        class="btn btn-link">View All</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Quick Actions</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <a href="{{ route('staff.create') }}" class="btn btn-primary w-100">
                                            <i class="ti ti-user-plus me-2"></i>
                                            Add New Staff
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('attendance.create') }}" class="btn btn-success w-100">
                                            <i class="ti ti-calendar-plus me-2"></i>
                                            Mark Attendance
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('documents.create') }}" class="btn btn-info w-100">
                                            <i class="ti ti-file-plus me-2"></i>
                                            Add Document
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('notifications.index') }}" class="btn btn-warning w-100">
                                            <i class="ti ti-bell me-2"></i>
                                            View Alerts
                                        </a>
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
