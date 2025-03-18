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
        Schema::create('loan_contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('client_id');
            $table->decimal('amount', 15, 2);
            $table->unsignedBigInteger('commercial_manager_id');
            $table->unsignedBigInteger('regional_manager_id');
            $table->unsignedBigInteger('superintendent_id');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->foreign('commercial_manager_id')->on('users')->references('id');
            $table->foreign('regional_manager_id')->on('users')->references('id');
            $table->foreign('superintendent_id')->on('users')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_contracts');
    }
};
