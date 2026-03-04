<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->decimal('amount', 10, 2);

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('colocation_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('date')->nullable();

            $table->timestamps();

            $table->index(['colocation_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
