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
        Schema::table('guilds_users', function (Blueprint $table) {
            //

            $table->unsignedBigInteger('guild_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('guild_id')->references('snowflake')->on('guilds');
            $table->foreign('user_id')->references('snowflake')->on('users');

            $table->primary(['guild_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guilds_users', function (Blueprint $table) {
            //
        });
    }
};
