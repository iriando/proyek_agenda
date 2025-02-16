<?php

namespace App\Filament\Resources\SurveyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionRelationManager extends RelationManager
{
    protected static string $relationship = 'question';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Tipe Jawaban')
                    ->options([
                        'text' => 'Teks',
                        'multiple_choice' => 'Pilihan Ganda',
                        'rating' => 'Rating',
                    ])
                    ->required()
                    ->reactive(),
                Forms\Components\Textarea::make('options')
                    ->label('Opsi Jawaban (Pisahkan dengan koma)')
                    ->helperText('Hanya untuk pertanyaan pilihan ganda. Contoh: Opsi 1, Opsi 2, Opsi 3')
                    ->nullable()
                    ->hidden(fn ($get) => $get('type') !== 'multiple_choice') // Hanya tampil untuk "multiple_choice"
                    ->afterStateUpdated(fn ($state, callable $set) =>
                        $set('options', json_encode(explode(',', $state))) // JSON konversi
                    ),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question')
            ->columns([
                Tables\Columns\TextColumn::make('question')->sortable(),
                Tables\Columns\TextColumn::make('type')->label('Tipe'),
                Tables\Columns\TextColumn::make('options')->label('Opsi')->limit(50),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
