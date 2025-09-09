<?php

namespace App\Livewire\Settings;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Notification Settings')]
class NotificationSettings extends Component
{
    public $document_warning_days;
    public $document_critical_days;
    public $document_notification_frequency;

    public $work_check_warning_days;
    public $work_check_critical_days;
    public $work_check_notification_frequency;

    public $hr_email;
    public $manager_email;

    public function mount()
    {
        $this->document_warning_days = config('notifications.document_expiry.warning_days', 30);
        $this->document_critical_days = config('notifications.document_expiry.critical_days', 7);
        $this->document_notification_frequency = config('notifications.document_expiry.notification_frequency', 'weekly');

        $this->work_check_warning_days = config('notifications.work_check_expiry.warning_days', 30);
        $this->work_check_critical_days = config('notifications.work_check_expiry.critical_days', 14);
        $this->work_check_notification_frequency = config('notifications.work_check_expiry.notification_frequency', 'weekly');

        $this->hr_email = config('notifications.notification_recipients.hr_email', 'hr@company.com');
        $this->manager_email = config('notifications.notification_recipients.manager_email', 'manager@company.com');
    }

    public function rules(): array
    {
        return [
            'document_warning_days' => 'required|integer|min:1|max:365',
            'document_critical_days' => 'required|integer|min:1|max:365',
            'document_notification_frequency' => 'required|in:daily,weekly,bi-weekly,monthly',
            'work_check_warning_days' => 'required|integer|min:1|max:365',
            'work_check_critical_days' => 'required|integer|min:1|max:365',
            'work_check_notification_frequency' => 'required|in:daily,weekly,bi-weekly,monthly',
            'hr_email' => 'required|email',
            'manager_email' => 'required|email',
        ];
    }

    public function save()
    {
        $this->validate();

        // In a real application, you'd want to store these in a database
        // For now, we'll just show a success message
        $this->dispatch('success', message: 'Notification settings updated successfully! Note: These settings are currently configured in the config file.');
    }

    public function getFrequencyOptions(): array
    {
        return [
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'bi-weekly' => 'Bi-weekly',
            'monthly' => 'Monthly',
        ];
    }

    public function render()
    {
        return view('settings.notification-settings', [
            'frequencyOptions' => $this->getFrequencyOptions(),
        ]);
    }
}
