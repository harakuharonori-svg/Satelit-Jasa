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
            if (!Schema::hasColumn('transaksis', 'order_status')) {
                $table->enum('order_status', ['pending', 'in_progress', 'completed', 'cancelled'])
                      ->default('pending')
                      ->after('payment_status');
            }
            if (!Schema::hasColumn('transaksis', 'freelancer_response')) {
                $table->text('freelancer_response')->nullable()->after('order_status');
            }
            if (!Schema::hasColumn('transaksis', 'delivery_file')) {
                $table->string('delivery_file')->nullable()->after('freelancer_response');
            }
            if (!Schema::hasColumn('transaksis', 'freelancer_earnings')) {
                $table->decimal('freelancer_earnings', 15, 2)->nullable()->after('delivery_file');
            }
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['order_status', 'freelancer_response', 'delivery_file', 'freelancer_earnings']);
        });
    }
};