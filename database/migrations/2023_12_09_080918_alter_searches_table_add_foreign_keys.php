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
        Schema::table('searches', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('path_id');
            $table->unsignedBigInteger('supplier_id');

            $table->foreign('topic_id')->references('id')->on('topics');
            $table->foreign('path_id')->references('id')->on('paths');
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            $table->index(['topic_id', 'path_id', 'supplier_id']);
            $table->unique(['topic_id', 'path_id', 'supplier_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('searches', function (Blueprint $table) {
            //
            $table->dropForeign(['topic_id']);
            $table->dropForeign(['path_id']);
            $table->dropForeign(['supplier_id']);
        });
    }
};
