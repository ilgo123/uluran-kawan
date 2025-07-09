<?php

namespace App\Filament\Resources\CampaignResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DonationsRelationManager extends RelationManager
{
    protected static string $relationship = 'donations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form tidak begitu relevan di sini
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Donatur'),
                Tables\Columns\TextColumn::make('amount')->money('IDR'),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tidak ada aksi membuat donasi dari sini
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }
}
