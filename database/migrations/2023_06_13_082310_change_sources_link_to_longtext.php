<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sources', function (Blueprint $table) {
            //
            $table->dropUnique('sources_link_unique');

            $table->longText('link')->change();

            switch (DB::getDriverName()) {
                case 'mysql':
                case 'mariadb':
                    DB::statement('ALTER TABLE sources ADD UNIQUE `sources_link_unique` (`link`(255));');
                    break;
                default:
                    $table->unique('link');
                    break;
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sources', function (Blueprint $table) {
            //
        });
    }
};
