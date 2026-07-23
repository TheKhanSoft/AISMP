<?php

namespace App\Livewire\Member;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Enums\MembershipStatus;
use App\Enums\EnrollmentStatus;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        
        $activeMembership = $user->membership;
        
        // Count of upcoming registered events (using a simplified count for now)
        $upcomingEventsCount = $user->eventRegistrations()->count();
        
        // Count of active courses
        $activeCoursesCount = $user->enrollments()->count();

        // Recent events
        $events = $user->eventRegistrations()->with('event')->latest()->take(5)->get();

        return view('livewire.member.dashboard', [
            'activeMembership' => $activeMembership,
            'upcomingEventsCount' => $upcomingEventsCount,
            'activeCoursesCount' => $activeCoursesCount,
            'events' => $events,
        ]);
    }
}
