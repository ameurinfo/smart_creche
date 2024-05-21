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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate');
            $table->enum('gender', ['male', 'female']);
            $table->string('address')->nullable();
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('job_title'); 
            $table->date('hire_date'); 
            $table->decimal('salary', 8, 2); 
            $table->string('image')->nullable(); 
            $table->text('notes')->nullable(); 
            $table->unsignedBigInteger('job_type_id'); 
            $table->foreign('job_type_id')->references('id')->on('job_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
