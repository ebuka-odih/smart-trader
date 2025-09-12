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
            // Drop indexes that reference user_id
            $table->dropIndex(['user_id', 'status']);
            $table->dropUnique(['user_id', 'ai_trader_plan_id', 'status']);
            // Drop the existing foreign key constraint and column
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('ai_trader_subscriptions', function (Blueprint $table) {
            // Add the user_id column as nullable UUID
            $table->uuid('user_id')->nullable()->after('id');
        });

        Schema::table('ai_trader_subscriptions', function (Blueprint $table) {
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Add indexes
            $table->index(['user_id', 'status']);
            $table->unique(['user_id', 'ai_trader_plan_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_trader_subscriptions', function (Blueprint $table) {
            // Drop foreign key constraint and column
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