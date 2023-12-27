<?php

use App\Models\_OLD\ProviderLink;
use App\Models\Path;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::disableForeignKeyConstraints();


        //
        $providerLinks = ProviderLink::all();

        foreach ($providerLinks as $providerLink) {

            $url = parse_url($providerLink->link);

            $host = $url['host'];

            $supplier = Supplier::firstOrCreate([
                'host' => $host,
                'provider_type_id' => $providerLink->provider_type_id,
            ]);


            if (isset($url['path'])) {
                $path = Path::firstOrCreate([
                    'content' => $url['path']
                ]);

                foreach ($providerLink->providers as $oldProvider) {
                    $path->topics()->attach($oldProvider->topic_id);

                    $oldProvider->sources()->update([
                        'path_id' => $path->id,
                    ]);


                    $oldProvider->delete();

                }

                if ($supplier->paths()->where('id', $path->id)->exists()) {
                    continue;
                }

                $supplier->paths()->attach($path->id);

            }

        }

        Schema::table('sources', function (Blueprint $table) {
            $table->dropConstrainedForeignId('provider_id');

        });


        Schema::table('providers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('provider_link_id');


            $table->dropConstrainedForeignId('topic_id');

        });

        Schema::table('provider_links', function (Blueprint $table) {
            $table->dropConstrainedForeignId('provider_type_id');
        });

        Schema::dropIfExists('providers');
        Schema::dropIfExists('provider_links');


        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
