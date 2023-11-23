<?php

use App\Models\Provider;
use App\Models\ProviderLink;
use App\Models\Query;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        $providerLinks = ProviderLink::all();

        foreach ($providerLinks as $providerLink) {

            $url = parse_url($providerLink->link);

            $host = $url['host'];

            $provider = Provider::firstOrCreate([
                'host' => $host,
                'provider_type_id' => $providerLink->provider_type_id,
            ]);


    if(isset($url['path'])) {
             $query = Query::firstOrCreate([
                'content' => $url['path'],
                'provider_id' => $provider->id]);

             foreach($providerLink->old_providers as $oldProvider) {
                 $query->topics()->attach($oldProvider->topic_id);
             }

          } else {
        dd($url);
    }
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
