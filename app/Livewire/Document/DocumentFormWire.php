<?php

namespace App\Livewire\Document;

use App\Models\Document;
use App\Models\Staff;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class DocumentFormWire extends Component
{
    use WithFileUploads;

    public $documentId;
    public $staff_id;
    public $document_type = 'passport';
    public $document_number;
    public $issue_date;
    public $expiry_date;
    public $notes;
    public $file;
    public $currentFile;

    public function rules()
    {
        return [
            'staff_id' => 'required|exists:staff,id',
            'document_type' => 'required|in:passport,visa,contract,other',
            'document_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'notes' => 'nullable|string',
            'file' => 'nullable|file|max:2048|mimes:pdf,jpg,jpeg,png,doc,docx'
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    #[On('edit-document')]
    public function edit($id)
    {
        $this->resetErrorBag();
        $document = Document::findOrFail($id);

        $this->documentId = $id;
        $this->staff_id = $document->staff_id;
        $this->document_type = $document->document_type;
        $this->document_number = $document->document_number;
        $this->issue_date = $document->issue_date?->format('Y-m-d');
        $this->expiry_date = $document->expiry_date?->format('Y-m-d');
        $this->notes = $document->notes;
        $this->currentFile = $document->original_filename;
    }

    public function save()
    {
        $validatedData = $this->validate();

        $document = Document::updateOrCreate(['id' => $this->documentId], [
            'staff_id' => $this->staff_id,
            'document_type' => $this->document_type,
            'document_number' => $this->document_number,
            'issue_date' => $this->issue_date,
            'expiry_date' => $this->expiry_date,
            'notes' => $this->notes,
        ]);

        // Handle file upload
        if ($this->file) {
            // Delete old file if exists
            if ($document->file_path && file_exists(storage_path('app/' . $document->file_path))) {
                unlink(storage_path('app/' . $document->file_path));
            }

            $staff = Staff::find($this->staff_id);
            $fileName = Str::slug($staff->full_name . '-' . $this->document_type . '-' . now()->format('Y-m-d'))
                . '.' . $this->file->getClientOriginalExtension();

            $filePath = $this->file->storeAs('documents', $fileName, 'private');

            $document->update([
                'file_path' => $filePath,
                'original_filename' => $this->file->getClientOriginalName(),
            ]);
        }

        $message = $this->documentId ? 'updated' : 'created';
        $this->resetInputFields();
        $this->dispatch('document-saved');
        $this->dispatch('success', message: "Document $message successfully.");
        $this->redirect(route('documents.index'), true);
    }

    #[On('reset-document-form')]
    public function resetInputFields()
    {
        $this->reset([
            'documentId',
            'staff_id',
            'document_type',
            'document_number',
            'issue_date',
            'expiry_date',
            'notes',
            'file',
            'currentFile'
        ]);
    }

    public function render()
    {
        $staff = Staff::where('status', 'active')->orderBy('first_name')->get();
        $documentTypes = [
            'passport' => 'Passport',
            'visa' => 'Visa',
            'contract' => 'Employment Contract',
            'other' => 'Other'
        ];

        return view('documents.form', [
            'staff' => $staff,
            'documentTypes' => $documentTypes,
        ]);
    }
}
