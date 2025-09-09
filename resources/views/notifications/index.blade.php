{{-- backend/notifications/index.blade.php --}}
<div>
    <x-modals.delete />

    {{-- View Notification Modal --}}
    @if ($showViewModal && $selectedNotification)
        <div class="modal modal-blur fade show" id="view-modal" tabindex="-1" role="dialog" aria-modal="true"
            style="display: block;">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="ti ti-bell me-2"></i>
                            Notification Details
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeViewModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                {{-- Notification Header --}}
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="card-title">{{ $selectedNotification->title }}</h3>
                                                <div class="text-secondary">
                                                    {{ $selectedNotification->created_at->format('M d, Y H:i') }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                @if ($selectedNotification->type === 'document_expiry_warning')
                                                    <span class="badge bg-yellow text-yellow-fg">Document Warning</span>
                                                @elseif ($selectedNotification->type === 'document_expiry_critical')
                                                    <span class="badge bg-red text-red-fg">Document Critical</span>
                                                @elseif ($selectedNotification->type === 'work_check_expiry_warning')
                                                    <span class="badge bg-orange text-orange-fg">Work Check
                                                        Warning</span>
                                                @elseif ($selectedNotification->type === 'work_check_expiry_critical')
                                                    <span class="badge bg-red text-red-fg">Work Check Critical</span>
                                                @else
                                                    <span
                                                        class="badge bg-blue text-blue-fg">{{ ucfirst(str_replace('_', ' ', $selectedNotification->type)) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Message Content --}}
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Message</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">{{ $selectedNotification->message }}</p>
                                    </div>
                                </div>

                                {{-- Related Information --}}
                                @if ($selectedNotification->staff)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h3 class="card-title">Related Staff Member</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <strong>Name:</strong> {{ $selectedNotification->staff->full_name }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Employee ID:</strong>
                                                    {{ $selectedNotification->staff->employee_id }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Position:</strong>
                                                    {{ $selectedNotification->staff->position }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Department:</strong>
                                                    {{ $selectedNotification->staff->department ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Document Information --}}
                                @if ($selectedNotification->document)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h3 class="card-title">Related Document</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <strong>Document Type:</strong>
                                                    {{ ucfirst($selectedNotification->document->document_type) }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Document Number:</strong>
                                                    {{ $selectedNotification->document->document_number ?? 'N/A' }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Issue Date:</strong>
                                                    {{ $selectedNotification->document->issue_date ? $selectedNotification->document->issue_date->format('M d, Y') : 'N/A' }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Expiry Date:</strong>
                                                    {{ $selectedNotification->document->expiry_date ? $selectedNotification->document->expiry_date->format('M d, Y') : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Work Check Information --}}
                                @if ($selectedNotification->workCheck)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h3 class="card-title">Related Work Check</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <strong>Document Type:</strong>
                                                    {{ ucfirst($selectedNotification->workCheck->document->document_type) }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Checked By:</strong>
                                                    {{ $selectedNotification->workCheck->checked_by ?? 'N/A' }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Check Date:</strong>
                                                    {{ $selectedNotification->workCheck->check_date ? $selectedNotification->workCheck->check_date->format('M d, Y') : 'N/A' }}
                                                </div>
                                                <div class="col-sm-6">
                                                    <strong>Expiry Date:</strong>
                                                    {{ $selectedNotification->workCheck->expiry_date ? $selectedNotification->workCheck->expiry_date->format('M d, Y') : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeViewModal">Close</button>
                        @if (!$selectedNotification->is_read)
                            <button type="button" class="btn btn-primary"
                                wire:click="markAsRead({{ $selectedNotification->id }})">
                                Mark as Read
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif

    <x-ui.page-header title="Notifications" description="Manage system notifications and alerts">
        <button class="btn btn-primary btn-sm" wire:click="markAllAsRead">
            Mark All as Read
        </button>
    </x-ui.page-header>

    <div class="my-4">
        <div class="container-xl">
            {{-- Filters --}}
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select class="form-select" wire:model.live="filterType">
                                    <option value="">All Types</option>
                                    @foreach ($notificationTypes as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" wire:model.live="filterRead">
                                    <option value="">All Notifications</option>
                                    <option value="0">Unread Only</option>
                                    <option value="1">Read Only</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-tables.table :items="$notifications" :columns="[
                'title' => 'Title',
                'staff' => 'Staff',
                'type' => 'Type',
                'message' => 'Message',
                'created_at' => 'Created',
                'status' => 'Status',
            ]" :formatters="[
                'title' => fn($item) => view('notifications.partials.title', ['notification' => $item]),
                'staff' => fn($item) => $item->staff ? $item->staff->full_name : 'System',
                'type' => fn($item) => view('notifications.partials.type', ['notification' => $item]),
                'message' => fn($item) => Str::limit($item->message, 50),
                'created_at' => fn($item) => $item->created_at->format('M d, Y H:i'),
                'status' => fn($item) => view('notifications.partials.status', ['notification' => $item]),
            ]" showActions="true"
                actionView="notifications.partials.actions" />
        </div>
    </div>
</div>
