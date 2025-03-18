<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comissions', function (Blueprint $table) {
            $table->id();
            $table->uuid('loan_contract_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('role', ["commercial", "regional", "superintendent"]);
            $table->decimal('amount', 15, 2);
            $table->timestamps();
            $table->foreign('loan_contract_id')->on('loan_contracts')->references('id');
            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comissions');
    }
};
