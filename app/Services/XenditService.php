<?php
namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;
class XenditService
{
    protected $apiKey;
    protected $client;
    protected $baseUrl;
    public function __construct()
    {
        $this->apiKey = config('xendit.api_key');
        $this->baseUrl = config('xendit.base_url', 'https://api.xendit.co');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':'),
                'Content-Type' => 'application/json',
            ],
            'timeout' => 30,
        ]);
    }
    public function createInvoice($data)
    {
        try {
            $payload = [
                'external_id' => $data['external_id'],
                'payer_email' => $data['payer_email'],
                'description' => $data['description'],
                'amount' => $data['amount'],
                'currency' => config('xendit.currency', 'IDR'),
                'invoice_duration' => 86400, // 24 hours
                'success_redirect_url' => config('xendit.success_redirect_url'),
                'failure_redirect_url' => config('xendit.failure_redirect_url'),
                'payment_methods' => $data['payment_methods'] ?? ['BANK_TRANSFER', 'CREDIT_CARD', 'EWALLET', 'QR_CODE'],
            ];
            if (isset($data['customer'])) {
                $payload['customer'] = $data['customer'];
            }
            if (isset($data['customer_notification_preference'])) {
                $payload['customer_notification_preference'] = $data['customer_notification_preference'];
            }
            $response = $this->client->post('/v2/invoices', [
                'json' => $payload
            ]);
            $invoice = json_decode($response->getBody(), true);
            return [
                'success' => true,
                'data' => $invoice,
                'invoice_url' => $invoice['invoice_url'],
                'external_id' => $invoice['external_id'],
                'status' => $invoice['status']
            ];
        } catch (RequestException $e) {
            $error = $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null;
            return [
                'success' => false,
                'message' => $error['message'] ?? $e->getMessage(),
                'error' => $error ?? $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e
            ];
        }
    }
    public function createQRIS($data)
    {
        try {
            $payload = [
                'external_id' => $data['external_id'],
                'type' => 'DYNAMIC',
                'callback_url' => config('xendit.webhook_url'),
                'amount' => $data['amount'],
                'currency' => config('xendit.currency', 'IDR'),
            ];
            $response = $this->client->post('/qr_codes', [
                'json' => $payload
            ]);
            $qr = json_decode($response->getBody(), true);
            return [
                'success' => true,
                'data' => $qr,
                'qr_string' => $qr['qr_string'],
                'external_id' => $qr['external_id']
            ];
        } catch (RequestException $e) {
            $error = $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null;
            return [
                'success' => false,
                'message' => $error['message'] ?? $e->getMessage(),
                'error' => $error ?? $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e
            ];
        }
    }
    public function createVirtualAccount($data)
    {
        try {
            $payload = [
                'external_id' => $data['external_id'],
                'bank_code' => $data['bank_code'],
                'name' => $data['name'],
                'expected_amount' => $data['amount'],
                'expiration_date' => $data['expiration_date'] ?? date('c', strtotime('+1 day')),
                'is_closed' => true,
                'is_single_use' => true,
            ];
            $response = $this->client->post('/virtual_accounts', [
                'json' => $payload
            ]);
            $va = json_decode($response->getBody(), true);
            return [
                'success' => true,
                'data' => $va,
                'account_number' => $va['account_number'],
                'bank_code' => $va['bank_code'],
                'external_id' => $va['external_id']
            ];
        } catch (RequestException $e) {
            $error = $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null;
            return [
                'success' => false,
                'message' => $error['message'] ?? $e->getMessage(),
                'error' => $error ?? $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e
            ];
        }
    }
    public function getInvoice($externalId)
    {
        try {
            $response = $this->client->get('/v2/invoices/' . $externalId);
            $invoice = json_decode($response->getBody(), true);
            return [
                'success' => true,
                'data' => $invoice
            ];
        } catch (RequestException $e) {
            $error = $e->getResponse() ? json_decode($e->getResponse()->getBody(), true) : null;
            return [
                'success' => false,
                'message' => $error['message'] ?? $e->getMessage(),
                'error' => $error ?? $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'error' => $e
            ];
        }
    }
    public function generateExternalId($prefix = 'ORDER')
    {
        return $prefix . '_' . time() . '_' . uniqid();
    }
    public function verifyWebhook($payload, $signature, $webhookToken = null)
    {
        $token = $webhookToken ?? config('xendit.webhook_token');
        if (!$token) {
            return false;
        }
        $computedSignature = hash_hmac('sha256', $payload, $token);
        return hash_equals($signature, $computedSignature);
    }
    public function checkPaymentStatus($externalId)
    {
        try {
            $response = $this->client->get("/v2/invoices?external_id={$externalId}");
            $invoices = json_decode($response->getBody(), true);
            if (!empty($invoices) && is_array($invoices)) {
                $invoice = $invoices[0];
                return [
                    'status' => $invoice['status'] ?? 'unknown',
                    'payment_method' => $invoice['payment_method'] ?? null,
                    'paid_amount' => $invoice['paid_amount'] ?? 0,
                    'updated_at' => $invoice['updated'] ?? null,
                    'payment_id' => $invoice['id'] ?? null,
                    'type' => 'invoice'
                ];
            }
            try {
                $response = $this->client->get("/virtual_accounts?external_id={$externalId}");
                $virtualAccounts = json_decode($response->getBody(), true);
                if (!empty($virtualAccounts) && is_array($virtualAccounts)) {
                    $va = $virtualAccounts[0];
                    return [
                        'status' => $va['status'] ?? 'ACTIVE',
                        'account_number' => $va['account_number'] ?? null,
                        'bank_code' => $va['bank_code'] ?? null,
                        'updated_at' => $va['updated'] ?? null,
                        'payment_id' => $va['id'] ?? null,
                        'type' => 'virtual_account'
                    ];
                }
            } catch (RequestException $e) {
            }
            try {
                $response = $this->client->get("/qr_codes?external_id={$externalId}");
                $qrCodes = json_decode($response->getBody(), true);
                if (!empty($qrCodes) && is_array($qrCodes)) {
                    $qr = $qrCodes[0];
                    return [
                        'status' => $qr['status'] ?? 'ACTIVE',
                        'qr_string' => $qr['qr_string'] ?? null,
                        'updated_at' => $qr['updated'] ?? null,
                        'payment_id' => $qr['id'] ?? null,
                        'type' => 'qris'
                    ];
                }
            } catch (RequestException $e) {
            }
            return [
                'status' => 'not_found',
                'message' => 'Payment not found in Xendit'
            ];
        } catch (RequestException $e) {
            throw new Exception('Xendit API error: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception('Payment status check failed: ' . $e->getMessage());
        }
    }
}
