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
        Schema::table('queries_topics', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('query_id')->nullable();
            $table->foreign('query_id')->references('id')->on('queries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('queries_topics', function (Blueprint $table) {
            //
            $table->dropForeign(['query_id']);
            $table->dropColumn('query_id');
        });
    }
};
