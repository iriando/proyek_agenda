<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AgendaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgendaResource\RelationManagers;
use App\Filament\Resources\AgendaResource\RelationManagers\MateriRelationManager;
use App\Filament\Resources\AgendaResource\RelationManagers\PesertaRelationManager;
use App\Filament\Resources\AgendaResource\RelationManagers\PemateriRelationManager;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Kegiatan';

    public static function shouldRegisterNavigation(): bool
    {
        if (auth()->user()->can('view agenda'))
            return true;
        else
            return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextArea::make('deskripsi'),
                Forms\Components\TextInput::make('zoomlink')
                    ->required()
                    ->maxLength(191),
                Forms\Components\DatePicker::make('tanggal_pelaksanaan')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modelLabel('Kegiatan')
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pemateri.user.name')
                ->label('Pemateri')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_pelaksanaan')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle') // Ikon aktif
                    ->falseIcon('heroicon-o-x-circle') // Ikon nonaktif
                    ->colors([
                        'success' => fn ($record) => $record->status && !Carbon::parse($record->tanggal_pelaksanaan)->isPast(),
                        'danger' => fn ($record) => !$record->status || Carbon::parse($record->tanggal_pelaksanaan)->isPast(),
                    ])
                    ->tooltip(fn ($record) =>
                        !$record->status && Carbon::parse($record->tanggal_pelaksanaan)->isPast()
                            ? 'Peraturan sudah tidak berlaku'
                            : ($record->status && Carbon::parse($record->tanggal_pelaksanaan)->isPast()
                                ? 'Tanggal pelaksanaan sudah berakhir'
                                : 'Agenda masih aktif')
                        ),
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
                Tables\Actions\DeleteAction::make(),
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
            MateriRelationManager::class,
            PemateriRelationManager::class,
            PesertaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'view' => Pages\ViewAgenda::route('/{record}'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return 'Kegiatan';
    }

}
