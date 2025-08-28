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
        'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB Max
    ];

    public function submit()
    {
        $this->validate();

        // Сохраняем файл и получаем его путь. ЭТО БЫЛО ПРОПУЩЕНО.
        $path = $this->file->store('documents', 'public');

        // Теперь передаем все необходимые поля в базу данных.
        Document::create([
            'user_id' => auth()->id(),
            'document_type' => $this->document_type,
            'path' => $path, // <-- ИСПРАВЛЕНО
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
