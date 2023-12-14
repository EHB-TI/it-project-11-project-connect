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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 100)->unique();
            $table->string('description', 255)->nullable();
            $table->enum('status', ['pending', 'approved', 'closed', 'denied', 'published'])->default('pending');
            $table->string('filepath', 255)->nullable();
            $table->unsignedBigInteger('ownerID')->nullable();
            $table->unsignedBigInteger('spaceID')->nullable(); 

            $table->foreign('ownerID')->references('id')->on('users');
            $table->foreign('spaceID')->references('id')->on('spaces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
