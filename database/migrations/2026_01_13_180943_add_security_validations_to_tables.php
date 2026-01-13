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
        // 1. Add CHECK constraints for adoptions status
        DB::statement("ALTER TABLE adoptions ADD CONSTRAINT adoptions_status_check CHECK (status IN ('pending', 'approved', 'rejected'))");

        // 2. Add CHECK constraints for animals status
        DB::statement("ALTER TABLE animals ADD CONSTRAINT animals_status_check CHECK (status IN ('Disponível', 'Adotado'))");

        // 3. Add CHECK constraints for volunteers status
        DB::statement("ALTER TABLE volunteers ADD CONSTRAINT volunteers_status_check CHECK (status IN ('pending', 'approved', 'rejected'))");

        // 4. Add CHECK constraints for donations status
        DB::statement("ALTER TABLE donations ADD CONSTRAINT donations_status_check CHECK (status IN ('pending', 'completed', 'paid', 'failed'))");

        // 5. Add CHECK constraint for comments rating (1-5)
        DB::statement("ALTER TABLE comments ADD CONSTRAINT comments_rating_check CHECK (rating IS NULL OR (rating >= 1 AND rating <= 5))");

        // 6. Add CHECK constraint for animals age (non-negative)
        DB::statement("ALTER TABLE animals ADD CONSTRAINT animals_age_check CHECK (age IS NULL OR age >= 0)");

        // 7. Add soft deletes to animals, comments, success_stories
        Schema::table('animals', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('success_stories', function (Blueprint $table) {
            $table->softDeletes();
        });

        // 8. Add rate limiting columns for spam prevention
        Schema::table('comments', function (Blueprint $table) {
            $table->timestamp('last_comment_at')->nullable()->after('updated_at');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->timestamp('last_message_at')->nullable()->after('updated_at');
        });

        // 9. Add indices for security queries (only if they don't exist)
        if (!Schema::hasIndex('adoptions', ['user_id', 'status'])) {
            Schema::table('adoptions', function (Blueprint $table) {
                $table->index(['user_id', 'status']);
            });
        }

        if (!Schema::hasIndex('donations', ['user_id', 'status'])) {
            Schema::table('donations', function (Blueprint $table) {
                $table->index(['user_id', 'status']);
            });
        }

        if (!Schema::hasIndex('volunteers', ['user_id', 'status'])) {
            Schema::table('volunteers', function (Blueprint $table) {
                $table->index(['user_id', 'status']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop CHECK constraints
        DB::statement("ALTER TABLE adoptions DROP CONSTRAINT IF EXISTS adoptions_status_check");
        DB::statement("ALTER TABLE animals DROP CONSTRAINT IF EXISTS animals_status_check");
        DB::statement("ALTER TABLE volunteers DROP CONSTRAINT IF EXISTS volunteers_status_check");
        DB::statement("ALTER TABLE donations DROP CONSTRAINT IF EXISTS donations_status_check");
        DB::statement("ALTER TABLE comments DROP CONSTRAINT IF EXISTS comments_rating_check");
        DB::statement("ALTER TABLE animals DROP CONSTRAINT IF EXISTS animals_age_check");

        // Drop soft deletes
        Schema::table('animals', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('success_stories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        // Drop rate limiting columns
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('last_comment_at');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('last_message_at');
        });

        // Drop indices
        Schema::table('adoptions', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
        });

        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
        });
    }
};
