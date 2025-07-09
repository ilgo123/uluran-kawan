<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('university'),
                Forms\Components\FileUpload::make('student_id_card_path')->label('Foto KTM')->image(),
                Forms\Components\Textarea::make('bio')->columnSpanFull(),
                Forms\Components\Toggle::make('is_verified')->label('Terverifikasi'),
                Forms\Components\Select::make('role')->options(['user' => 'User', 'admin' => 'Admin'])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\IconColumn::make('is_verified')->label('Verified')->boolean(),
                Tables\Columns\TextColumn::make('role')->badge(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_verified')->label('Status Verifikasi'),
                Tables\Filters\SelectFilter::make('role')->options(['user' => 'User', 'admin' => 'Admin']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Informasi Personal')
                ->schema([
                    Infolists\Components\TextEntry::make('name'),
                    Infolists\Components\TextEntry::make('email'),
                    Infolists\Components\TextEntry::make('university'),
                    Infolists\Components\TextEntry::make('bio'),
                ])->columns(2),
            Infolists\Components\Section::make('Status Akun')
                ->schema([
                    Infolists\Components\IconEntry::make('is_verified')->label('Terverifikasi')->boolean(),
                    Infolists\Components\TextEntry::make('role')->badge(),
                    Infolists\Components\ImageEntry::make('student_id_card_path')->label('Foto KTM'),
                ])->columns(3),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
