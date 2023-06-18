<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medias', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('source_id');

            $table->foreign('source_id')
                ->references('id')
                ->on('sources')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->unsignedBigInteger('destination_id');

            $table->foreign('destination_id')
                ->references('id')
                ->on('destinations')
                ->onUpdate('cascade')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medias', function (Blueprint $table) {
            //
        });
    }
};
