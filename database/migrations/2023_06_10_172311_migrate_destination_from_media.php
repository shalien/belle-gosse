<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $uniqueDestinations = DB::table('media')->select('destination')->distinct()->get();

        foreach ($uniqueDestinations as $destination) {
            DB::table('destinations')->insert([
                'filename' => $destination->destination,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
