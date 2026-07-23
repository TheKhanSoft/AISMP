<?php
declare(strict_types=1);

namespace App\Livewire\Admin\Homepage;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Statistic;

#[Layout('components.layouts.admin')]
#[Title('Form Statistics')]
class StatisticForm extends Component
{
    use WithFileUploads;

    public ?int $recordId = null;
    public $label;
    public $value;

    public function mount($id = null): void
    {
        if ($id) {
            $record = Statistic::findOrFail($id);
            $this->authorize('update', $record);
            $this->recordId = $record->id;
            $this->label = $record->label;
            $this->value = $record->value;
        } else {
            $this->authorize('create', Statistic::class);
        }
    }

    public function save()
    {
        $this->validate([
            'label' => 'nullable',
            'value' => 'nullable',
        ]);

        $data = [
            'label' => $this->label,
            'value' => $this->value,
        ];

        if ($this->recordId) {
            $record = Statistic::findOrFail($this->recordId);
            $record->update($data);
            activity()->performedOn($record)->log('updated');
        } else {
            $record = Statistic::create($data);
            activity()->performedOn($record)->log('created');
        }

        $this->dispatch('notify', type: 'success', message: 'Record saved successfully.');
        return $this->redirect(route('admin.homepage.statistics.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin/homepage.statistic-form');
    }
}
