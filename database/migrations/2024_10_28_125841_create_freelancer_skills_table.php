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
        Schema::create('freelancer_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('freelancer_id');
            $table->foreign('freelancer_id')->references('id')->on('freelancers')->onDelete('cascade');
            $table->unsignedBigInteger('skill_list_id');
            $table->foreign('skill_list_id')->references('id')->on('skill_lists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_skills');
    }
};
