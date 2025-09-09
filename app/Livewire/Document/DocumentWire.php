<?php

namespace App\Livewire\Document;

use App\Models\Document;
use App\Models\Staff;
use App\Traits\HasPaginationAndSearch;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Documents Management')]
class DocumentWire extends Component
{
    use WithPagination, HasPaginationAndSearch;

    public $documentId;
    public $filterType;
    public $filterStaff;
    public $filterExpiring = false;

    public function destroy()
    {
        $document = Document::findOrFail($this->documentId);

        // Delete the file if exists
        if ($document->file_path && file_exists(storage_path('app/' . $document->file_path))) {
            unlink(storage_path('app/' . $document->file_path));
        }

        $document->delete();

        $this->reset('documentId');
        $this->dispatch('success', message: 'Document deleted successfully.');
    }

    #[On('document-saved')]
    public function render()
    {
        $documents = Document::with('staff')
            ->when($this->filterType, function ($query) {
                return $query->where('document_type', $this->filterType);
            })
            ->when($this->filterStaff, function ($query) {
                return $query->where('staff_id', $this->filterStaff);
            })
            ->when($this->filterExpiring, function ($query) {
                return $query->expiring(30);
            })
            ->when($this->searchQuery, function ($query) {
                return $query->where(function ($q) {
                    $q->where('document_number', 'like', '%' . $this->searchQuery . '%')
                        ->orWhereHas('staff', function ($staffQuery) {
                            $staffQuery->where('first_name', 'like', '%' . $this->searchQuery . '%')
                                ->orWhere('last_name', 'like', '%' . $this->searchQuery . '%')
                                ->orWhere('employee_id', 'like', '%' . $this->searchQuery . '%');
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginate);

        $staff = Staff::where('status', 'active')->orderBy('first_name')->get();
        $documentTypes = ['passport', 'visa', 'contract', 'other'];

        return view('documents.index', [
            'documents' => $documents,
            'staff' => $staff,
            'documentTypes' => $documentTypes,
        ]);
    }
}
