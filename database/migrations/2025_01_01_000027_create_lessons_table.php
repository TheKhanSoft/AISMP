<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('order')->default(0)->index();
            $table->integer('duration_minutes')->nullable();
            $table->boolean('is_free')->default(false)->index();
            $table->boolean('is_published')->default(true)->index();
            $table->timestamps();

            $table->unique(['course_id', 'slug']);
        });

        Schema::create('lesson_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->string('type')->index(); // video/pdf/text/download
            $table->string('title');
            $table->text('content')->nullable(); // for text type
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('duration_minutes')->nullable(); // for video
            $table->integer('order')->default(0)->index();
            $table->boolean('is_downloadable')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_contents');
        Schema::dropIfExists('lessons');
    }
};