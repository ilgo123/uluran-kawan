<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class DonationController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function initiateDonation(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount' => 'required|numeric|min:1000',
            'is_anonymous' => 'boolean',
        ]);

        $campaign = Campaign::find($request->campaign_id);

        if (!$campaign || $campaign->type !== 'dana' || $campaign->status !== 'active') {
            return response()->json(['message' => 'Campaign tidak ditemukan, tidak aktif, atau bukan campaign dana.'], 404);
        }

        $user = $request->user();

        try {
            // Buat donasi sementara
            $donation = Donation::create([
                'user_id' => $user->id,
                'campaign_id' => $campaign->id,
                'amount' => $request->amount,
                'status' => 'pending',
                'is_anonymous' => $request->boolean('is_anonymous'),
            ]);

            // Buat order ID
            $orderId = 'ULURAN-D' . $donation->id . '-' . time();
            $donation->transaction_id = $orderId;
            $donation->save();

            // Buat transaksi Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $donation->amount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'item_details' => [
                    [
                        'id' => $campaign->id,
                        'name' => 'Donasi untuk ' . $campaign->title,
                        'price' => $donation->amount,
                        'quantity' => 1,
                    ]
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'message' => 'Donasi berhasil diinisiasi.',
                'donation_id' => $donation->id,
                'snap_token' => $snapToken,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error initiating donation with Midtrans: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['message' => 'Terjadi kesalahan saat inisiasi donasi.', 'error' => $e->getMessage()], 500);
        }
    }

    public function handlePaymentCallback(Request $request)
    {
        Log::info('Midtrans Payment Callback Received', $request->all());

        try {
            $json = file_get_contents("php://input");
            $notification = new Notification();
        } catch (\Exception $e) {
            Log::error('Error creating Midtrans Notification object: ' . $e->getMessage());
            return response()->json(['message' => 'Error processing notification.'], 500);
        }

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;
        $grossAmount = $notification->gross_amount;
        $paymentType = $notification->payment_type;

        $donation = Donation::where('transaction_id', $orderId)->first();
        if (!$donation) {
            Log::warning('Donation not found for order_id: ' . $orderId);
            return response()->json(['message' => 'Donasi tidak ditemukan.'], 404);
        }

        if (in_array($donation->status, ['success', 'failed'])) {
            Log::info("Donation already processed: {$orderId}, status: {$donation->status}");
            return response()->json(['message' => 'Donasi sudah diproses.'], 200);
        }

        DB::transaction(function () use ($donation, $transactionStatus, $fraudStatus, $grossAmount, $paymentType, $request, $orderId) {
            $statusMap = [
                'capture' => $fraudStatus === 'accept' ? 'success' : 'failed',
                'settlement' => 'success',
                'pending' => 'pending',
                'deny' => 'failed',
                'expire' => 'failed',
                'cancel' => 'failed',
            ];

            $updateStatus = $statusMap[$transactionStatus] ?? 'failed';

            $donation->status = $updateStatus;
            $donation->payment_method = $paymentType;
            $donation->payment_raw_response = $request->all();

            if ($updateStatus === 'success') {
                $donation->paid_amount = (float) $grossAmount;
                $donation->paid_at = now();

                $campaign = $donation->campaign;
                if ($campaign) {
                    $campaign->current_amount += $donation->amount;
                    $campaign->save();
                    Log::info("Campaign {$campaign->id} updated by donation {$donation->id}");
                }
            }

            $donation->save();
            Log::info("Donation status updated to {$updateStatus} for order_id: {$orderId}");
        });

        return response()->json(['message' => 'Callback diterima dan diproses.'], 200);
    }
}