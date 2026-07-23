<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@aisocietykp.org'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Requires Spatie Permission package to be installed and working
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $superAdmin->assignRole('super-admin');
        }
    }
}
