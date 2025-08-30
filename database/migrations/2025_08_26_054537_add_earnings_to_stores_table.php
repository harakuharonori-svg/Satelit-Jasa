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
        Schema::table('stores', function (Blueprint $table) {
            $table->decimal('total_earnings', 12, 2)->default(0)->after('deskripsi');
            $table->decimal('available_balance', 12, 2)->default(0)->after('total_earnings');
            $table->decimal('pending_balance', 12, 2)->default(0)->after('available_balance');
            $table->decimal('withdrawn_amount', 12, 2)->default(0)->after('pending_balance');
            $table->decimal('minimum_withdrawal', 10, 2)->default(100000)->after('withdrawn_amount'); // 100k minimum
            $table->boolean('auto_withdrawal_enabled')->default(false)->after('minimum_withdrawal');
            $table->integer('auto_withdrawal_threshold')->default(1000000)->after('auto_withdrawal_enabled'); // 1M threshold
            $table->string('bank_name')->nullable()->after('auto_withdrawal_threshold');
            $table->string('bank_account_number')->nullable()->after('bank_name');
            $table->string('bank_account_name')->nullable()->after('bank_account_number');
            $table->integer('completed_orders')->default(0)->after('bank_account_name');
            $table->decimal('average_rating', 3, 2)->default(0)->after('completed_orders');
            $table->integer('total_reviews')->default(0)->after('average_rating');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn([
                'total_earnings',
                'available_balance',
                'pending_balance',
                'withdrawn_amount',
                'minimum_withdrawal',
                'auto_withdrawal_enabled',
                'auto_withdrawal_threshold',
                'bank_name',
                'bank_account_number',
                'bank_account_name',
                'completed_orders',
                'average_rating',
                'total_reviews'
            ]);
        });
    }
};
