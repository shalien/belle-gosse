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
        Schema::table('sources', function (Blueprint $table) {
            //

            $duplicatesSouces = DB::table('sources')
                ->select('link', DB::raw('count(*) as total'))
                ->groupBy('link')
                ->having('total', '>', 1)
                ->get();

            foreach ($duplicatesSouces as $duplicateSource) {
                Source::where('link', $duplicateSource->link)->delete();
            }

        });
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
