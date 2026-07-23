<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('featured_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('section_key')->unique(); // 'homepage_about', 'homepage_events', etc.
            $table->string('type')->default('content')->index();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->json('settings')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featured_sections');
    }
};