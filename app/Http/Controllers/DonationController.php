<?php
namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use App\Notifications\NewDonationReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;
use Midtrans\Snap;

class DonationController extends Controller
{
    // Method untuk memulai proses donasi & mendapatkan token Midtrans
    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'amount'      => 'required|numeric|min:1000',
        ]);

        $campaign = Campaign::find($request->campaign_id);
        $user     = auth()->user();

        // Buat record donasi di database
        $donation = Donation::create([
            'user_id'     => $user->id,
            'campaign_id' => $campaign->id,
            'amount'      => $request->amount,
            'status'      => 'pending',
            // transaction_id akan diisi oleh Midtrans
        ]);

        // Persiapkan parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id'     => 'DONASI-' . $donation->id . '-' . time(),
                'gross_amount' => $donation->amount,
            ],
            'customer_details'    => [
                'first_name' => $user->name,
                'email'      => $user->email,
            ],
        ];

        // Dapatkan Snap Token dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        // Simpan transaction_id ke dalam donasi untuk referensi di callback
        $donation->update(['transaction_id' => $params['transaction_details']['order_id']]);

        // Kirim token sebagai response JSON
        return response()->json(['snap_token' => $snapToken]);
    }

    // Method untuk menangani notifikasi/webhook dari Midtrans
    public function callback(Request $request)
    {
        Log::info('--- [START] Webhook Midtrans Diterima ---');
        Log::info('Request Body:', $request->all());

        try {
            $notification = new Notification();

            $status   = $notification->transaction_status;
            $order_id = $notification->order_id;

            Log::info("Mencari donasi dengan order_id: [{$order_id}]");
            $donation = Donation::where('order_id', $order_id)->first();

            if (! $donation) {
                Log::error("GAGAL: Donasi dengan order_id [{$order_id}] tidak ditemukan di database.");
                return; // Hentikan eksekusi jika tidak ditemukan
            }

            Log::info("SUCCESS: Donasi #{$donation->id} ditemukan. Status saat ini di database: [{$donation->status}]");

            // Pengecekan utama untuk mencegah update ganda
            if ($donation->status === 'pending') {
                Log::info("Status donasi adalah 'pending'. Melanjutkan pengecekan status dari Midtrans...");

                if ($status == 'capture' || $status == 'settlement') {

                    Log::info("Status Midtrans adalah 'settlement' atau 'capture'. Memulai update database...");

                    $donation->update([
                        'status'         => 'success',
                        'transaction_id' => $notification->transaction_id,
                    ]);

                    $donation->campaign->increment('current_amount', $donation->amount);

                    Log::info("BERHASIL: Donasi #{$donation->id} diupdate ke 'success' dan saldo campaign telah ditambah.");

                } else {
                    Log::info("SKIP: Status Midtrans BUKAN 'settlement' atau 'capture' (status: [{$status}]). Tidak ada aksi penambahan saldo.");
                }

            } else {
                Log::warning("SKIP: Donasi #{$donation->id} sudah diproses sebelumnya (status: [{$donation->status}]). Aksi diabaikan untuk mencegah duplikasi.");
            }

        } catch (\Exception $e) {
            Log::error('!!! KESALAHAN KRITIS Webhook: ' . $e->getMessage() . ' di file ' . $e->getFile() . ' baris ' . $e->getLine());
            return response()->json(['message' => 'Error processing webhook'], 500);
        }

        Log::info('--- [END] Webhook Berhasil Diproses Tanpa Error ---');
        return response()->json(['message' => 'Notification handled']);
    }

    public function success(Request $request)
    {
        // Validasi untuk keamanan dasar
        $request->validate(['order_id' => 'required|string|exists:donations,transaction_id']);

        // Cari donasi berdasarkan order_id yang dikirim dari frontend
        $donation = Donation::where('transaction_id', $request->order_id)->firstOrFail();
        // dd('Webhook berhasil diterima!', $donation);

        // Hanya update jika statusnya masih pending untuk mencegah duplikasi
        if ($donation->status === 'pending') {
            $donation->update(['status' => 'success']);
            $donation->campaign->increment('current_amount', $donation->amount);
        }

        $donation->campaign->user->notify(new NewDonationReceived($donation));

        return response()->json(['message' => 'Saldo campaign berhasil diupdate.']);
    }
}
