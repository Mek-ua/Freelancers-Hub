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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposals_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('term_and_conditions');
            $table->json('file');
            $table->boolean('pro_is_finished');
            $table->boolean(' client_is_finished');
            $table->tinyInteger('service_fee_status');
            $table->tinyInteger(' acceptance_status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_fee_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('proposals_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->foreign('service_fee_id')->references('id')->on('service_fees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
