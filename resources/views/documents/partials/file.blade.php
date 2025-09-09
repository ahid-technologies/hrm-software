@if ($document->file_path)
    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-outline-primary">
        <i class="ti ti-download me-1"></i> Download
    </a>
@else
    <span class="text-muted">No file</span>
@endif
