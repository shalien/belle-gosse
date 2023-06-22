<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         *         'type',
        'link',
        'topic_id',
        'prefix'
         */
        //
        DB::table('providers')->insert([
            'link' => 'https://reddit.com/r/cats',
            'topic_id' => 1,
            'prefix' => '',
            'provider_type_id' => 1,
        ]);
    }
}
