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
        Schema::table('user_notifications', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['user_id']);
            
            // Change the user_id column to match the users table (UUID)
            $table->uuid('user_id')->change();
            
            // Re-add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_notifications', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['user_id']);
            
            // Change back to integer (if needed)
            $table->unsignedBigInteger('user_id')->change();
            
            // Re-add the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
