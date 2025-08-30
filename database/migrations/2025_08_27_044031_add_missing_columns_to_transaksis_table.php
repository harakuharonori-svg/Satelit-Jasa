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
            if (!Schema::hasColumn('transaksis', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('approved_at');
            }
            if (!Schema::hasColumn('transaksis', 'freelancer_response_at')) {
                $table->timestamp('freelancer_response_at')->nullable()->after('freelancer_response');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            if (Schema::hasColumn('transaksis', 'completed_at')) {
                $table->dropColumn('completed_at');
            }
            if (Schema::hasColumn('transaksis', 'freelancer_response_at')) {
                $table->dropColumn('freelancer_response_at');
            }
        });
    }
};
