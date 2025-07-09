<?php

namespace App\Notifications;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewDonationReceived extends Notification
{
    use Queueable;

    protected $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $amountFormatted = number_format($this->donation->amount, 0, ',', '.');
        $donatorName = $this->donation->is_anonymous ? 'Seseorang' : $this->donation->user->name;

        return [
            'title' => 'Donasi Baru Diterima!',
            'message' => "Selamat! {$donatorName} telah berdonasi sebesar Rp {$amountFormatted} untuk campaign '{$this->donation->campaign->title}'.",
            'url' => route('dashboard'),
        ];
    }
}
