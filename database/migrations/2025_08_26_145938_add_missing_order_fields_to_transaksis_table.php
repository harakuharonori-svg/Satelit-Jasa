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
        Schema::table('transaksis', function (Blueprint $table) {
            if (!Schema::hasColumn('transaksis', 'cancellation_reason')) {
                $table->text('cancellation_reason')->nullable()->after('delivered_at');
            }
            if (!Schema::hasColumn('transaksis', 'cancelled_at')) {
                $table->timestamp('cancelled_at')->nullable()->after('cancellation_reason');
            }
            if (!Schema::hasColumn('transaksis', 'refund_status')) {
                $table->enum('refund_status', ['none', 'pending', 'completed'])->default('none')->after('cancelled_at');
            }
            if (!Schema::hasColumn('transaksis', 'refund_amount')) {
                $table->decimal('refund_amount', 12, 2)->nullable()->after('refund_status');
            }
            if (!Schema::hasColumn('transaksis', 'refunded_at')) {
                $table->timestamp('refunded_at')->nullable()->after('refund_amount');
            }
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn([
                'cancellation_reason',
                'cancelled_at',
                'refund_status',
                'refund_amount',
                'refunded_at'
            ]);
        });
    }
};
