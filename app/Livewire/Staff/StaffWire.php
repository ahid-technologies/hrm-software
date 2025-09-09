<?php

namespace App\Livewire\Staff;

use App\Models\Staff;
use App\Traits\HasPaginationAndSearch;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Staff Management')]
class StaffWire extends Component
{
    use WithPagination, HasPaginationAndSearch;

    public $staffId;

    public function destroy()
    {
        $staff = Staff::findOrFail($this->staffId);

        // Delete associated records
        $staff->attendance()->delete();
        $staff->documents()->delete();
        $staff->notifications()->delete();

        // Delete the staff
        $staff->delete();

        $this->reset('staffId');
        $this->dispatch('success', message: 'Staff member deleted successfully.');
    }

    #[On('staff-saved')]
    public function render()
    {
        $staff = Staff::search($this->searchQuery)
            ->query(function ($query) {
                return $query->withCount(['documents', 'attendance'])
                    ->orderBy('created_at', 'desc');
            })
            ->paginate($this->paginate);

        return view('staff.index', [
            'staff' => $staff,
        ]);
    }
}
