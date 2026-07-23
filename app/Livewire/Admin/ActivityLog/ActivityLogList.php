<?php

declare(strict_types=1);

namespace App\Livewire\Admin\ActivityLog;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

#[Layout('components.layouts.admin')]
#[Title('Activity Log - AI Society')]
class ActivityLogList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $causerFilter = '';
    public string $subjectFilter = '';
    public string $dateFrom = '';
    public string $dateTo = '';
    public int $perPage = 20;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCauserFilter(): void
    {
        $this->resetPage();
    }

    public function updatedSubjectFilter(): void
    {
        $this->resetPage();
    }

    public function updatedDateFrom(): void
    {
        $this->resetPage();
    }

    public function updatedDateTo(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->reset(['search', 'causerFilter', 'subjectFilter', 'dateFrom', 'dateTo']);
        $this->resetPage();
    }

    public function render()
    {
        // Return empty paginator if table doesn't exist yet
        if (!\Illuminate\Support\Facades\Schema::hasTable('activity_log')) {
            return view('livewire.admin.activity-log.activity-log-list', [
                'activities' => collect([])->paginate($this->perPage),
                'causers' => [],
                'subjects' => [],
            ]);
        }

        $query = Activity::with('causer')->latest();

        if (!empty($this->search)) {
            $query->where('description', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->causerFilter)) {
            $query->where('causer_id', $this->causerFilter);
        }

        if (!empty($this->subjectFilter)) {
            $query->where('subject_type', $this->subjectFilter);
        }

        if (!empty($this->dateFrom)) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }

        if (!empty($this->dateTo)) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        $activities = $query->paginate($this->perPage);

        // Get unique causers and subjects for filters
        $causers = Activity::whereNotNull('causer_id')
            ->select('causer_id', 'causer_type')
            ->distinct()
            ->with('causer')
            ->get()
            ->pluck('causer.name', 'causer_id')
            ->filter();
            
        $subjects = Activity::whereNotNull('subject_type')
            ->select('subject_type')
            ->distinct()
            ->pluck('subject_type')
            ->mapWithKeys(function ($item) {
                return [$item => class_basename($item)];
            });

        return view('livewire.admin.activity-log.activity-log-list', [
            'activities' => $activities,
            'causers' => $causers,
            'subjects' => $subjects,
        ]);
    }
}
