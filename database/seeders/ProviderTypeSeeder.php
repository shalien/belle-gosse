<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('provider_types')->insert([
            'name' => 'reddit'
        ]);


        DB::table('provider_types')->insert([
            'name' => 'otherbooru'
        ]);


        DB::table('provider_types')->insert([
            'name' => 'danbooru'
        ]);
    }
}
