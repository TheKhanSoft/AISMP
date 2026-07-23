<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Modules requested in prompt
        $modules = [
            'users', 'settings', 'pages', 'news', 'posts', 'events', 
            'memberships', 'courses', 'research', 'careers', 'resources', 
            'gallery', 'partners', 'council', 'downloads', 'faqs', 
            'contact_messages', 'newsletter', 'activity_log', 'menus', 
            'hero_slides', 'statistics', 'testimonials', 'cta', 
            'featured_sections', 'comments', 'categories', 'tags', 'certificates'
        ];

        // Actions per module
        $actions = ['view', 'create', 'update', 'delete'];

        $allPermissions = [];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permissionName = "{$action} {$module}";
                $allPermissions[] = $permissionName;
                Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);
            }
        }

        // Create Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $editorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $memberRole = Role::firstOrCreate(['name' => 'member', 'guard_name' => 'web']);

        // Assign all permissions to super-admin
        $superAdminRole->syncPermissions($allPermissions);

        // Admin gets all except users, settings, activity_log (optional logic, let's say they can't manage roles but can manage users)
        $adminPermissions = collect($allPermissions)->reject(function ($name) {
            return in_array($name, [
                'delete users', 'delete settings', 'update settings', 'delete activity_log'
            ]);
        });
        $adminRole->syncPermissions($adminPermissions);

        // Editor gets content permissions
        $editorContentModules = [
            'pages', 'news', 'posts', 'events', 'courses', 'research', 
            'resources', 'gallery', 'faqs', 'hero_slides', 'testimonials', 
            'comments', 'categories', 'tags'
        ];
        $editorPermissions = [];
        foreach ($editorContentModules as $module) {
            foreach ($actions as $action) {
                $editorPermissions[] = "{$action} {$module}";
            }
        }
        $editorRole->syncPermissions($editorPermissions);

        // Member gets view permissions for relevant modules
        $memberPermissions = [
            'view events', 'view courses', 'view research', 'view resources',
            'view gallery', 'view downloads', 'view certificates'
        ];
        $memberRole->syncPermissions($memberPermissions);
    }
}
