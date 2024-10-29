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
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->json('certificate')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->json('portfolio')->nullable();
            $table->string('educational_files')->nullable();
            $table->unsignedInteger('experiance');
            $table->string('college')->nullable();
            $table->unsignedBigInteger('educational_status_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('educational_status_id')->references('id')->on('educational_statuses')->onDelete('cascade');
            $table->foreign('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancers');
    }
};
