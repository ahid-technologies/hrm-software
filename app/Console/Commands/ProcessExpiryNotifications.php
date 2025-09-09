<?php

namespace App\Console\Commands;

use App\Services\ExpiryNotificationService;
use Illuminate\Console\Command;

class ProcessExpiryNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:process-expiry {--type=all : Process notifications for documents, work-checks, or all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process expiry notifications for documents and work checks';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $type = $this->option('type');
        $service = new ExpiryNotificationService();

        $this->info('Processing expiry notifications...');

        try {
            switch ($type) {
                case 'documents':
                    $notifications = $service->checkDocumentExpiries();
                    $this->info("Created " . count($notifications) . " document expiry notifications.");
                    break;

                case 'work-checks':
                    $notifications = $service->checkWorkCheckExpiries();
                    $this->info("Created " . count($notifications) . " work check expiry notifications.");
                    break;

                case 'all':
                default:
                    $results = $service->processAllExpiryNotifications();
                    $this->info("Processing completed:");
                    $this->line("- Document notifications: {$results['document_notifications']}");
                    $this->line("- Work check notifications: {$results['work_check_notifications']}");
                    $this->line("- Total notifications: {$results['total_notifications']}");
                    break;
            }

            $this->info('Expiry notifications processed successfully!');
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error processing expiry notifications: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
