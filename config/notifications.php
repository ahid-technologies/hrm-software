<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Document Expiry Notifications Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration for document and work check expiry
    | notifications. You can customize when and how often notifications
    | are sent for expiring documents.
    |
    */

    'document_expiry' => [
        /*
        |--------------------------------------------------------------------------
        | Warning Days
        |--------------------------------------------------------------------------
        |
        | Number of days before expiry to start showing warnings
        |
        */
        'warning_days' => env('DOCUMENT_WARNING_DAYS', 30),

        /*
        |--------------------------------------------------------------------------
        | Critical Days
        |--------------------------------------------------------------------------
        |
        | Number of days before expiry to show critical warnings
        |
        */
        'critical_days' => env('DOCUMENT_CRITICAL_DAYS', 7),

        /*
        |--------------------------------------------------------------------------
        | Notification Frequency
        |--------------------------------------------------------------------------
        |
        | How often to send email notifications (in days)
        | Options: daily, weekly, monthly or specific number of days
        |
        */
        'notification_frequency' => env('DOCUMENT_NOTIFICATION_FREQUENCY', 'weekly'),

        /*
        |--------------------------------------------------------------------------
        | Auto Disable Expired Documents
        |--------------------------------------------------------------------------
        |
        | Automatically mark documents as expired when they pass expiry date
        |
        */
        'auto_disable_expired' => env('DOCUMENT_AUTO_DISABLE', true),
    ],

    'work_check_expiry' => [
        /*
        |--------------------------------------------------------------------------
        | Warning Days
        |--------------------------------------------------------------------------
        |
        | Number of days before work check expiry to start showing warnings
        |
        */
        'warning_days' => env('WORK_CHECK_WARNING_DAYS', 30),

        /*
        |--------------------------------------------------------------------------
        | Critical Days
        |--------------------------------------------------------------------------
        |
        | Number of days before work check expiry to show critical warnings
        |
        */
        'critical_days' => env('WORK_CHECK_CRITICAL_DAYS', 14),

        /*
        |--------------------------------------------------------------------------
        | Notification Frequency
        |--------------------------------------------------------------------------
        |
        | How often to send email notifications for work check expiry (in days)
        |
        */
        'notification_frequency' => env('WORK_CHECK_NOTIFICATION_FREQUENCY', 'weekly'),

        /*
        |--------------------------------------------------------------------------
        | Auto Create Follow-up Checks
        |--------------------------------------------------------------------------
        |
        | Automatically create follow-up work checks when existing ones expire
        |
        */
        'auto_create_followup' => env('WORK_CHECK_AUTO_FOLLOWUP', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Recipients
    |--------------------------------------------------------------------------
    |
    | Default email addresses to notify when documents or work checks expire
    |
    */
    'notification_recipients' => [
        'hr_email' => env('HR_NOTIFICATION_EMAIL', 'hr@company.com'),
        'manager_email' => env('MANAGER_NOTIFICATION_EMAIL', 'manager@company.com'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Frequency Mapping
    |--------------------------------------------------------------------------
    |
    | Maps frequency strings to number of days
    |
    */
    'frequency_days' => [
        'daily' => 1,
        'weekly' => 7,
        'bi-weekly' => 14,
        'monthly' => 30,
    ],

];
