<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use App\Models\Staff;
use Livewire\Attributes\On;
use Livewire\Component;

class AttendanceFormWire extends Component
{
    public $attendanceId;
    public $staff_id;
    public $date;
    public $check_in;
    public $check_out;
    public $status = 'present';
    public $remarks;

    public function rules()
    {
        return [
            'staff_id' => 'required|exists:staff,id',
            'date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i|after:check_in',
            'status' => 'required|in:present,absent,late,half_day',
            'remarks' => 'nullable|string'
        ];
    }

    public function mount($id = null)
    {
        $this->date = now()->format('Y-m-d');

        if ($id) {
            $this->edit($id);
        }
    }

    #[On('edit-attendance')]
    public function edit($id)
    {
        $this->resetErrorBag();
        $attendance = Attendance::findOrFail($id);

        $this->attendanceId = $id;
        $this->staff_id = $attendance->staff_id;
        $this->date = $attendance->date->format('Y-m-d');
        $this->check_in = $attendance->check_in?->format('H:i');
        $this->check_out = $attendance->check_out?->format('H:i');
        $this->status = $attendance->status;
        $this->remarks = $attendance->remarks;
    }

    public function save()
    {
        $validatedData = $this->validate();

        $isCreating = !$this->attendanceId;

        if ($isCreating) {
            $alreadyExists = Attendance::where('staff_id', $this->staff_id)
                ->whereDate('date', $this->date)
                ->exists();

            if ($alreadyExists) {
                $this->addError('date', 'Attendance already exists for this employee on the selected date.');
                return;
            }
        }

        $attendance = Attendance::updateOrCreate(
            [
                'id' => $this->attendanceId,
            ],
            $validatedData
        );

        // Calculate total hours if both check_in and check_out are provided
        if ($this->check_in && $this->check_out) {
            $attendance->calculateTotalHours();
        }

        $message = $this->attendanceId ? 'updated' : 'created';
        $this->resetInputFields();
        $this->dispatch('attendance-saved');
        $this->dispatch('success', message: "Attendance record $message successfully.");

        $this->redirect(route('attendance.index'), true);
    }

    #[On('reset-attendance-form')]
    public function resetInputFields()
    {
        $this->reset([
            'attendanceId',
            'staff_id',
            'date',
            'check_in',
            'check_out',
            'status',
            'remarks'
        ]);
        $this->date = now()->format('Y-m-d');
    }

    public function render()
    {
        $staff = Staff::where('status', 'active')->orderBy('first_name')->get();

        return view('attendance.form', [
            'staff' => $staff,
        ]);
    }
}
