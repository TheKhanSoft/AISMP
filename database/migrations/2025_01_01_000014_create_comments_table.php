<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->morphs('commentable');
            $table->foreignId('parent_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('content');
            $table->boolean('is_approved')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['commentable_id', 'commentable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};