<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationGroup = 'Moderasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('reporter_id')->relationship('reporter', 'name')->disabled(),
                Forms\Components\Textarea::make('reason')->disabled()->columnSpanFull(),
                Forms\Components\Select::make('status')->options(['submitted' => 'Terkirim', 'in_review' => 'Dalam Peninjauan', 'resolved' => 'Selesai'])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reporter.name')->searchable(),
                Tables\Columns\TextColumn::make('reportable_type')->label('Tipe Laporan')->formatStateUsing(fn (string $state): string => class_basename($state)),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->label('Proses Laporan'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\TextEntry::make('reporter.name'),
            Infolists\Components\TextEntry::make('reportable_type')->label('Tipe Laporan')->formatStateUsing(fn (string $state): string => class_basename($state)),
            Infolists\Components\TextEntry::make('reportable_id')->label('ID Konten'),
            Infolists\Components\TextEntry::make('status')->badge(),
            Infolists\Components\TextEntry::make('reason')->columnSpanFull(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            // 'view' => Pages\ViewReport::route('/{record}'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
