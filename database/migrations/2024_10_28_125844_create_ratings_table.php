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
        // Create rate_numbers table
        Schema::create('rate_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('rate_number', 10)->unique();
            $table->timestamps();
        });

        // Create ratings table
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taker_id');
            $table->unsignedBigInteger('giver_id');
            $table->unsignedBigInteger('project_id');
            $table->integer('amount');
            $table->longText('comment');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('taker_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('giver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the tables in reverse order
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('rate_numbers');
    }
};
