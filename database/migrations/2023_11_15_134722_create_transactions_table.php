<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('note')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('is_recurring')->default(false)->nullable();
            $table->boolean('is_installment')->default(false)->nullable();
            $table->integer('recurring_period')->nullable();
            $table->integer('installment_period')->nullable();
            $table->integer('spending');
            $table->integer('total');
            $table->enum('type', ['expense', 'income']);
            $table->foreignId('category_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
