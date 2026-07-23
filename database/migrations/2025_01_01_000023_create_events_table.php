<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('type')->index(); // workshop/seminar/bootcamp/hackathon/competition/conference
            $table->string('venue')->nullable();
            $table->text('venue_address')->nullable();
            $table->boolean('is_online')->default(false)->index();
            $table->string('meeting_url')->nullable();
            $table->dateTime('start_date')->index();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('registration_deadline')->nullable();
            $table->integer('max_participants')->nullable();
            $table->decimal('fee', 10, 2)->default(0);
            $table->string('featured_image')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_published')->default(false)->index();
            $table->string('status')->default('upcoming')->index(); // upcoming/ongoing/completed/cancelled
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};