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
        Schema::create('live_trades', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->string('asset_type'); // crypto, stock, forex
            $table->string('symbol'); // BTC/USDT, AAPL, EUR/USD
            $table->string('order_type'); // limit, market
            $table->string('side'); // buy, sell
            $table->decimal('quantity', 18, 8)->nullable(); // For limit orders
            $table->decimal('price', 18, 8)->nullable(); // For limit orders
            $table->decimal('amount', 18, 8); // Total USD amount
            $table->decimal('leverage', 5, 2)->default(1.00);
            $table->string('status')->default('pending'); // pending, filled, cancelled, rejected
            $table->timestamp('filled_at')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'status']);
            $table->index(['asset_type', 'symbol']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_trades');
    }
};
