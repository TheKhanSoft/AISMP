<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->morphs('quizzable');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->integer('passing_score')->default(70);
            $table->integer('max_attempts')->default(3);
            $table->boolean('is_active')->default(true)->index();
            $table->integer('order')->default(0)->index();
            $table->timestamps();

            $table->index(['quizzable_id', 'quizzable_type']);
        });

        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $table->text('question');
            $table->string('type')->default('multiple_choice'); // multiple_choice/true_false/short_answer
            $table->text('explanation')->nullable();
            $table->integer('points')->default(1);
            $table->integer('order')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('quiz_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_question_id')->constrained()->cascadeOnDelete();
            $table->text('option_text');
            $table->boolean('is_correct')->default(false);
            $table->integer('order')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('score')->nullable();
            $table->integer('total_points')->nullable();
            $table->boolean('passed')->nullable()->index();
            $table->timestamp('started_at');
            $table->timestamp('completed_at')->nullable();
            $table->integer('time_spent_seconds')->nullable();
            $table->timestamps();
        });

        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_attempt_id')->constrained()->cascadeOnDelete();
            $table->foreignId('quiz_question_id')->constrained()->cascadeOnDelete();
            $table->foreignId('selected_option_id')->nullable()->constrained('quiz_options')->nullOnDelete();
            $table->text('answer_text')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->integer('points_earned')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('quiz_options');
        Schema::dropIfExists('quiz_questions');
        Schema::dropIfExists('quizzes');
    }
};