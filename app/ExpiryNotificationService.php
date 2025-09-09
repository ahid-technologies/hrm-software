<?php

namespace App;

use App\Models\Document;
use App\Models\Notification;
use App\Models\WorkCheck;
use Carbon\Carbon;

class ExpiryNotificationService
{
    public function checkDocumentExpiries(): array
    {
        $warningDays = config('notifications.document_expiry.warning_days', 30);
        $criticalDays = config('notifications.document_expiry.critical_days', 7);

        $notifications = [];

        // Get documents expiring within warning period
        $expiringDocuments = Document::with('staff')
            ->whereNotNull('expiry_date')
            ->where('expiry_date', '>=', now())
            ->where('expiry_date', '<=', now()->addDays($warningDays))
            ->get();

        foreach ($expiringDocuments as $document) {
            $daysUntilExpiry = now()->diffInDays($document->expiry_date, false);

            // Determine notification type
            $type = $daysUntilExpiry <= $criticalDays ? 'document_expiry_critical' : 'document_expiry_warning';
            $priority = $daysUntilExpiry <= $criticalDays ? 'critical' : 'warning';

            // Check if we've already sent a notification recently
            if (!$this->shouldSendNotification('document', $document->id, $type)) {
                continue;
            }

            $notification = $this->createDocumentExpiryNotification($document, $type, $daysUntilExpiry);
            $notifications[] = $notification;
        }

        return $notifications;
    }

    public function checkWorkCheckExpiries(): array
    {
        $warningDays = config('notifications.work_check_expiry.warning_days', 30);
        $criticalDays = config('notifications.work_check_expiry.critical_days', 14);

        $notifications = [];

        // Get work checks expiring within warning period
        $expiringWorkChecks = WorkCheck::with(['staff', 'document'])
            ->where('expiry_date', '>=', now())
            ->where('expiry_date', '<=', now()->addDays($warningDays))
            ->get();

        foreach ($expiringWorkChecks as $workCheck) {
            $daysUntilExpiry = now()->diffInDays($workCheck->expiry_date, false);

            // Determine notification type
            $type = $daysUntilExpiry <= $criticalDays ? 'work_check_expiry_critical' : 'work_check_expiry_warning';

            // Check if we've already sent a notification recently
            if (!$this->shouldSendNotification('work_check', $workCheck->id, $type)) {
                continue;
            }

            $notification = $this->createWorkCheckExpiryNotification($workCheck, $type, $daysUntilExpiry);
            $notifications[] = $notification;
        }

        return $notifications;
    }

    protected function shouldSendNotification(string $entityType, int $entityId, string $type): bool
    {
        $frequency = $entityType === 'document'
            ? config('notifications.document_expiry.notification_frequency', 'weekly')
            : config('notifications.work_check_expiry.notification_frequency', 'weekly');

        $frequencyDays = config('notifications.frequency_days.' . $frequency, 7);

        $columnName = $entityType === 'document' ? 'document_id' : 'work_check_id';

        $lastNotification = Notification::where($columnName, $entityId)
            ->where('type', $type)
            ->where('created_at', '>=', now()->subDays($frequencyDays))
            ->first();

        return !$lastNotification;
    }

    protected function createDocumentExpiryNotification(Document $document, string $type, int $daysUntilExpiry): Notification
    {
        $isCritical = str_contains($type, 'critical');
        $priority = $isCritical ? 'URGENT' : 'Important';

        $title = $isCritical
            ? "URGENT: Document Expires in {$daysUntilExpiry} days"
            : "Document Expiring Soon - {$daysUntilExpiry} days remaining";

        $message = "The {$document->document_type} (#{$document->document_number}) for {$document->staff->full_name} " .
            "will expire on " . Carbon::parse($document->expiry_date)->format('M d, Y') . ". Please take appropriate action.";

        return Notification::create([
            'staff_id' => $document->staff_id,
            'document_id' => $document->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'scheduled_at' => now(),
        ]);
    }

    protected function createWorkCheckExpiryNotification(WorkCheck $workCheck, string $type, int $daysUntilExpiry): Notification
    {
        $isCritical = str_contains($type, 'critical');
        $priority = $isCritical ? 'URGENT' : 'Important';

        $title = $isCritical
            ? "URGENT: Work Authorization Expires in {$daysUntilExpiry} days"
            : "Work Authorization Expiring Soon - {$daysUntilExpiry} days remaining";

        $message = "The work authorization check for {$workCheck->staff->full_name} " .
            "(Document: {$workCheck->document->document_type}) will expire on " . Carbon::parse($workCheck->expiry_date)->format('M d, Y') . ". " .
            "A new work authorization check may be required.";

        return Notification::create([
            'staff_id' => $workCheck->staff_id,
            'work_check_id' => $workCheck->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'scheduled_at' => now(),
        ]);
    }

    public function processAllExpiryNotifications(): array
    {
        $documentNotifications = $this->checkDocumentExpiries();
        $workCheckNotifications = $this->checkWorkCheckExpiries();

        return [
            'document_notifications' => count($documentNotifications),
            'work_check_notifications' => count($workCheckNotifications),
            'total_notifications' => count($documentNotifications) + count($workCheckNotifications),
        ];
    }
}
