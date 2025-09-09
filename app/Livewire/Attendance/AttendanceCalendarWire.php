<?php

namespace App\Livewire\Attendance;

use App\Models\Attendance;
use App\Models\Staff;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Attendance Calendar')]
class AttendanceCalendarWire extends Component
{
    public $currentMonth;
    public $currentYear;
    public $selectedStaff;
    public $viewMode = 'all'; // 'all' or 'individual'

    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function goToToday()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    public function updatedViewMode()
    {
        if ($this->viewMode === 'all') {
            $this->selectedStaff = null;
        }
    }

    #[On('attendance-saved')]
    public function render()
    {
        $startDate = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $endDate = $startDate->copy()->endOfMonth();

        // Get calendar grid (42 days including previous/next month days)
        $calendarStart = $startDate->copy()->startOfWeek(Carbon::SUNDAY);
        $calendarEnd = $endDate->copy()->endOfWeek();

        $calendarDays = [];
        $current = $calendarStart->copy();

        while ($current <= $calendarEnd) {
            $calendarDays[] = $current->copy();
            $current->addDay();
        }

        // Get attendance data for the month
        $attendanceQuery = Attendance::with('staff')
            ->whereBetween('date', [$calendarStart->format('Y-m-d'), $calendarEnd->format('Y-m-d')]);

        if ($this->viewMode === 'individual' && $this->selectedStaff) {
            $attendanceQuery->where('staff_id', $this->selectedStaff);
        }

        $attendanceData = $attendanceQuery->get()->groupBy(function ($item) {
            return $item->date->format('Y-m-d');
        });

        // Get staff list
        $staff = Staff::where('status', 'active')->orderBy('first_name')->get();

        // Get monthly statistics
        $monthlyStats = $this->getMonthlyStats($startDate, $endDate);

        return view('attendance.calendar', [
            'calendarDays' => $calendarDays,
            'attendanceData' => $attendanceData,
            'staff' => $staff,
            'monthName' => $startDate->format('F Y'),
            'currentMonth' => $this->currentMonth,
            'currentYear' => $this->currentYear,
            'monthlyStats' => $monthlyStats,
        ]);
    }

    private function getMonthlyStats($startDate, $endDate)
    {
        $query = Attendance::whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);

        if ($this->viewMode === 'individual' && $this->selectedStaff) {
            $query->where('staff_id', $this->selectedStaff);
        }

        return [
            'total_present' => $query->clone()->where('status', 'present')->count(),
            'total_absent' => $query->clone()->where('status', 'absent')->count(),
            'total_late' => $query->clone()->where('status', 'late')->count(),
            'total_half_day' => $query->clone()->where('status', 'half_day')->count(),
        ];
    }
}
