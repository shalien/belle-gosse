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

        Schema::table('medias', function (Blueprint $table) {
            //
            $table->dropForeign(['source_id']);
        });

        Schema::table('sources', function (Blueprint $table) {
            //
            $table->unique('link');
        });

        Schema::table('medias', function (Blueprint $table) {
            //
            $table->foreign('source_id')
                ->references('id')
                ->on('sources')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            //
        });
    }
};
