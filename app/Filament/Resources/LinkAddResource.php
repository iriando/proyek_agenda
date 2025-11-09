<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use App\Models\Link_add;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LinkAddResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LinkAddResource\RelationManagers;

class LinkAddResource extends Resource
{
    protected static ?string $model = Link_add::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationLabel = 'Link tambahan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('agenda_id')
                    ->label('Pilih agenda')
                    ->required()
                    ->searchable()
                    ->options(Agenda::all()->pluck('judul', 'id')),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Textarea::make('link')
                    ->label('Isi Link')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Hidden::make('icon')
                    ->required()
                    ->extraAttributes(['name' => 'data.icon']),
                Forms\Components\ViewField::make('icon_picker')
                    ->label('Pilih Icon')
                    ->view('components.icon-picker')
                    ->columnSpanFull()
                    ->viewData([
                        'icons' => [
                            'heroicon-o-link' => 'Link',
                            'heroicon-o-calendar' => 'Kalender',
                            'heroicon-o-star' => 'Bintang',
                            'heroicon-o-video-camera' => 'Video',
                            'heroicon-o-globe-alt' => 'Globe',
                            'heroicon-o-user' => 'Pengguna',
                            'heroicon-o-arrow-down-tray' => 'Unduh',
                            'heroicon-o-question-mark-circle' => 'Pertanyaan',
                            'heroicon-o-book-open' => 'Buku',
                        ],
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agenda.judul')
                ->label('Judul agenda'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
                Tables\Columns\TextColumn::make('link'),
                Tables\Columns\TextColumn::make('icon'),
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
                Tables\Actions\CreateAction::make()
                ->label('Tambahkan'),
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
            'index' => Pages\ListLinkAdds::route('/'),
            'create' => Pages\CreateLinkAdd::route('/create'),
            'view' => Pages\ViewLinkAdd::route('/{record}'),
            'edit' => Pages\EditLinkAdd::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return 'Link tambahan';
    }
}
