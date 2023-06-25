<?php

use App\Models\ProviderType;
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
        Schema::table('provider_links', function (Blueprint $table) {
            //
            $table->foreignIdFor(ProviderType::class, 'provider_type_id')->constrained()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provider_links', function (Blueprint $table) {
            //
            $table->dropForeign(['provider_type_id']);
        });
    }
};
