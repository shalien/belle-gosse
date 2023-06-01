<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::table('type_to_provider_types_id', function (Blueprint $table) {
            //
            // Get unique values from providers.type and insert into provider_types.name
            $uniqueProviderTypes = DB::table('providers')->select('type')->distinct()->get();

            foreach ($uniqueProviderTypes as $providerType) {
                DB::table('provider_types')->insert([
                    'name' => $providerType->type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Populate provider_type_id based on provider_types.name
            DB::statement('UPDATE providers
            INNER JOIN provider_types ON providers.type = provider_types.name
            SET providers.provider_type_id = provider_types.id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_to_provider_types_id', function (Blueprint $table) {
            //
        });
    }
};
