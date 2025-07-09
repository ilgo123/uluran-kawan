<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Moderasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('reviewer_id')->relationship('reviewer', 'name')->label('Pemberi Ulasan')->disabled(),
                Forms\Components\TextInput::make('rating')->disabled(),
                Forms\Components\Textarea::make('comment')->label('Komentar')->columnSpanFull()->disabled(),
                Forms\Components\Toggle::make('status')->label('Tampilkan Ulasan')->onLabel('Visible')->offLabel('Hidden'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('campaign.title')->label('Campaign')->limit(20),
                Tables\Columns\TextColumn::make('reviewer.name')->label('Dari'),
                Tables\Columns\TextColumn::make('reviewee.name')->label('Untuk'),
                Tables\Columns\TextColumn::make('rating')->icon('heroicon-m-star')->color('warning'),
                Tables\Columns\ToggleColumn::make('status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-s-eye')
                    ->offIcon('heroicon-s-eye-slash'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\TextEntry::make('reviewer.name'),
            Infolists\Components\TextEntry::make('reviewee.name'),
            Infolists\Components\TextEntry::make('campaign.title'),
            Infolists\Components\TextEntry::make('rating')->badge()->color('warning'),
            Infolists\Components\TextEntry::make('status')->badge(),
            Infolists\Components\TextEntry::make('comment')->columnSpanFull(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'view' => Pages\ViewReview::route('/{record}'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
