<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class XenditWebhookController extends Controller
{
    protected $xenditService;

    public function __construct(XenditService $xenditService)
    {
        $this->xenditService = $xenditService;
    }

    /**
     * Handle Xendit webhook
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('X-CALLBACK-TOKEN');

        // Verify webhook signature (optional, but recommended)
        if (config('xendit.webhook_token')) {
            if (!$this->xenditService->verifyWebhook($payload, $signature)) {
                Log::warning('Invalid webhook signature from Xendit');
                return response()->json(['message' => 'Invalid signature'], 400);
            }
        }

        $data = json_decode($payload, true);
        
        if (!$data) {
            Log::error('Invalid JSON payload from Xendit webhook');
            return response()->json(['message' => 'Invalid JSON'], 400);
        }

        try {
            // Log webhook for debugging
            Log::info('Xendit webhook received', $data);

            // Handle different webhook types
            $eventType = $data['event'] ?? $data['status'] ?? null;
            
            switch ($eventType) {
                case 'invoice.paid':
                case 'PAID':
                    $this->handlePaymentPaid($data);
                    break;
                    
                case 'invoice.expired':
                case 'EXPIRED':
                    $this->handlePaymentExpired($data);
                    break;
                    
                case 'invoice.failed':
                case 'FAILED':
                    $this->handlePaymentFailed($data);
                    break;
                    
                case 'qr_code.callback':
                    $this->handleQRCodeCallback($data);
                    break;
                    
                case 'virtual_account.callback':
                    $this->handleVirtualAccountCallback($data);
                    break;
                    
                default:
                    Log::info('Unhandled webhook event type: ' . $eventType, $data);
            }

            return response()->json(['message' => 'Webhook processed successfully']);

        } catch (\Exception $e) {
            Log::error('Error processing Xendit webhook: ' . $e->getMessage(), [
                'payload' => $data,
                'exception' => $e
            ]);
            
            return response()->json(['message' => 'Webhook processing failed'], 500);
        }
    }

    /**
     * Handle payment paid event
     */
    private function handlePaymentPaid($data)
    {
        $externalId = $data['external_id'] ?? null;
        
        if (!$externalId) {
            Log::warning('No external_id in payment paid webhook', $data);
            return;
        }

        $transaksi = Transaksi::where('external_id', $externalId)->first();
        
        if (!$transaksi) {
            Log::warning('Transaction not found for external_id: ' . $externalId);
            return;
        }

        if ($transaksi->payment_status === 'paid') {
            Log::info('Transaction already marked as paid: ' . $externalId);
            return;
        }

        // Update transaction status
        $transaksi->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
            'payment_data' => array_merge($transaksi->payment_data ?? [], $data),
        ]);

        Log::info('Transaction marked as paid: ' . $externalId);

        // TODO: Add notification logic here (email, SMS, etc.)
        // TODO: Add any post-payment processing logic
    }

    /**
     * Handle payment expired event
     */
    private function handlePaymentExpired($data)
    {
        $externalId = $data['external_id'] ?? null;
        
        if (!$externalId) {
            Log::warning('No external_id in payment expired webhook', $data);
            return;
        }

        $transaksi = Transaksi::where('external_id', $externalId)->first();
        
        if (!$transaksi) {
            Log::warning('Transaction not found for external_id: ' . $externalId);
            return;
        }

        // Update transaction status
        $transaksi->update([
            'payment_status' => 'expired',
            'payment_data' => array_merge($transaksi->payment_data ?? [], $data),
        ]);

        Log::info('Transaction marked as expired: ' . $externalId);
    }

    /**
     * Handle payment failed event
     */
    private function handlePaymentFailed($data)
    {
        $externalId = $data['external_id'] ?? null;
        
        if (!$externalId) {
            Log::warning('No external_id in payment failed webhook', $data);
            return;
        }

        $transaksi = Transaksi::where('external_id', $externalId)->first();
        
        if (!$transaksi) {
            Log::warning('Transaction not found for external_id: ' . $externalId);
            return;
        }

        // Update transaction status
        $transaksi->update([
            'payment_status' => 'failed',
            'payment_data' => array_merge($transaksi->payment_data ?? [], $data),
        ]);

        Log::info('Transaction marked as failed: ' . $externalId);
    }

    /**
     * Handle QR Code callback
     */
    private function handleQRCodeCallback($data)
    {
        $externalId = $data['external_id'] ?? null;
        $status = $data['status'] ?? null;
        
        if (!$externalId) {
            Log::warning('No external_id in QR code callback', $data);
            return;
        }

        $transaksi = Transaksi::where('external_id', $externalId)->first();
        
        if (!$transaksi) {
            Log::warning('Transaction not found for external_id: ' . $externalId);
            return;
        }

        switch ($status) {
            case 'COMPLETED':
                if ($transaksi->payment_status !== 'paid') {
                    $transaksi->update([
                        'payment_status' => 'paid',
                        'paid_at' => now(),
                        'payment_data' => array_merge($transaksi->payment_data ?? [], $data),
                    ]);
                    Log::info('QR Code payment completed: ' . $externalId);
                }
                break;
                
            case 'FAILED':
                $transaksi->update([
                    'payment_status' => 'failed',
                    'payment_data' => array_merge($transaksi->payment_data ?? [], $data),
                ]);
                Log::info('QR Code payment failed: ' . $externalId);
                break;
        }
    }

    /**
     * Handle Virtual Account callback
     */
    private function handleVirtualAccountCallback($data)
    {
        $externalId = $data['external_id'] ?? null;
        $status = $data['status'] ?? null;
        
        if (!$externalId) {
            Log::warning('No external_id in VA callback', $data);
            return;
        }

        $transaksi = Transaksi::where('external_id', $externalId)->first();
        
        if (!$transaksi) {
            Log::warning('Transaction not found for external_id: ' . $externalId);
            return;
        }

        switch ($status) {
            case 'COMPLETED':
                if ($transaksi->payment_status !== 'paid') {
                    $transaksi->update([
                        'payment_status' => 'paid',
                        'paid_at' => now(),
                        'payment_data' => array_merge($transaksi->payment_data ?? [], $data),
                    ]);
                    Log::info('Virtual Account payment completed: ' . $externalId);
                }
                break;
                
            case 'FAILED':
                $transaksi->update([
                    'payment_status' => 'failed', 
                    'payment_data' => array_merge($transaksi->payment_data ?? [], $data),
                ]);
                Log::info('Virtual Account payment failed: ' . $externalId);
                break;
        }
    }
}
