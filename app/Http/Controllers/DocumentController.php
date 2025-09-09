<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download(Document $document)
    {
        if (!$document->file_path || !Storage::disk('private')->exists($document->file_path)) {
            abort(404, 'File not found');
        }

        return Storage::disk('private')->download(
            $document->file_path,
            $document->original_filename
        );
    }
}
