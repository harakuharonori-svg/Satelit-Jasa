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
            $table->string('external_id')->unique()->nullable()->after('id');
            $table->string('payment_method')->nullable()->after('status'); // qris, bca, bni, dll
            $table->string('payment_status')->default('pending')->after('payment_method'); // pending, paid, failed, expired
            $table->string('invoice_url')->nullable()->after('payment_status');
            $table->string('payment_reference')->nullable()->after('invoice_url'); // VA number, QR string, etc
            $table->json('payment_data')->nullable()->after('payment_reference'); // store xendit response
            $table->timestamp('paid_at')->nullable()->after('payment_data');
            $table->timestamp('expired_at')->nullable()->after('paid_at');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn([
                'external_id',
                'payment_method', 
                'payment_status',
                'invoice_url',
                'payment_reference',
                'payment_data',
                'paid_at',
                'expired_at'
            ]);
        });
    }
};
