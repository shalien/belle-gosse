<?php

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
            $table->dropConstrainedForeignIdFor(\App\Models\ProviderLink::class, 'provider_link_id');
            $table->dropConstrainedForeignIdFor(\App\Models\Topic::class, 'topic_id');
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
