<?php

namespace App\Livewire\Notification;

use App\Models\Notification;
use App\Traits\HasPaginationAndSearch;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Notifications Management')]
class NotificationWire extends Component
{
    use WithPagination, HasPaginationAndSearch;

    public $notificationId;
    public $filterType;
    public $filterRead;
    public $selectedNotification;
    public $showViewModal = false;

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();

        $this->dispatch('success', message: 'Notification marked as read.');
    }

    public function viewNotification($id)
    {
        $this->selectedNotification = Notification::with(['staff', 'document', 'workCheck'])->findOrFail($id);

        // Mark as read when viewed
        if (!$this->selectedNotification->is_read) {
            $this->selectedNotification->markAsRead();
        }

        $this->showViewModal = true;
    }

    public function closeViewModal()
    {
        $this->showViewModal = false;
        $this->selectedNotification = null;
    }

    public function markAllAsRead()
    {
        Notification::where('is_read', false)->update(['is_read' => true]);

        $this->dispatch('success', message: 'All notifications marked as read.');
    }

    #[On('confirm-delete')]
    public function confirmDelete($id)
    {
        $this->notificationId = $id;
    }

    public function destroy()
    {
        $notification = Notification::findOrFail($this->notificationId);
        $notification->delete();

        $this->reset('notificationId');
        $this->dispatch('success', message: 'Notification deleted successfully.');
    }

    #[On('notification-saved')]
    public function render()
    {
        $notifications = Notification::with(['staff', 'document'])
            ->when($this->filterType, function ($query) {
                return $query->where('type', $this->filterType);
            })
            ->when($this->filterRead !== null, function ($query) {
                return $query->where('is_read', $this->filterRead);
            })
            ->when($this->searchQuery, function ($query) {
                return $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('message', 'like', '%' . $this->searchQuery . '%')
                        ->orWhereHas('staff', function ($staffQuery) {
                            $staffQuery->where('first_name', 'like', '%' . $this->searchQuery . '%')
                                ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%');
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);

        $notificationTypes = [
            'document_expiry_warning' => 'Document Expiry Warning',
            'document_expiry_critical' => 'Document Expiry Critical',
            'work_check_expiry_warning' => 'Work Check Expiry Warning',
            'work_check_expiry_critical' => 'Work Check Expiry Critical',
            'attendance_alert' => 'Attendance Alert',
            'general' => 'General'
        ];

        return view('notifications.index', [
            'notifications' => $notifications,
            'notificationTypes' => $notificationTypes,
        ]);
    }
}
