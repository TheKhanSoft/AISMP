<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('council_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('title'); // e.g., 'President', 'VP'
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->integer('order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->date('term_start')->nullable();
            $table->date('term_end')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('council_members');
    }
};