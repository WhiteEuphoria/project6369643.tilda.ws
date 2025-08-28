<?php

namespace App\Livewire\Client;

use App\Models\Document;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadDocument extends Component
{
    use WithFileUploads;

    public $file;
    public $documents;
    public $document_type = 'other'; // Default document type

    public function mount()
    {
        $this->loadDocuments();
    }

    public function loadDocuments()
    {
        $this->documents = Document::where('user_id', Auth::id())->get();
    }

    public function save()
    {
        $this->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // Max 10MB
        ]);
        
        $path = $this->file->store('documents', 'public');
        
        Document::create([
            'user_id' => Auth::id(),
            'path' => $path,
            'original_name' => $this->file->getClientOriginalName(), // Fixed
            'document_type' => $this->document_type,
            'status' => 'pending',
        ]);

        $this->reset('file'); 
        $this->loadDocuments(); 
        
        Notification::make()
            ->title('Document uploaded successfully')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.client.upload-document');
    }
}
