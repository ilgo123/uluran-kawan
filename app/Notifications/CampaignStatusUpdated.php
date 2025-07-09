<?php

namespace App\Notifications;

use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CampaignStatusUpdated extends Notification
{
    use Queueable;

    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // Kita akan simpan notifikasi ini di database
    }

    public function toDatabase(object $notifiable): array
    {
        // Logika untuk menentukan pesan notifikasi
        $message = '';
        if ($this->campaign->status === 'active') {
            $message = "Kabar baik! Campaign Anda '{$this->campaign->title}' telah disetujui dan kini aktif.";
        } elseif ($this->campaign->status === 'rejected') {
            $message = "Mohon maaf, campaign Anda '{$this->campaign->title}' ditolak oleh admin.";
        }

        return [
            'campaign_id' => $this->campaign->id,
            'title' => 'Update Status Campaign',
            'message' => $message,
            'url' => route('dashboard'), // URL tujuan saat notifikasi diklik
        ];
    }
}
