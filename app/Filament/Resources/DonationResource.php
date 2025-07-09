<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->relationship('user', 'name')->label('Donatur')->disabled(),
                Forms\Components\Select::make('campaign_id')->relationship('campaign', 'title')->disabled(),
                Forms\Components\TextInput::make('amount')->numeric()->prefix('Rp')->disabled(),
                Forms\Components\Toggle::make('is_anonymous')->disabled(),
                Forms\Components\Select::make('status')->options(['pending' => 'Pending', 'success' => 'Sukses', 'failed' => 'Gagal'])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('campaign.title')->label('Campaign')->limit(25)->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Donatur')->searchable(),
                Tables\Columns\TextColumn::make('amount')->money('IDR')->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning', 'success' => 'success', 'failed' => 'danger',
                }),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->label('Ubah Status'), // Hanya untuk ubah status
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonations::route('/'),
            // 'create' => Pages\CreateDonation::route('/create'), // Matikan jika admin tidak boleh membuat donasi
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }
}
