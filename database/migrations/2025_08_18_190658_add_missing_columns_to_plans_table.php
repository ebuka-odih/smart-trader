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
        Schema::table('plans', function (Blueprint $table) {
            // Add missing columns
            $table->string('max_lot_size')->nullable()->after('minimum_deposit');
            
            // Rename commission to swap_fees
            $table->renameColumn('commission', 'swap_fees');
            
            // Update pairs column type from integer to string
            $table->string('pairs')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            // Remove added columns
            $table->dropColumn('max_lot_size');
            
            // Rename swap_fees back to commission
            $table->renameColumn('swap_fees', 'commission');
            
            // Revert pairs column type back to integer
            $table->integer('pairs')->nullable()->change();
        });
    }
};
