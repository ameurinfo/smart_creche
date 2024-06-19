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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate');
            $table->enum('gender', ['ذكر', 'أنثى']);
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            
            $table->string('image')->nullable(); 
            $table->text('notes')->nullable(); 
            $table->unsignedBigInteger('parents_id'); 
            $table->foreign('parents_id')->references('id')->on('parents');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
