<?php

namespace App\Livewire\WorkCheck;

use App\Models\WorkCheck;
use App\Traits\HasPaginationAndSearch;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Work Check Management')]
class WorkCheckIndex extends Component
{
    use WithPagination, HasPaginationAndSearch;

    public $workCheckId;
    public $filterExpiring = false;

    public function mount()
    {
        $this->filterExpiring = request()->get('filterExpiring', false);
    }

    #[On('confirm-delete')]
    public function confirmDelete($id)
    {
        $this->workCheckId = $id;
    }

    public function destroy()
    {
        $workCheck = WorkCheck::findOrFail($this->workCheckId);
        $workCheck->delete();

        $this->reset('workCheckId');
        $this->dispatch('success', message: 'Work check deleted successfully.');
    }

    #[On('work-check-saved')]
    public function render()
    {
        $workChecks = WorkCheck::with(['staff', 'document'])
            ->where(function ($query) {
                if ($this->searchQuery) {
                    $query->whereHas('staff', function ($q) {
                        $q->where('first_name', 'like', '%' . $this->searchQuery . '%')
                            ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%');
                    })
                        ->orWhereHas('document', function ($q) {
                            $q->where('document_type', 'like', '%' . $this->searchQuery . '%');
                        })
                        ->orWhere('checked_by', 'like', '%' . $this->searchQuery . '%');
                }
            })
            ->when($this->filterExpiring, function ($query) {
                $query->where('expiry_date', '<=', now()->addDays(30));
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);

        return view('work-check.work-check-index', [
            'workChecks' => $workChecks,
        ]);
    }
}
