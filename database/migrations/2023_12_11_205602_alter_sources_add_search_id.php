<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('search_id')->nullable();
            $table->foreign('search_id')->references('id')->on('searches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            //
            $table->dropForeign(['search_id']);
            $table->dropColumn('search_id');
        });
    }
};
