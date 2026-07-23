<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('type')->index(); // paper/dataset/tool/book/tutorial
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('url')->nullable();
            $table->string('file_path')->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->string('author')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->integer('download_count')->default(0);
            $table->boolean('is_featured')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};