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
        Schema::table('sources', function (Blueprint $table) {
            //

            $table->unsignedBigInteger('path_id')->nullable();
            $table->foreign('path_id')->references('id')->on('paths');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            //
            $table->dropForeign(['path_id']);
            $table->dropColumn('path_id');
        });
    }
};
