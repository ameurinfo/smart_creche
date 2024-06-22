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
        Schema::create('cumulative_records', function (Blueprint $table) {
            $table->id();
            $table->string('age');
            $table->string('mental_age')->nullable();
            $table->string('disability')->nullable();
            $table->integer('family_members')->nullable();
            $table->integer('siblings')->nullable();
            $table->string('parents')->nullable();
            $table->string('child_order')->nullable();
            $table->string('living_with')->nullable();
            $table->string('economic_status')->nullable();
            $table->string('home_status')->nullable();
            $table->string('hearing')->nullable();
            $table->string('vision')->nullable();
            $table->string('taste')->nullable();
            $table->string('touch')->nullable();
            $table->string('speech')->nullable();
            $table->string('chronic_disease')->nullable();
            $table->string('intelligence_tests')->nullable();
            $table->string('special_abilities')->nullable();
            $table->string('psychological_tests')->nullable();
            $table->text('cognitive')->nullable();
            $table->string('attention_concentration')->nullable();
            $table->text('memory')->nullable();
            $table->string('eating')->nullable();
            $table->string('cleanliness')->nullable();
            $table->string('dressing')->nullable();
            $table->text('activities')->nullable();
            $table->string('highly_emotional')->nullable();
            $table->string('introverted')->nullable();
            $table->unsignedBigInteger('child_id');
            $table->foreign('child_id')->references('id')->on('children'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cumulative_records');
    }
};
