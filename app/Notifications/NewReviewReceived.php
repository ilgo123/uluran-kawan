<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewReviewReceived extends Notification
{
    use Queueable;

    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $reviewerName = $this->review->reviewer->name;
        $campaignTitle = $this->review->campaign->title;

        return [
            'title' => 'Anda Menerima Ulasan Baru',
            'message' => "{$reviewerName} memberikan ulasan {$this->review->rating} bintang untuk campaign '{$campaignTitle}'.",
            'url' => route('profile.edit'), // Arahkan ke halaman profil untuk melihat ulasan
        ];
    }
}
