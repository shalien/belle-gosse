<?php

use App\Models\ProviderLink;
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
        Schema::table('providers', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('provider_link_id')->nullable();

            $table->foreign('provider_link_id')
                ->references('id')
                ->on('provider_links')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('providers', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignIdFor(ProviderLink::class);
        });
    }
};
