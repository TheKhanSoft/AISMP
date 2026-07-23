<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('status')->index(); // active/completed/on_hold
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('featured_image')->nullable();
            $table->foreignId('lead_researcher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('funding_source')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('abstract')->nullable();
            $table->json('authors');
            $table->string('journal_name')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('doi')->nullable();
            $table->string('url')->nullable();
            $table->string('file_path')->nullable();
            $table->string('type')->index(); // paper/article/thesis/report
            $table->boolean('is_published')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('research_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('leader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('research_group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_group_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('role')->default('member');
            $table->timestamp('joined_at');
            $table->timestamps();

            $table->unique(['research_group_id', 'user_id']);
        });

        Schema::create('innovation_labs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('status')->default('active')->index();
            $table->string('category')->nullable()->index();
            $table->json('technologies')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innovation_labs');
        Schema::dropIfExists('research_group_members');
        Schema::dropIfExists('research_groups');
        Schema::dropIfExists('publications');
        Schema::dropIfExists('research_projects');
    }
};