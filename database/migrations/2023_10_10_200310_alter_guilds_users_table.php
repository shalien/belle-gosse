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
        Schema::table('guild_user', function (Blueprint $table) {
            //

            $table->unsignedBigInteger('guild_snowflake');
            $table->unsignedBigInteger('user_snowflake');

            $table->foreign('guild_snowflake')->references('snowflake')->on('guilds');
            $table->foreign('user_snowflake')->references('snowflake')->on('users');

            $table->primary(['guild_snowflake', 'user_snowflake']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guild_user', function (Blueprint $table) {
            //
        });
    }
};
