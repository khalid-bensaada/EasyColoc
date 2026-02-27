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
            $table->string('category')->default('general');


            $table->foreignId('user_id')->constrained()->onDelete('cascade');


            $table->foreignId('colocation_id')->constrained()->onDelete('cascade');

            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
