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
        Schema::table('ai_trader_plans', function (Blueprint $table) {
            // Add new investment_amount column
            $table->decimal('investment_amount', 10, 2)->default(0)->after('stocks_trading');
            
            // Drop unnecessary columns
            $table->dropColumn([
                'min_investment',
                'max_investment', 
                'expected_return_percentage',
                'trading_frequency_days',
                'max_users'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_trader_plans', function (Blueprint $table) {
            // Add back the dropped columns
            $table->decimal('min_investment', 10, 2)->default(0);
            $table->decimal('max_investment', 10, 2)->nullable();
            $table->decimal('expected_return_percentage', 5, 2)->nullable();
            $table->integer('trading_frequency_days')->default(1);
            $table->integer('max_users')->nullable();
            
            // Drop the new column
            $table->dropColumn('investment_amount');
        });
    }
};
