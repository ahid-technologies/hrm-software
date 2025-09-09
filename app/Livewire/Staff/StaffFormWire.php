<?php

namespace App\Livewire\Staff;

use App\Models\Staff;
use Livewire\Attributes\On;
use Livewire\Component;

class StaffFormWire extends Component
{
    public $staffId;
    public $employee_id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $ni_number;
    public $utr_number;
    public $date_of_birth;
    public $address;
    public $position;
    public $department;
    public $joining_date;
    public $status = 'active';
    public $basic_salary;

    public function rules()
    {
        return [
            'employee_id' => 'required|string|max:255|unique:staff,employee_id,' . $this->staffId,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $this->staffId,
            'phone' => 'nullable|string|max:20',
            'ni_number' => 'nullable|string|max:13|regex:/^[A-Z]{2}[0-9]{6}[A-Z]?$/',
            'utr_number' => 'nullable|string|max:10|regex:/^[0-9]{10}$/',
            'date_of_birth' => 'nullable|date',
            'address' => 'nullable|string',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'joining_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'basic_salary' => 'nullable|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'ni_number.regex' => 'NI Number must be in the format: AB123456C',
            'utr_number.regex' => 'UTR Number must be exactly 10 digits',
            'utr_number.max' => 'UTR Number must be exactly 10 digits'
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    #[On('edit-staff')]
    public function edit($id)
    {
        $this->resetErrorBag();
        $staff = Staff::findOrFail($id);

        $this->staffId = $id;
        $this->employee_id = $staff->employee_id;
        $this->first_name = $staff->first_name;
        $this->last_name = $staff->last_name;
        $this->email = $staff->email;
        $this->phone = $staff->phone;
        $this->ni_number = $staff->ni_number;
        $this->utr_number = $staff->utr_number;
        $this->date_of_birth = $staff->date_of_birth?->format('Y-m-d');
        $this->address = $staff->address;
        $this->position = $staff->position;
        $this->department = $staff->department;
        $this->joining_date = $staff->joining_date?->format('Y-m-d');
        $this->status = $staff->status;
        $this->basic_salary = $staff->basic_salary;
    }

    public function save()
    {
        $validatedData = $this->validate();

        Staff::updateOrCreate(['id' => $this->staffId], $validatedData);

        $message = $this->staffId ? 'updated' : 'created';
        $this->resetInputFields();
        $this->dispatch('staff-saved');
        $this->dispatch('success', message: "Staff member $message successfully.");

        $this->redirect(route('staff.index'), true);
    }

    #[On('reset-staff-form')]
    public function resetInputFields()
    {
        $this->reset([
            'staffId',
            'employee_id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'date_of_birth',
            'address',
            'position',
            'department',
            'joining_date',
            'status',
            'basic_salary'
        ]);
    }

    public function render()
    {
        $title = $this->staffId ? 'Edit Staff Member' : 'Add New Staff';
        return view('staff.form')->title($title);
    }
}
