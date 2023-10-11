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
        Schema::table('users_roles', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('snowflake')->on('users');

            $table->unsignedBigInteger('role_id')->nullable();
            $table->foreign('role_id')->references('snowflake')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_roles', function (Blueprint $table) {
            //
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);
        });
    }
};