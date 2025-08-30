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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Store owner
            $table->string('withdrawal_id')->unique(); // Custom ID like WD-timestamp-storeid
            $table->decimal('amount', 12, 2);
            $table->decimal('admin_fee', 10, 2)->default(0);
            $table->decimal('net_amount', 12, 2); // Amount after admin fee
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('bank_account_name');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable(); // Internal notes
            $table->timestamp('requested_at');
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('transaction_reference')->nullable(); // Bank transfer reference
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null'); // Admin who processed
            $table->string('processing_method')->nullable(); // manual, auto, bank_api
            $table->timestamps();
            $table->index(['store_id', 'status']);
            $table->index(['status', 'requested_at']);
            $table->index('withdrawal_id');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
