<?php

use App\Models\Provider;
use App\Models\ProviderLink;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $providers = Provider::distinct()->get(['link', 'provider_type_id']);

        foreach ($providers as $provider) {

            if($provider->link == null) continue;

            $providerLink = ProviderLink::create($provider->toArray());
            $providerLink->provider_type()->associate($provider->provider_type_id);
            $providerLink->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
