<?php

namespace App\Filament\Resources\CampaignResource\Pages;

use App\Filament\Resources\CampaignResource;
use App\Notifications\CampaignStatusUpdated;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCampaign extends EditRecord
{
    protected static string $resource = CampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $campaign = $this->record;

        // Cek jika field 'status' baru saja diubah dan nilainya adalah 'active' atau 'rejected'
        if ($campaign->wasChanged('status') && in_array($campaign->status, ['active', 'rejected'])) {
            // Kirim notifikasi ke pemilik campaign
            $campaign->user->notify(new CampaignStatusUpdated($campaign));
        }
    }
}
