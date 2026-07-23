<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Downloads;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Download;

#[Layout('components.layouts.admin')]
#[Title('Form Downloads')]
class DownloadForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $title;
    public $file;
    public $downloads;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Download::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->title = $record->title;
            $this->file = $record->file;
            $this->downloads = $record->downloads;
        } else {
            $this->authorize('create', Download::class);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'nullable',
            'file' => 'nullable',
            'downloads' => 'nullable',
        ]);

        $data = [
            'title' => $this->title,
            'file' => $this->file,
            'downloads' => $this->downloads,
        ];

        if ($this->recordId) {
            $record = Download::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Download::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.downloads.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/downloads.download-form');
    }
}
