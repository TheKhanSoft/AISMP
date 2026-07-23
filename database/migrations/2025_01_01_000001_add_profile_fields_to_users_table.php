<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('avatar');
            $table->string('designation')->nullable()->after('bio');
            $table->string('organization')->nullable()->after('designation');
            $table->text('address')->nullable()->after('organization');
            $table->string('city')->nullable()->after('address');
            $table->string('country')->nullable()->after('city');
            $table->string('website')->nullable()->after('country');
            $table->json('social_links')->nullable()->after('website');
            $table->boolean('is_active')->default(true)->after('social_links')->index();
            $table->timestamp('last_login_at')->nullable()->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'avatar', 'bio', 'designation', 'organization',
                'address', 'city', 'country', 'website', 'social_links',
                'is_active', 'last_login_at'
            ]);
        });
    }
};