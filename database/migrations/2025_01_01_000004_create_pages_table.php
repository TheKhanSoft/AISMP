<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->text('excerpt')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('template')->default('default');
            $table->boolean('is_published')->default(false)->index();
            $table->timestamp('published_at')->nullable();
            $table->integer('order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};