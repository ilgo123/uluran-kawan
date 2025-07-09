<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReport extends ViewRecord
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tombol "Edit" di sini berfungsi sebagai "Proses Laporan"
            Actions\EditAction::make()->label('Proses Laporan'),
        ];
    }
}
