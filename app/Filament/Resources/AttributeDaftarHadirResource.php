<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Att_daftarhadir;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AttributeDaftarHadirResource\Pages;
use App\Filament\Resources\AttributeDaftarHadirResource\RelationManagers;
use App\Filament\Resources\AttributeDaftarHadirResource\RelationManagers\PesertaRelationManager;
use App\Filament\Resources\AttributeDaftarHadirResource\RelationManagers\InstansiRelationManager;

class AttributeDaftarHadirResource extends Resource
{
    protected static ?string $model = Att_daftarhadir::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationLabel = 'Daftar Hadir';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Textarea::make('description')
                    ->label('Isi Deskripsi')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('duplikat')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('duplikat')
                    ->label('Ijin NIP Duplikat')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            InstansiRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttributeDaftarHadirs::route('/'),
            'create' => Pages\CreateAttributeDaftarHadir::route('/create'),
            'view' => Pages\ViewAttributeDaftarHadir::route('/{record}'),
            'edit' => Pages\EditAttributeDaftarHadir::route('/{record}/edit'),
        ];
    }
}
