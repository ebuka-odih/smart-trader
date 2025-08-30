<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix for MySQL key length issues
        if (config('database.default') === 'mysql') {
            // Drop existing indexes that might cause issues
            try {
                DB::statement('DROP INDEX IF EXISTS bot_tradings_base_asset_quote_asset_index ON bot_tradings');
            } catch (Exception $e) {
                // Index doesn't exist, continue
            }
            
            // Recreate the index with proper naming
            Schema::table('bot_tradings', function (Blueprint $table) {
                $table->index(['base_asset', 'quote_asset'], 'bot_tradings_pair_index');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (config('database.default') === 'mysql') {
            Schema::table('bot_tradings', function (Blueprint $table) {
                $table->dropIndex('bot_tradings_pair_index');
            });
        }
    }
};
