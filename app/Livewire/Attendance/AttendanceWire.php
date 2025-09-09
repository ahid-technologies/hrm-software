<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use App\Models\Staff;
use App\Traits\HasPaginationAndSearch;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Attendance Management')]
class AttendanceWire extends Component
{
    use WithPagination, HasPaginationAndSearch;

    public $attendanceId;
    public $filterDate;
    public $filterStaff;
    public $filterStatus;

    public function mount()
    {
        // Set default filter to current month
        $this->filterDate = now()->format('Y-m');
    }

    public function destroy()
    {
        $attendance = Attendance::findOrFail($this->attendanceId);
        $attendance->delete();

        $this->reset('attendanceId');
        $this->dispatch('success', message: 'Attendance record deleted successfully.');
    }

    public function clearFilters()
    {
        $this->reset(['filterDate', 'filterStaff', 'filterStatus', 'searchQuery']);
        $this->resetPage();
    }

    #[On('attendance-saved')]
    public function render()
    {
        $attendance = Attendance::with('staff')
            ->when($this->filterDate, function ($query) {
                if (strlen($this->filterDate) === 7) { // YYYY-MM format (month filter)
                    return $query->whereYear('date', substr($this->filterDate, 0, 4))
                        ->whereMonth('date', substr($this->filterDate, 5, 2));
                } else { // YYYY-MM-DD format (specific date)
                    return $query->whereDate('date', $this->filterDate);
                }
            })
            ->when($this->filterStaff, function ($query) {
                return $query->where('staff_id', $this->filterStaff);
            })
            ->when($this->filterStatus, function ($query) {
                return $query->where('status', $this->filterStatus);
            })
            ->when($this->searchQuery, function ($query) {
                return $query->whereHas('staff', function ($q) {
                    $q->where('first_name', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('employee_id', 'like', '%' . $this->searchQuery . '%');
                });
            })
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);

        $staff = Staff::where('status', 'active')->orderBy('first_name')->get();

        // Get summary statistics for current filters
        $summaryQuery = Attendance::with('staff')
            ->when($this->filterDate, function ($query) {
                if (strlen($this->filterDate) === 7) {
                    return $query->whereYear('date', substr($this->filterDate, 0, 4))
                        ->whereMonth('date', substr($this->filterDate, 5, 2));
                } else {
                    return $query->whereDate('date', $this->filterDate);
                }
            })
            ->when($this->filterStaff, function ($query) {
                return $query->where('staff_id', $this->filterStaff);
            })
            ->when($this->searchQuery, function ($query) {
                return $query->whereHas('staff', function ($q) {
                    $q->where('first_name', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                        ->orWhere('employee_id', 'like', '%' . $this->searchQuery . '%');
                });
            });

        $summary = [
            'total' => $summaryQuery->clone()->count(),
            'present' => $summaryQuery->clone()->where('status', 'present')->count(),
            'absent' => $summaryQuery->clone()->where('status', 'absent')->count(),
            'late' => $summaryQuery->clone()->where('status', 'late')->count(),
            'half_day' => $summaryQuery->clone()->where('status', 'half_day')->count(),
        ];

        return view('attendance.index', [
            'attendance' => $attendance,
            'staff' => $staff,
            'summary' => $summary,
        ]);
    }
}
