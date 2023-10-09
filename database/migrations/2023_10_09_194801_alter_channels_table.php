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
        Schema::table('channels', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('guild_id')->nullable()->after('snowflake');
            $table->foreign('guild_id')->references('snowflake')->on('guilds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('channels', function (Blueprint $table) {
            //
            $table->dropForeign(['guild_id']);
        });
    }
};
