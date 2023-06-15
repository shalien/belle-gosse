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
        $medias = DB::table('media')->select('source', 'destination', 'media')->get();

        foreach ($medias as $media) {

            $source = DB::table('sources')->select('id')->where('link', '=', $media->source)->get();
            $destination = DB::table('destinations')->select('id')->where('filename', '=', $media->destination)->get();


            DB::table('medias')->insert([
                'link' => $media->media,
                'source_id' => $source->firstOrFail()->id,
                'destination_id' => $destination->firstOrFail()->id,
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
        Schema::table('media', function (Blueprint $table) {
            //
        });
    }
};
