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
            //   $table->unsignedBigInteger('path_id')->nullable();
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();

            $table->foreign(['topic_id', 'path_id', 'supplier_id'])
                ->references(['topic_id', 'path_id', 'supplier_id'])
                ->on('searches');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            //
            $table->dropForeign(['path_id', 'topic_id', 'supplier_id']);
            $table->dropColumn(['path_id', 'topic_id', 'supplier_id']);
        });
    }
};
