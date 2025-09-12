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
        Schema::table('ai_trader_subscriptions', function (Blueprint $table) {
            // Drop the existing foreign key constraint and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('ai_trader_subscriptions', function (Blueprint $table) {
            // Add the user_id column as UUID
            $table->uuid('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Re-add the index
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_trader_subscriptions', function (Blueprint $table) {
            // Drop the UUID foreign key constraint and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('ai_trader_subscriptions', function (Blueprint $table) {
            // Add back the integer user_id column
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->index(['user_id', 'status']);
        });
    }
};