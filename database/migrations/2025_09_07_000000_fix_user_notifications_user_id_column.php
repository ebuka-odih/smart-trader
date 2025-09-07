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
        // First, let's check what foreign key constraints exist
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'user_notifications' 
            AND COLUMN_NAME = 'user_id' 
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
        
        // Drop any existing foreign key constraints
        foreach ($foreignKeys as $fk) {
            DB::statement("ALTER TABLE user_notifications DROP FOREIGN KEY {$fk->CONSTRAINT_NAME}");
        }
        
        // Now modify the column
        DB::statement("ALTER TABLE user_notifications MODIFY COLUMN user_id VARCHAR(36) NOT NULL");
        
        // Re-add the foreign key constraint
        DB::statement("ALTER TABLE user_notifications ADD CONSTRAINT user_notifications_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE");
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
