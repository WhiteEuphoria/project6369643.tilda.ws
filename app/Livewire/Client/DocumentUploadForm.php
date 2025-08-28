<?php

namespace App\Livewire\Client;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class DocumentUploadForm extends Component
{
    use WithFileUploads;

    public $document_type = 'passport';
    public $file;
    public $successMessage;

    protected $rules = [
        'document_type' => 'required|in:passport,utility_bill,other',
        'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Max 2MB
    ];

    public function submit()
    {
        $this->validate();

        // Store the file and get its path.
        $path = $this->file->store('documents', 'public');

        // Create the document record with all required fields.
        Document::create([
            'user_id' => auth()->id(),
            'document_type' => $this->document_type,
            'path' => $path, // Fixed
            'status' => 'pending',
        ]);

        $this->reset('file');
        $this->successMessage = 'Document uploaded successfully for verification.';
    }

    public function render()
    {
        return view('livewire.client.document-upload-form');
    }
}
