<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('value');
            $table->string('suffix')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->integer('order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->string('section')->default('homepage')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};