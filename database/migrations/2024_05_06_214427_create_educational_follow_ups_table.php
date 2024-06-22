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
        Schema::create('educational_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->foreign('child_id')->references('id')->on('children'); 
            $table->text('fear')->nullable();
            $table->text('aggressive_behavior')->nullable();
            $table->text('feeding')->nullable();
            $table->text('sleep')->nullable();
            $table->text('involuntary_urination')->nullable();
            $table->text('jealousy')->nullable();
            $table->integer('overall_rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_follow_ups');
    }
};
