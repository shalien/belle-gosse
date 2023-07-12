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
        Schema::create('provider_links', function (Blueprint $table) {
            $table->id();
            $table->longText('link')->unique()->index()->fulltext();
            $table->foreignIdFor(ProviderType::class, 'provider_type_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_links');
    }
};