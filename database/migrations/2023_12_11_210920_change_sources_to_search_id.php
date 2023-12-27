<?php

use App\Models\Source;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the source to have a search_id based
        // on the topic_id, path_id, and supplier_id
        // from the search table

        Source::query()->update([
            'search_id' => DB::raw('(
                SELECT searches.id
                FROM searches
                WHERE searches.topic_id = sources.topic_id
                AND searches.path_id = sources.path_id
                AND searches.supplier_id = sources.supplier_id
            )'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sources', function (Blueprint $table) {
            //
        });
    }
};
