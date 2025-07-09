<?php

namespace App\Filament\Resources\CampaignResource\Pages;

use App\Filament\Resources\CampaignResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCampaign extends ViewRecord
{
    protected static string $resource = CampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    // Method ini untuk menampilkan widget di bawah infolist utama
    protected function getFooterWidgets(): array
    {
        return [
            CampaignResource\RelationManagers\DonationsRelationManager::class,
        ];
    }
}
