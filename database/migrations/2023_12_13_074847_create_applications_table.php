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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->text('motivationcontent')-> nullable();
            $table->string('fileurl')->nullable();
            $table->string('status');
            $table->string('reason');
           
            $table->unsignedBigInteger('applicantID')->nullable(false);
            $table->foreign('applicantID')->references('id')->on('users');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
