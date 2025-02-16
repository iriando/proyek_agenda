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
                Forms\Components\DateTimePicker::make('tanggal_pelaksanaan')
                    ->label('waktu dan tanggal pelaksanaan')
                    ->displayFormat('Y-m-d H:i:s')
                    ->required(),
                Forms\Components\DateTimePicker::make('tanggal_selesai')
                    ->label('waktu dan tanggal selesai')
                    ->displayFormat('Y-m-d H:i:s')
                    ->after('tanggal_pelaksanaan')
                    ->rules('after:tanggal_pelaksanaan')
                    ->required(),
                Forms\Components\TextInput::make('status')
                ->label('Status')
                ->disabled()
                ->default(fn ($record) => $record?->status),
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
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->dateTime('d M Y H:i'),
                Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'warning' => fn ($state) => trim($state) === 'Belum Dimulai',
                    'success' => fn ($state) => trim($state) === 'Sedang Berlangsung',
                    'primary' => fn ($state) => trim($state) === 'Selesai',
                ])
                ->sortable(),
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
