<div>
    <x-ui.page-header title="Settings" description="Configure system settings and preferences" />

    <div class="my-4">
        <div class="container-xl">
            {{-- Settings Navigation Tabs --}}
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#notifications"
                                class="nav-link {{ $activeTab === 'notifications' ? 'active' : '' }}"
                                wire:click="setActiveTab('notifications')" data-bs-toggle="tab"
                                aria-selected="{{ $activeTab === 'notifications' ? 'true' : 'false' }}" role="tab">
                                <i class="ti ti-bell me-1"></i>
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#branding" class="nav-link {{ $activeTab === 'branding' ? 'active' : '' }}"
                                wire:click="setActiveTab('branding')" data-bs-toggle="tab"
                                aria-selected="{{ $activeTab === 'branding' ? 'true' : 'false' }}" role="tab">
                                <i class="ti ti-palette me-1"></i>
                                Branding
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        {{-- Notifications Tab --}}
                        <div class="tab-pane {{ $activeTab === 'notifications' ? 'active show' : '' }}"
                            id="notifications" role="tabpanel">
                            @if ($activeTab === 'notifications')
                                @livewire('settings.notification-settings')
                            @endif
                        </div>

                        {{-- Branding Tab --}}
                        <div class="tab-pane {{ $activeTab === 'branding' ? 'active show' : '' }}" id="branding"
                            role="tabpanel">
                            @if ($activeTab === 'branding')
                                @livewire('settings.branding-settings')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
