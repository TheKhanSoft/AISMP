<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('call_to_actions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('button_text');
            $table->string('button_url');
            $table->string('button_target')->default('_self');
            $table->string('background_image')->nullable();
            $table->string('background_color')->nullable();
            $table->string('section')->index();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('call_to_actions');
    }
};