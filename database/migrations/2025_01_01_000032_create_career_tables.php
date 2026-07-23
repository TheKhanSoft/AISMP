<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('company');
            $table->string('location')->nullable();
            $table->string('type')->index(); // full_time/part_time/contract/remote
            $table->longText('description');
            $table->longText('requirements')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('application_url')->nullable();
            $table->string('application_email')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('company');
            $table->string('location')->nullable();
            $table->longText('description');
            $table->longText('requirements')->nullable();
            $table->string('duration')->nullable();
            $table->string('stipend')->nullable();
            $table->string('application_url')->nullable();
            $table->string('application_email')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('provider');
            $table->longText('description');
            $table->longText('eligibility')->nullable();
            $table->string('amount')->nullable();
            $table->string('application_url')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('provider')->nullable();
            $table->longText('description');
            $table->string('duration')->nullable();
            $table->string('mode')->default('online')->index(); // online/offline/hybrid
            $table->decimal('fee', 10, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('application_url')->nullable();
            $table->boolean('is_published')->default(false)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_programs');
        Schema::dropIfExists('scholarships');
        Schema::dropIfExists('internships');
        Schema::dropIfExists('careers');
    }
};