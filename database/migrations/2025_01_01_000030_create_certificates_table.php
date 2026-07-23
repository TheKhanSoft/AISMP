<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('certificable');
            $table->string('certificate_number')->unique();
            $table->string('title');
            $table->timestamp('issued_at');
            $table->timestamp('expires_at')->nullable();
            $table->string('template')->default('default');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['certificable_id', 'certificable_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};