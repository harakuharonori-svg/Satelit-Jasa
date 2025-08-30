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
        Schema::create('project_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade');
            $table->foreignId('delivered_by')->constrained('users')->onDelete('cascade'); // Freelancer who delivered
            $table->text('delivery_message')->nullable();
            $table->json('delivery_files')->nullable(); // Array of file paths
            $table->enum('delivery_type', ['file', 'link', 'text', 'mixed'])->default('mixed');
            $table->enum('status', ['delivered', 'approved', 'rejected', 'revision_requested'])->default('delivered');
            $table->timestamp('delivered_at');
            $table->timestamp('viewed_at')->nullable(); // When customer viewed
            $table->timestamp('responded_at')->nullable(); // When customer responded
            $table->text('customer_feedback')->nullable();
            $table->integer('customer_rating')->nullable(); // 1-5 stars
            $table->boolean('requires_revision')->default(false);
            $table->text('revision_notes')->nullable();
            $table->json('file_metadata')->nullable(); // File sizes, types, etc.
            $table->boolean('is_final_delivery')->default(true);
            $table->integer('revision_number')->default(1);
            $table->timestamps();
            $table->index(['transaksi_id', 'status']);
            $table->index(['delivered_by', 'delivered_at']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_deliveries');
    }
};
