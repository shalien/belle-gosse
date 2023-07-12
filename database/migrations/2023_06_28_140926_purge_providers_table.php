<?php

use App\Models\ProviderType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            //
            if (Schema::hasColumn('providers', 'link')) {
                $table->dropColumn('link');
            }

            if (Schema::hasColumn('providers', 'provider_type_id')) {
                $table->dropConstrainedForeignIdFor(ProviderType::class);
            }
        });
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
