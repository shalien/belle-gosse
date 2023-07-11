<?php

use App\Models\Provider;
use App\Models\ProviderLink;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $providers = Provider::all();

        foreach ($providers as $provider) {
            $provider_link = ProviderLink::where('link', $provider->link)->first();

            if(!$provider_link) {
                $provider_link = ProviderLink::create([
                    'link' => $provider->link,
                    'provider_type_id' => $provider->provider_type_id,
                ]);

                $provider_link->save();
            }

            $provider->provider_link_id = $provider_link->id;

            $provider_link->save();
            $provider->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            //
        });
    }
};
