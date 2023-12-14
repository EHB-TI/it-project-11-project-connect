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
        Schema::create('notification_user_status', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('seen')->default(false);

            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('notificationId');

            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('notificationId')->references('id')->on('notifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_user_status');
    }
};
