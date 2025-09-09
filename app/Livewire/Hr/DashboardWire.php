<?php

namespace App\Livewire\Hr;

use App\Models\Staff;
use App\Models\Attendance;
use App\Models\Document;
use App\Models\Notification;
use App\Models\WorkCheck;
use App\Services\ExpiryNotificationService;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('HR Dashboard')]
class DashboardWire extends Component
{
    public function render()
    {
        // Basic stats
        $totalStaff = Staff::count();
        $activeStaff = Staff::where('status', 'active')->count();
        $totalDocuments = Document::count();
        $expiringDocuments = Document::expiring(30)->count();
        $unreadNotifications = Notification::unread()->count();

        // Today's attendance
        $todayAttendance = Attendance::where('date', today())->count();

        // Recent notifications (including work check notifications)
        $recentNotifications = Notification::with(['staff', 'document', 'workCheck'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Expiring documents
        $expiringDocs = Document::with('staff')
            ->expiring(30)
            ->orderBy('expiry_date', 'asc')
            ->limit(5)
            ->get();

        // Work Check stats
        $totalWorkChecks = WorkCheck::count();
        $expiringWorkChecks = WorkCheck::where('expiry_date', '<=', Carbon::now()->addDays(30))->count();
        $criticalWorkChecks = WorkCheck::where('expiry_date', '<=', Carbon::now()->addDays(7))->count();

        // Expiring work checks
        $expiringWorkChecksDetails = WorkCheck::with(['staff', 'document'])
            ->where('expiry_date', '>=', now())
            ->where('expiry_date', '<=', now()->addDays(30))
            ->orderBy('expiry_date', 'asc')
            ->limit(5)
            ->get();

        // Get notification statistics
        $notificationService = new ExpiryNotificationService();
        $notificationStats = $this->getNotificationStats();

        return view('hr.dashboard', [
            'totalStaff' => $totalStaff,
            'activeStaff' => $activeStaff,
            'totalDocuments' => $totalDocuments,
            'expiringDocuments' => $expiringDocuments,
            'unreadNotifications' => $unreadNotifications,
            'totalWorkChecks' => $totalWorkChecks,
            'expiringWorkChecks' => $expiringWorkChecks,
            'criticalWorkChecks' => $criticalWorkChecks,
            'todayAttendance' => $todayAttendance,
            'recentNotifications' => $recentNotifications,
            'expiringDocs' => $expiringDocs,
            'expiringWorkChecksDetails' => $expiringWorkChecksDetails,
            'notificationStats' => $notificationStats,
        ]);
    }

    protected function getNotificationStats(): array
    {
        return [
            'document_warnings' => Notification::where('type', 'document_expiry_warning')->unread()->count(),
            'document_critical' => Notification::where('type', 'document_expiry_critical')->unread()->count(),
            'work_check_warnings' => Notification::where('type', 'work_check_expiry_warning')->unread()->count(),
            'work_check_critical' => Notification::where('type', 'work_check_expiry_critical')->unread()->count(),
        ];
    }
}
