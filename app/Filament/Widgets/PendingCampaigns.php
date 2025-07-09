<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CampaignResource;
use App\Models\Campaign;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingCampaigns extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full'; // Agar widget ini memakai lebar penuh

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Campaign::where('status', 'pending')->latest()
            )
            ->heading('Campaign Terbaru Butuh Persetujuan')
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul'),
                Tables\Columns\TextColumn::make('user.name')->label('Pembuat'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Diajukan')->since(),
            ])
            ->actions([
                // Tombol ini akan mengarahkan admin ke halaman edit campaign
                Tables\Actions\Action::make('process')
                    ->label('Proses')
                    ->url(fn (Campaign $record): string => CampaignResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
