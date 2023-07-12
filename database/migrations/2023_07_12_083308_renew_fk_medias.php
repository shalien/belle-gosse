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
            $table->unsignedBigInteger('source_id')->nullable()->change();
            $table->foreign('source_id')->references('id')->on('sources')->nullOnDelete();

            $table->unsignedBigInteger('destination_id')->nullable()->change();
            $table->foreign('destination_id')->references('id')->on('destinations')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medias', function (Blueprint $table) {
            //
        });
    }
};
