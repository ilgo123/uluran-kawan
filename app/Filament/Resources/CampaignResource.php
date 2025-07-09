<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Models\Campaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Utama')->schema([
                    Forms\Components\Select::make('user_id')->relationship('user', 'name')->searchable()->preload()->required(),
                    Forms\Components\Select::make('category_id')->relationship('category', 'name')->required(),
                    Forms\Components\TextInput::make('title')->required()->live(onBlur: true)->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')->required(),
                    Forms\Components\RichEditor::make('description')->required()->columnSpanFull(),
                    Forms\Components\FileUpload::make('image_path')->label('Gambar')->image()->columnSpanFull(),
                ])->columns(2),
                Forms\Components\Section::make('Detail Penggalangan')->schema([
                    Forms\Components\Select::make('type')->options(['dana' => 'Dana', 'barang' => 'Barang'])->required()->live(),
                    Forms\Components\TextInput::make('target_amount')->label('Target Dana')->numeric()->prefix('Rp')->visible(fn (Get $get) => $get('type') === 'dana'),
                    Forms\Components\TextInput::make('item_name')->label('Nama Barang')->visible(fn (Get $get) => $get('type') === 'barang'),
                    Forms\Components\DatePicker::make('deadline'),
                    Forms\Components\Select::make('status')->options(['pending' => 'Pending', 'active' => 'Aktif', 'completed' => 'Selesai', 'rejected' => 'Ditolak', 'closed' => 'Ditutup'])->required(),
                    Forms\Components\Toggle::make('is_success_story')->label('Tandai sebagai Kisah Sukses'),
                ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->limit(30)->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Pembuat')->searchable(),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'pending' => 'gray', 'active' => 'success', 'completed' => 'primary', 'rejected' => 'danger', 'closed' => 'warning',
                }),
                Tables\Columns\TextColumn::make('current_amount')->money('IDR')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(['pending' => 'Pending', 'active' => 'Aktif', 'completed' => 'Selesai', 'rejected' => 'Ditolak', 'closed' => 'Ditutup']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Info')->schema([
                Infolists\Components\TextEntry::make('title'),
                Infolists\Components\TextEntry::make('user.name')->label('Pembuat'),
                Infolists\Components\TextEntry::make('category.name'),
                Infolists\Components\TextEntry::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'pending' => 'gray', 'active' => 'success', 'completed' => 'primary', 'rejected' => 'danger', 'closed' => 'warning',
                }),
                Infolists\Components\ImageEntry::make('image_path')->label('Gambar'),
            ])->columns(2),
            Infolists\Components\Section::make('Deskripsi')->schema([
                Infolists\Components\TextEntry::make('description')->html(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            // 'view' => Pages\ViewCampaign::route('/{record}'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
