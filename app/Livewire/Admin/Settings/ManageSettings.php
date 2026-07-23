<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.admin')]
#[Title('Manage Settings - AI Society')]
class ManageSettings extends Component
{
    public string $group = 'general';
    public array $settings = [];

    public array $groups = [
        'general' => 'General Settings',
        'organization' => 'Organization Info',
        'branding' => 'Branding',
        'contact' => 'Contact Info',
        'social' => 'Social Media',
        'seo' => 'SEO Settings',
        'smtp' => 'SMTP (Email)',
        'maintenance' => 'Maintenance Mode'
    ];

    public function mount(string $group = 'general'): void
    {
        if (!array_key_exists($group, $this->groups)) {
            $group = 'general';
        }
        
        $this->group = $group;
        $this->loadSettings();
    }

    public function changeGroup(string $group): void
    {
        if (array_key_exists($group, $this->groups)) {
            $this->group = $group;
            $this->loadSettings();
            $this->dispatch('url-updated', url: route('admin.settings', $group));
        }
    }

    protected function loadSettings(): void
    {
        // Get settings from database, or empty if table not exists yet
        try {
            $dbSettings = Setting::where('group', $this->group)->pluck('value', 'key')->toArray();
        } catch (\Exception $e) {
            $dbSettings = [];
        }

        // Define expected keys for each group and populate
        $expectedKeys = $this->getExpectedKeysForGroup($this->group);
        
        $this->settings = [];
        foreach ($expectedKeys as $key) {
            $this->settings[$key] = $dbSettings[$key] ?? '';
        }
        
        if ($this->group === 'maintenance') {
            $this->settings['maintenance_mode'] = (bool)($dbSettings['maintenance_mode'] ?? false);
        }
    }

    protected function getExpectedKeysForGroup(string $group): array
    {
        return match ($group) {
            'general' => ['site_name', 'site_tagline', 'site_description', 'timezone', 'date_format', 'items_per_page'],
            'organization' => ['org_name', 'org_registration_number', 'org_established_year', 'org_about'],
            'branding' => ['primary_color', 'secondary_color', 'accent_color'], // Logo/Favicon handled separately ideally
            'contact' => ['address', 'city', 'state', 'country', 'postal_code', 'phone', 'email', 'map_embed_code'],
            'social' => ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'github'],
            'seo' => ['meta_title', 'meta_description', 'meta_keywords', 'google_analytics_id'],
            'smtp' => ['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name'],
            'maintenance' => ['maintenance_mode', 'maintenance_message'],
            default => [],
        };
    }

    public function save(): void
    {
        $this->validate($this->getRulesForGroup($this->group));

        foreach ($this->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_bool($value) ? (int)$value : $value, 'group' => $this->group]
            );
        }

        Cache::forget('settings');

        $this->dispatch('notify', message: 'Settings saved successfully!', type: 'success');
    }

    protected function getRulesForGroup(string $group): array
    {
        $rules = [];
        foreach ($this->getExpectedKeysForGroup($group) as $key) {
            $rules['settings.' . $key] = ['nullable', 'string'];
        }
        
        if ($group === 'general') {
            $rules['settings.site_name'] = ['required', 'string', 'max:255'];
            $rules['settings.items_per_page'] = ['required', 'integer', 'min:1', 'max:100'];
        }
        
        if ($group === 'contact' && !empty($this->settings['email'])) {
            $rules['settings.email'] = ['email'];
        }
        
        if ($group === 'maintenance') {
            $rules['settings.maintenance_mode'] = ['boolean'];
            $rules['settings.maintenance_message'] = ['nullable', 'string'];
        }
        
        return $rules;
    }

    public function render()
    {
        return view('livewire.admin.settings.manage-settings');
    }
}
