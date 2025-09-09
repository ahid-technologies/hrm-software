<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\Notification;
use Illuminate\Console\Command;

class CheckDocumentExpiries extends Command
{
    protected $signature = 'hr:check-expiries';
    protected $description = 'Check for expiring documents and create notifications';

    public function handle()
    {
        $this->info('Checking for expiring documents...');

        // Check documents expiring in 30, 15, and 7 days
        $expiryPeriods = [30, 15, 7, 1];

        foreach ($expiryPeriods as $days) {
            $expiringDocuments = Document::with('staff')
                ->whereNotNull('expiry_date')
                ->whereDate('expiry_date', now()->addDays($days))
                ->get();

            foreach ($expiringDocuments as $document) {
                // Check if notification already exists for this period
                $existingNotification = Notification::where('document_id', $document->id)
                    ->where('type', 'document_expiry')
                    ->whereDate('created_at', today())
                    ->first();

                if (!$existingNotification) {
                    Notification::create([
                        'staff_id' => $document->staff_id,
                        'document_id' => $document->id,
                        'type' => 'document_expiry',
                        'title' => ucfirst($document->document_type) . ' Expiring Soon',
                        'message' => "The {$document->document_type} for {$document->staff->full_name} will expire in {$days} day(s) on {$document->expiry_date->format('M d, Y')}.",
                        'scheduled_at' => now(),
                    ]);

                    $this->info("Created notification for {$document->staff->full_name}'s {$document->document_type} expiring in {$days} days");
                }
            }
        }

        // Mark expired documents
        $expiredDocuments = Document::whereNotNull('expiry_date')
            ->where('expiry_date', '<', now())
            ->where('is_expired', false)
            ->get();

        foreach ($expiredDocuments as $document) {
            $document->update(['is_expired' => true]);

            Notification::create([
                'staff_id' => $document->staff_id,
                'document_id' => $document->id,
                'type' => 'document_expiry',
                'title' => ucfirst($document->document_type) . ' Expired',
                'message' => "The {$document->document_type} for {$document->staff->full_name} has expired on {$document->expiry_date->format('M d, Y')}.",
                'scheduled_at' => now(),
            ]);

            $this->warn("Marked {$document->staff->full_name}'s {$document->document_type} as expired");
        }

        $this->info('Document expiry check completed successfully!');
        return 0;
    }
}
