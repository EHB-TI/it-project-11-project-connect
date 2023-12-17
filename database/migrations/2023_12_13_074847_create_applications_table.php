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
            $table->timestamps();
            $table->text('motivationContent')-> nullable();
            $table->text('fileUrl')->nullable();
            $table->string('status')->default('pending');
            $table->string('reason')->nullable();
           
            $table->unsignedBigInteger('applicant_id')->nullable(false);
            $table->foreign('applicant_id')->references('id')->on('users');
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
