<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('level')->default('beginner')->index(); // beginner/intermediate/advanced
            $table->integer('duration_hours')->nullable();
            $table->string('language')->default('English');
            $table->text('prerequisites')->nullable();
            $table->json('learning_outcomes')->nullable();
            $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->integer('max_students')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_published')->default(false)->index();
            $table->string('status')->default('draft')->index(); // draft/published/archived
            $table->integer('order')->default(0)->index();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};