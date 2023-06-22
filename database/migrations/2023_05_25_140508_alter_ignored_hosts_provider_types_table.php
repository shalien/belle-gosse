<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ignored_hosts_provider_types', function (Blueprint $table) {
            //
            $table->foreign('provider_type_id')
                ->references('id')
                ->on('provider_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('ignored_host_id')
                ->references('id')
                ->on('ignored_hosts')
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
        Schema::table('ignored_hosts_provider_types', function (Blueprint $table) {
            //
        });
    }
};
