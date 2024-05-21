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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id'); 
            $table->foreign('child_id')->references('id')->on('children'); 
            $table->string('blood_type')->nullable(); 
            $table->text('allergies')->nullable(); 
            $table->text('chronic_diseases')->nullable(); 
            $table->text('medications')->nullable();
            $table->string('emergency_contact_name'); 
            $table->string('emergency_contact_number'); 
            $table->text('notes')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
