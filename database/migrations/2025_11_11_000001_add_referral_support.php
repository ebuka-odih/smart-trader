<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'referral_code')) {
                $table->string('referral_code', 12)->nullable()->unique()->after('referral_balance');
            }

            if (!Schema::hasColumn('users', 'referred_by')) {
                $table->foreignUuid('referred_by')->nullable()->after('referral_code');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referred_by')) {
                $table->foreign('referred_by')->references('id')->on('users')->nullOnDelete();
            }
        });

        Schema::create('referrals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('referrer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('referred_user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->decimal('reward_amount', 15, 2)->default(0);
            $table->timestamps();
        });

        $this->seedReferralCodes();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referred_by')) {
                $table->dropForeign(['referred_by']);
                $table->dropColumn('referred_by');
            }

            if (Schema::hasColumn('users', 'referral_code')) {
                $table->dropColumn('referral_code');
            }
        });
    }

    private function seedReferralCodes(): void
    {
        $existingUsers = DB::table('users')->select('id', 'referral_code')->get();
        $knownCodes = $existingUsers->pluck('referral_code')->filter()->all();

        foreach ($existingUsers as $user) {
            if ($user->referral_code) {
                $knownCodes[] = $user->referral_code;
                continue;
            }

            $code = $this->generateUniqueCode($knownCodes);
            $knownCodes[] = $code;

            DB::table('users')
                ->where('id', $user->id)
                ->update(['referral_code' => $code]);
        }
    }

    private function generateUniqueCode(array $knownCodes = []): string
    {
        do {
            $code = Str::upper(Str::random(8));
        } while (in_array($code, $knownCodes, true));

        return $code;
    }
};
