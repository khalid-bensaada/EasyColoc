<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('expense_id')->constrained()->cascadeOnDelete();
            $table->foreignId('colocation_id')->constrained()->cascadeOnDelete();

            $table->foreignId('payer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('creator_id')->constrained('users')->cascadeOnDelete();

            $table->decimal('amount', 10, 2);

            $table->enum('status', ['pending', 'paid'])->default('pending');

            $table->timestamps();

            $table->index(['expense_id', 'colocation_id', 'payer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
