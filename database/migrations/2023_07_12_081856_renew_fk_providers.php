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
        Schema::table('providers', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('provider_link_id')->nullable()->change();
            $table->foreign('provider_link_id')->references('id')->on('provider_links')->nullOnDelete();

            $table->unsignedBigInteger('topic_id')->nullable()->change();
            $table->foreign('topic_id')->references('id')->on('topics')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            //
        });
    }
};