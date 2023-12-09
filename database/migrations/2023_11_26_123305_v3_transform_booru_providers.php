<?php

use App\Models\_OLD\TopicAlias;
use App\Models\Path;
use App\Models\ProviderType;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //

        $suppliers = Supplier::all();

        $redditProviderType = ProviderType::where('name', 'reddit')->first();

        $realbooruSupplier = $suppliers->where('host', 'realbooru.com')->first();

        $redditSuppliers = $suppliers->where('provider_type_id', $redditProviderType->id);

        foreach ($redditSuppliers as $redditSupplier) {

            $redditPath = $redditSupplier->paths;

            foreach ($redditPath as $path) {

                $topics = $path->topics;

                foreach ($topics as $topic) {

                    $path = Path::firstOrCreate([
                        'content' => $topic->name,
                    ]);

                    if ($realbooruSupplier->paths()->where('id', $path->id)->exists()) {
                        continue;
                    }

                    $realbooruSupplier->paths()->attach($path->id);

                    if ($path->topics()->where('id', $topic->id)->exists()) {
                        continue;
                    }

                    $path->topics()->attach($topic->id);

                }

            }
        }

        $topicAlias = TopicAlias::all();

        $booruSupplierWithoutRealbooru = $suppliers->where('provider_type_id', '!=', $redditProviderType->id);

        foreach ($booruSupplierWithoutRealbooru as $supplier) {

            foreach ($topicAlias as $alias) {

                $path = Path::firstOrCreate([
                    'content' => $alias->alias,
                ]);

                if ($supplier->paths()->where('id', $path->id)->exists()) {
                    continue;
                }

                $supplier->paths()->attach($path->id);

                if ($path->topics()->where('id', $alias->topic_id)->exists()) {
                    continue;
                }

                $path->topics()->attach($alias->topic_id);

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
