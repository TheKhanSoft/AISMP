<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['group' => 'general', 'key' => 'site_name', 'value' => 'AI Society KP'],
            ['group' => 'general', 'key' => 'site_tagline', 'value' => 'Advancing Artificial Intelligence'],
            ['group' => 'general', 'key' => 'site_description', 'value' => 'Enterprise AI Society Management Platform'],
            ['group' => 'general', 'key' => 'timezone', 'value' => 'Asia/Karachi'],
            ['group' => 'general', 'key' => 'date_format', 'value' => 'Y-m-d'],
            ['group' => 'general', 'key' => 'items_per_page', 'value' => '15'],

            // Organization
            ['group' => 'organization', 'key' => 'org_name', 'value' => 'AI Society Khyber Pakhtunkhwa'],
            ['group' => 'organization', 'key' => 'org_registration_number', 'value' => 'AIS-KP-2026-001'],
            ['group' => 'organization', 'key' => 'org_established_year', 'value' => '2026'],
            ['group' => 'organization', 'key' => 'org_about', 'value' => 'Empowering the region with Artificial Intelligence knowledge and innovation.'],

            // Branding
            ['group' => 'branding', 'key' => 'primary_color', 'value' => '#0f172a'],
            ['group' => 'branding', 'key' => 'secondary_color', 'value' => '#3b82f6'],
            ['group' => 'branding', 'key' => 'accent_color', 'value' => '#10b981'],

            // Contact
            ['group' => 'contact', 'key' => 'address', 'value' => 'IT Park, Peshawar'],
            ['group' => 'contact', 'key' => 'city', 'value' => 'Peshawar'],
            ['group' => 'contact', 'key' => 'state', 'value' => 'Khyber Pakhtunkhwa'],
            ['group' => 'contact', 'key' => 'country', 'value' => 'Pakistan'],
            ['group' => 'contact', 'key' => 'postal_code', 'value' => '25000'],
            ['group' => 'contact', 'key' => 'phone', 'value' => '+92 300 1234567'],
            ['group' => 'contact', 'key' => 'email', 'value' => 'info@aisocietykp.org'],
            ['group' => 'contact', 'key' => 'map_embed_code', 'value' => ''],

            // Social
            ['group' => 'social', 'key' => 'facebook', 'value' => 'facebook.com/aisocietykp'],
            ['group' => 'social', 'key' => 'twitter', 'value' => 'twitter.com/aisocietykp'],
            ['group' => 'social', 'key' => 'instagram', 'value' => 'instagram.com/aisocietykp'],
            ['group' => 'social', 'key' => 'linkedin', 'value' => 'linkedin.com/company/aisocietykp'],
            ['group' => 'social', 'key' => 'youtube', 'value' => 'youtube.com/aisocietykp'],
            ['group' => 'social', 'key' => 'github', 'value' => 'github.com/aisocietykp'],

            // SEO
            ['group' => 'seo', 'key' => 'meta_title', 'value' => 'AI Society KP - Shaping the Future'],
            ['group' => 'seo', 'key' => 'meta_description', 'value' => 'Join the premier AI community in Khyber Pakhtunkhwa.'],
            ['group' => 'seo', 'key' => 'meta_keywords', 'value' => 'AI, Artificial Intelligence, KP, Pakistan, Technology, Machine Learning'],
            ['group' => 'seo', 'key' => 'google_analytics_id', 'value' => ''],

            // SMTP
            ['group' => 'smtp', 'key' => 'mail_mailer', 'value' => 'smtp'],
            ['group' => 'smtp', 'key' => 'mail_host', 'value' => 'smtp.mailtrap.io'],
            ['group' => 'smtp', 'key' => 'mail_port', 'value' => '2525'],
            ['group' => 'smtp', 'key' => 'mail_username', 'value' => ''],
            ['group' => 'smtp', 'key' => 'mail_password', 'value' => ''],
            ['group' => 'smtp', 'key' => 'mail_encryption', 'value' => 'tls'],
            ['group' => 'smtp', 'key' => 'mail_from_address', 'value' => 'noreply@aisocietykp.org'],
            ['group' => 'smtp', 'key' => 'mail_from_name', 'value' => 'AI Society KP'],

            // Maintenance
            ['group' => 'maintenance', 'key' => 'maintenance_mode', 'value' => '0'],
            ['group' => 'maintenance', 'key' => 'maintenance_message', 'value' => 'We are currently updating our systems. Please check back later.'],
        ];

        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            foreach ($settings as $setting) {
                Setting::updateOrCreate(
                    ['key' => $setting['key']],
                    ['value' => $setting['value'], 'group' => $setting['group']]
                );
            }
        }
    }
}
