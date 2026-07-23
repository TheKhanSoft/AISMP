<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_renewals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_id')->constrained()->cascadeOnDelete();
            $table->timestamp('previous_expires_at');
            $table->timestamp('new_expires_at');
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamp('renewed_at');
            $table->string('status')->default('pending')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_renewals');
    }
};