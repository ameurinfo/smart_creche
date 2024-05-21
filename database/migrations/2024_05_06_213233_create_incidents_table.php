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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id'); 
            $table->foreign('child_id')->references('id')->on('children');
            $table->dateTime('datetime');
            $table->string('location'); 
            $table->text('description'); 
            $table->text('actions_taken'); 
            $table->enum('type', ['fall', 'injury', 'bite', 'other']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
