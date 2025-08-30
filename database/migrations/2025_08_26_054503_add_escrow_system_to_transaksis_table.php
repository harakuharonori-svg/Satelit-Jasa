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
            $table->enum('escrow_status', ['held', 'released', 'refunded'])->default('held')->after('payment_status');
            $table->decimal('freelancer_earnings', 10, 2)->default(0)->after('total');
            $table->decimal('platform_fee', 10, 2)->default(0)->after('freelancer_earnings');
            $table->decimal('platform_fee_percent', 5, 2)->default(10.00)->after('platform_fee'); // 10% default
            $table->timestamp('delivered_at')->nullable()->after('expired_at');
            $table->timestamp('approved_at')->nullable()->after('delivered_at');
            $table->timestamp('released_at')->nullable()->after('approved_at');
            $table->integer('auto_release_days')->default(7)->after('released_at'); // Auto-release after 7 days
            $table->enum('project_status', ['pending', 'in_progress', 'delivered', 'completed', 'disputed'])->default('pending')->after('escrow_status');
            $table->text('delivery_notes')->nullable()->after('project_status');
            $table->text('approval_notes')->nullable()->after('delivery_notes');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn([
                'escrow_status',
                'freelancer_earnings',
                'platform_fee',
                'platform_fee_percent',
                'delivered_at',
                'approved_at',
                'released_at',
                'auto_release_days',
                'project_status',
                'delivery_notes',
                'approval_notes'
            ]);
        });
    }
};
