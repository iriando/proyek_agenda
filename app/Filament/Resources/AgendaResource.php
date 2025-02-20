<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agenda;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Actions\Action;
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
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Status Survey')
                    ->disabled(!Auth::user()->hasrole('admin'))
                    ->updateStateUsing(function ($record, $state) {
                        $record->update(['status' => $state]);
                        if ($state === true) {
                            $message = "Survey '{$record->judul}' telah diaktifkan.";
                            $surveyUrl = $record->survey ? route('filament.pages.submit-survey', ['survey' => $record->survey->id]) : null;
                            // Kirim notifikasi ke semua user
                            $users = User::all();
                            foreach ($users as $user) {
                                Notification::make()
                                    ->title('Survey sudah boleh di isi')
                                    ->body($message)
                                    ->success() // Gaya notifikasi sukses
                                    ->actions([
                                        \Filament\Notifications\Actions\Action::make('Isi Survei')
                                            ->url($surveyUrl)
                                            ->openUrlInNewTab()
                                            ->button(),
                                    ])
                                    ->sendToDatabase($user);
                            }
                        }
                    }),

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
