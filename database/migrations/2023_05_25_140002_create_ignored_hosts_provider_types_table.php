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
        Schema::create('ignored_hosts_provider_types', function (Blueprint $table) {
            $table->unsignedBigInteger('ignored_host_id');
            $table->unsignedBigInteger('provider_type_id');

            $table->primary(['ignored_host_id', 'provider_type_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ignored_hosts_provider_types');
    }
};
