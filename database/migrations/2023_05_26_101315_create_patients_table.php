<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
     public function up()
     {
         Schema::create('patients', function (Blueprint $table) {
             $table->id();
             $table->string('name');
             $table->unsignedBigInteger('gender_id');
             $table->unsignedBigInteger('service_id');
             $table->timestamps();
     
             $table->foreign('gender_id')->references('id')->on('genders');
             $table->foreign('service_id')->references('id')->on('services');
         });
     }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
