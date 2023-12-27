<?php

use App\Models\Search;
use App\Models\Topic;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        $topics = Topic::all();

        foreach ($topics as $topic) {
            $paths = $topic->paths;
            foreach ($paths as $path) {
                $suppliers = $path->suppliers;
                foreach ($suppliers as $supplier) {
                    $search = Search::firstOrCreate([
                        'topic_id' => $topic->id,
                        'path_id' => $path->id,
                        'supplier_id' => $supplier->id,
                    ]);

                }

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
