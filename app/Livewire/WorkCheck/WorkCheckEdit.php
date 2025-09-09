<?php

namespace App\Livewire\WorkCheck;

use App\Models\Document;
use App\Models\Staff;
use App\Models\WorkCheck;
use App\Services\ExpiryNotificationService;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Edit Work Check')]
class WorkCheckEdit extends Component
{
    public $workCheckId;
    public $staff_id;
    public $check_date;
    public $document_id;
    public $checked_by;
    public $expiry_date;
    public $notes;

    public function rules(): array
    {
        return [
            'staff_id' => 'required|exists:staff,id',
            'check_date' => 'required|date',
            'document_id' => 'required|exists:documents,id',
            'checked_by' => 'required|string|max:255',
            'expiry_date' => 'required|date|after:check_date',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    public function mount($id)
    {
        $this->workCheckId = $id;
        $workCheck = WorkCheck::findOrFail($id);

        $this->staff_id = $workCheck->staff_id;
        $this->check_date = $workCheck->check_date ? Carbon::parse($workCheck->check_date)->format('Y-m-d') : '';
        $this->document_id = $workCheck->document_id;
        $this->checked_by = $workCheck->checked_by;
        $this->expiry_date = $workCheck->expiry_date ? Carbon::parse($workCheck->expiry_date)->format('Y-m-d') : '';
        $this->notes = $workCheck->notes;
    }

    public function update()
    {
        $this->validate();

        $workCheck = WorkCheck::findOrFail($this->workCheckId);
        $workCheck->update([
            'staff_id' => $this->staff_id,
            'check_date' => $this->check_date,
            'document_id' => $this->document_id,
            'checked_by' => $this->checked_by,
            'expiry_date' => $this->expiry_date,
            'notes' => $this->notes,
        ]);

        // Check if we need to create an immediate notification for expiring work check
        $this->checkForExpiryNotification($workCheck->fresh());

        $this->dispatch('success', message: 'Work check updated successfully.');
        $this->dispatch('work-check-saved');
        $this->redirect(route('work-checks.index'), true);
    }

    protected function checkForExpiryNotification(WorkCheck $workCheck): void
    {
        $warningDays = config('notifications.work_check_expiry.warning_days', 30);
        $daysUntilExpiry = now()->diffInDays($workCheck->expiry_date, false);

        // If work check expires within warning period, create notification immediately
        if ($daysUntilExpiry <= $warningDays && $daysUntilExpiry >= 0) {
            $service = new ExpiryNotificationService();
            $service->checkWorkCheckExpiries();
        }
    }

    public function render()
    {
        $staff = Staff::where('status', 'active')->orderBy('first_name')->get();
        $documents = Document::with('staff')->orderBy('document_type')->get();

        return view('work-check.work-check-edit', [
            'staff' => $staff,
            'documents' => $documents,
        ]);
    }
}
