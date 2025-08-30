<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Log;

class AutoReleaseEscrow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'escrow:auto-release {--dry-run : Show what would be released without actually releasing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically release escrow for overdue delivered projects';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        $this->info('Starting auto-release escrow process...');
        
        if ($isDryRun) {
            $this->warn('DRY RUN MODE - No actual changes will be made');
        }

        // Find overdue transactions that should be auto-released
        $overdueTransaksis = Transaksi::where('escrow_status', 'held')
            ->where('project_status', 'delivered')
            ->whereNotNull('delivered_at')
            ->get()
            ->filter(function ($transaksi) {
                return $transaksi->shouldAutoRelease();
            });

        if ($overdueTransaksis->isEmpty()) {
            $this->info('No transactions found for auto-release.');
            return 0;
        }

        $this->info("Found {$overdueTransaksis->count()} transactions eligible for auto-release:");

        $table = [];
        $totalAmount = 0;
        $releasedCount = 0;

        foreach ($overdueTransaksis as $transaksi) {
            $daysOverdue = now()->diffInDays($transaksi->delivered_at->addDays($transaksi->auto_release_days ?? 7));
            $earnings = $transaksi->freelancer_earnings ?? $transaksi->calculateEarnings()['freelancer_earnings'];
            
            $table[] = [
                'ID' => $transaksi->id,
                'Customer' => $transaksi->user->name ?? 'Unknown',
                'Freelancer' => $transaksi->jasa->store->user->name ?? 'Unknown',
                'Service' => $transaksi->jasa->nama_jasa ?? 'Unknown',
                'Amount' => 'Rp ' . number_format($earnings, 0, ',', '.'),
                'Delivered' => $transaksi->delivered_at->format('d/m/Y H:i'),
                'Days Overdue' => $daysOverdue,
                'Status' => $isDryRun ? 'WOULD RELEASE' : 'RELEASING'
            ];

            $totalAmount += $earnings;

            if (!$isDryRun) {
                try {
                    $transaksi->releaseEscrow(null, 'Auto-released after ' . ($transaksi->auto_release_days ?? 7) . ' days');
                    $releasedCount++;
                    
                    Log::info('Auto-released escrow', [
                        'transaksi_id' => $transaksi->id,
                        'amount' => $earnings,
                        'customer' => $transaksi->user->name,
                        'freelancer' => $transaksi->jasa->store->user->name
                    ]);
                    
                } catch (\Exception $e) {
                    $this->error("Failed to release escrow for transaction {$transaksi->id}: " . $e->getMessage());
                    
                    Log::error('Failed to auto-release escrow', [
                        'transaksi_id' => $transaksi->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }

        $this->table([
            'ID', 'Customer', 'Freelancer', 'Service', 'Amount', 'Delivered', 'Days Overdue', 'Status'
        ], $table);

        if ($isDryRun) {
            $this->info("\nDRY RUN SUMMARY:");
            $this->info("Transactions that would be released: " . $overdueTransaksis->count());
            $this->info("Total amount that would be released: Rp " . number_format($totalAmount, 0, ',', '.'));
            $this->info("\nRun without --dry-run to actually release the escrow.");
        } else {
            $this->info("\nAUTO-RELEASE SUMMARY:");
            $this->info("Successfully released: {$releasedCount} transactions");
            $this->info("Total amount released: Rp " . number_format($totalAmount, 0, ',', '.'));
            
            if ($releasedCount !== $overdueTransaksis->count()) {
                $this->warn("Some transactions failed to release. Check logs for details.");
            }
        }

        return 0;
    }
}
