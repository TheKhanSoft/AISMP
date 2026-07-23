<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->decimal('fee', 10, 2)->default(0);
            $table->integer('duration_months')->default(12);
            $table->boolean('is_active')->default(true)->index();
            $table->integer('order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_types');
    }
};