<?php

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
        // Use try-catch to handle the case where foreign key doesn't exist
        try {
            Schema::table('user_ai_traders', function (Blueprint $table) {
                // Try to drop the existing foreign key constraint and column
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        } catch (Exception $e) {
            // If foreign key doesn't exist, just try to drop the column
            try {
                Schema::table('user_ai_traders', function (Blueprint $table) {
                    $table->dropColumn('user_id');
                });
            } catch (Exception $e2) {
                // Column might not exist, continue
            }
        }

        Schema::table('user_ai_traders', function (Blueprint $table) {
            // Add the user_id column as nullable UUID first
            $table->uuid('user_id')->nullable()->after('id');
        });

        Schema::table('user_ai_traders', function (Blueprint $table) {
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Re-add the indexes
            $table->index(['user_id', 'status']);
            $table->unique(['user_id', 'ai_trader_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('user_ai_traders', function (Blueprint $table) {
                // Drop the UUID foreign key constraint and column
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        } catch (Exception $e) {
            // If foreign key doesn't exist, just try to drop the column
            try {
                Schema::table('user_ai_traders', function (Blueprint $table) {
                    $table->dropColumn('user_id');
                });
            } catch (Exception $e2) {
                // Column might not exist, continue
            }
        }

        Schema::table('user_ai_traders', function (Blueprint $table) {
            // Add back the integer user_id column
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->index(['user_id', 'status']);
            $table->unique(['user_id', 'ai_trader_id', 'status']);
        });
    }
};