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
        Schema::create('progress_trackings', function (Blueprint $table) {
            $table->id();
            $table->json('file');
            $table->longText('message');
            $table->unsignedBigInteger('proffesional_id');
            $table->unsignedBigInteger('contract_id');
            $table->foreign('proffesional_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_trackings');
    }
};
