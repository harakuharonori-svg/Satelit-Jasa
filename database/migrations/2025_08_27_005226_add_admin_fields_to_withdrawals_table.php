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
        Schema::table('withdrawals', function (Blueprint $table) {
            if (!Schema::hasColumn('withdrawals', 'processed_at')) {
                $table->timestamp('processed_at')->nullable()->after('requested_at');
            }
            if (!Schema::hasColumn('withdrawals', 'processed_by')) {
                $table->unsignedBigInteger('processed_by')->nullable()->after('processed_at');
            }
            if (!Schema::hasColumn('withdrawals', 'admin_notes')) {
                $table->text('admin_notes')->nullable()->after('notes');
            }
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            if (Schema::hasColumn('withdrawals', 'processed_at')) {
                $table->dropColumn('processed_at');
            }
            if (Schema::hasColumn('withdrawals', 'processed_by')) {
                $table->dropColumn('processed_by');
            }
            if (Schema::hasColumn('withdrawals', 'admin_notes')) {
                $table->dropColumn('admin_notes');
            }
        });
    }
};
