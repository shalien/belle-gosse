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
        $medias = DB::table('media')->select('source', 'provider_id')->get();

        foreach ($medias as $media) {
            DB::table('sources')->where('link', $media->source)->update(['provider_id' => $media->provider_id]);
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
