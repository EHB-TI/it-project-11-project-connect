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
        Schema::create('notification_user_statuses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('seen')->default(false);

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('notification_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('notification_id')->references('id')->on('notifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_user_statuses');
    }
};
