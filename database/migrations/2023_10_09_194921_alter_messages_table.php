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
        Schema::table('messages', function (Blueprint $table) {
            // Author
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('snowflake')->on('users')->onDelete('cascade');

            // Parents
            $table->unsignedBigInteger('message_id')->nullable();
            $table->foreign('message_id')->references('snowflake')->on('messages')->onDelete('cascade');

            // Channel
            $table->unsignedBigInteger('channel_id')->nullable();
            $table->foreign('channel_id')->references('snowflake')->on('channels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            //
        });
    }
};