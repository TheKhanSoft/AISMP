<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Admin Dashboard - AI Society')]
class Dashboard extends Component
{
    public int $totalMembers = 0;
    public int $totalEvents = 0;
    public int $totalNews = 0;
    public int $totalCourses = 0;
    public int $pendingMemberships = 0;
    public int $upcomingEvents = 0;
    public int $contactMessages = 0;
    public int $newsletterSubscribers = 0;

    public array $recentMembers = [];
    public array $upcomingEventsList = [];
    public array $latestNewsList = [];
    public array $recentActivityList = [];

    public function mount(): void
    {
        $this->loadStatistics();
        $this->loadRecentData();
    }

    protected function loadStatistics(): void
    {
        $this->totalMembers = User::role('member')->count();
        
        // Simulating tables that might not exist yet for robustness
        $this->totalEvents = DB::getSchemaBuilder()->hasTable('events') ? DB::table('events')->count() : 0;
        $this->totalNews = DB::getSchemaBuilder()->hasTable('news') ? DB::table('news')->count() : 0;
        $this->totalCourses = DB::getSchemaBuilder()->hasTable('courses') ? DB::table('courses')->count() : 0;
        
        $this->pendingMemberships = DB::getSchemaBuilder()->hasTable('memberships') 
            ? DB::table('memberships')->where('status', 'pending')->count() 
            : 0;
            
        $this->upcomingEvents = DB::getSchemaBuilder()->hasTable('events') 
            ? DB::table('events')->where('start_date', '>=', now())->count() 
            : 0;
            
        $this->contactMessages = DB::getSchemaBuilder()->hasTable('contact_messages') 
            ? DB::table('contact_messages')->where('is_read', false)->count() 
            : 0;
            
        $this->newsletterSubscribers = DB::getSchemaBuilder()->hasTable('newsletter_subscribers') 
            ? DB::table('newsletter_subscribers')->count() 
            : 0;
    }

    protected function loadRecentData(): void
    {
        $this->recentMembers = User::role('member')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->toArray();
            
        if (DB::getSchemaBuilder()->hasTable('events')) {
            $this->upcomingEventsList = (array) DB::table('events')
                ->where('start_date', '>=', now())
                ->orderBy('start_date', 'asc')
                ->take(5)
                ->get()
                ->toArray();
        }

        if (DB::getSchemaBuilder()->hasTable('news')) {
            $this->latestNewsList = (array) DB::table('news')
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->get()
                ->toArray();
        }

        if (DB::getSchemaBuilder()->hasTable('activity_log')) {
            $this->recentActivityList = (array) DB::table('activity_log')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get()
                ->toArray();
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
