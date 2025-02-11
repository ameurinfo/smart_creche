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
        Schema::create('health_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id'); 
            $table->foreign('child_id')->references('id')->on('children'); 
            $table->date('date'); 
            $table->text('notes'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_follow_ups');
    }
};
