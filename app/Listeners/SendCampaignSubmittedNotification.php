<?php

namespace App\Listeners;

use App\Events\CampaignSubmitted;
use App\Models\User;
use Filament\Notifications\Notification;
use App\Filament\Resources\CampaignResource;

class SendCampaignSubmittedNotification
{
    public function handle(CampaignSubmitted $event): void
    {
        // 1. Ambil semua user yang rolenya admin
        $admins = User::where('role', 'admin')->get();

        // 2. Buat notifikasi
        $notification = Notification::make()
            ->title('Campaign Baru Perlu Persetujuan')
            ->icon('heroicon-o-gift')
            ->body("Campaign berjudul '{$event->campaign->title}' telah diajukan dan menunggu persetujuan Anda.")
            ->actions([
                Notification\Actions\Action::make('Lihat')
                    ->url(CampaignResource::getUrl('edit', ['record' => $event->campaign])),
            ])
            ->toDatabase(); // 3. Kirim notifikasi ini ke database

        // 4. Kirim ke setiap admin
        foreach ($admins as $admin) {
            $admin->notify($notification);
        }
    }
}
