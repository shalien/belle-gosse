<?php

use App\Models\Provider;
use App\Models\ProviderLink;
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
        Schema::create('provider_provider_link', function (Blueprint $table) {
            $table->foreignIdFor(Provider::class, 'provider_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ProviderLink::class, 'provider_link_id')->constrained()->cascadeOnDelete();
            $table->primary(['provider_id', 'provider_link_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers_provider_links');
    }
};
