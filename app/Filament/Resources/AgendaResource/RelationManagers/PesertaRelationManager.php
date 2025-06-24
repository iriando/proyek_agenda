<?php

namespace App\Filament\Resources\AgendaResource\RelationManagers;

use ZipArchive;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Tables\Actions\Action;
// use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use Filament\Resources\RelationManagers\RelationManager;
use App\Exports\PesertaExport;
use Maatwebsite\Excel\Facades\Excel;
// use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
class PesertaRelationManager extends RelationManager
{
    protected static string $relationship = 'peserta';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama'),
                Tables\Columns\TextColumn::make('nip'),
                Tables\Columns\TextColumn::make('instansi'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('export_excel')
                ->label('Export')
                ->icon('heroicon-o-document-arrow-down')
                ->action(function ($livewire) {
                    $agenda = $livewire->getOwnerRecord();
                    $judulSlug = Str::slug($agenda->judul);

                    return Excel::download(
                        new PesertaExport($agenda->id),
                        'peserta-' . $judulSlug . '.xlsx'
                    );
                }),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Tables\Actions\Action::make('generate_sertifikat')
                //     ->label('Sertifikat')
                //     ->icon('heroicon-o-document-arrow-down')
                //     ->color('success')
                //     ->requiresConfirmation()
                //     ->action(function ($record) {
                //         $agenda = $record->agenda;

                //         if (!$agenda->certificate_template || !Storage::disk('public')->exists($agenda->certificate_template)) {
                //             Notification::make()
                //                 ->title('Gagal')
                //                 ->body('Template sertifikat belum tersedia atau tidak ditemukan.')
                //                 ->danger()
                //                 ->send();
                //             return;
                //         }

                //         // Siapkan path
                //         $templatePath = Storage::disk('public')->path($agenda->certificate_template);
                //         File::ensureDirectoryExists(storage_path('app/temp'));

                //         // Format nomor sertifikat
                //         $nomorSertifikat = str_pad($record->id, 4, '0', STR_PAD_LEFT) . '/' .
                //                         str_pad($agenda->id, 4, '0', STR_PAD_LEFT) . '/' .
                //                         Str::slug($agenda->judul) . '/' .
                //                         $agenda->tanggal_pelaksanaan->format('Y');

                //         $outputPath = storage_path('app/temp/sertifikat-' . $record->id . '.docx');

                //         // Proses template
                //         $template = new TemplateProcessor($templatePath);
                //         $template->setValues([
                //             'nama' => $record->nama,
                //             'nip' => $record->nip,
                //             'jabatan' => $record->jabatan ?? '-',
                //             'kegiatan' => $agenda->judul,
                //             'nomor' => $nomorSertifikat,
                //             'instansi' => $record->instansi,
                //             'perusahaan' => 'BKN Kanreg XIV',
                //             'tanggal' => $agenda->tanggal_pelaksanaan->translatedFormat('d F Y'),
                //         ]);
                //         $template->saveAs($outputPath);

                //         return response()->download($outputPath)->deleteFileAfterSend();
                //     }
                // ),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                // ExportBulkAction::make()
                //     ->label('Export'),
                // Tables\Actions\BulkAction::make('generate_sertifikat_docx_zip')
                // ->label('Generate Sertifikat (ZIP .docx)')
                // ->icon('heroicon-o-archive-box-arrow-down')
                // ->requiresConfirmation()
                // ->action(function ($records) {
                //     $agenda = $records->first()->agenda;

                //     if (!$agenda->certificate_template || !Storage::disk('public')->exists($agenda->certificate_template)) {
                //         Notification::make()
                //             ->title('Gagal')
                //             ->body('Template sertifikat tidak tersedia.')
                //             ->danger()
                //             ->send();
                //         return;
                //     }

                //     $templatePath = Storage::disk('public')->path($agenda->certificate_template);
                //     $tempDir = storage_path('app/temp/docx');
                //     File::ensureDirectoryExists($tempDir);

                //     $docxPaths = [];

                //     foreach ($records as $record) {
                //         $nomor = str_pad($record->id, 4, '0', STR_PAD_LEFT) . '/' . str_pad($agenda->id, 4, '0', STR_PAD_LEFT) . '/' . Str::slug($agenda->judul) . '/' . $agenda->tanggal_pelaksanaan->format('Y');

                //         $fileName = 'sertifikat-' . Str::slug($record->nama) . '.docx';
                //         $outputPath = $tempDir . '/' . $fileName;

                //         $template = new TemplateProcessor($templatePath);
                //         $template->setValues([
                //             'nama' => $record->nama,
                //             'nip' => $record->nip,
                //             'jabatan' => $record->jabatan ?? '-',
                //             'kegiatan' => $agenda->judul,
                //             'nomor' => $nomor,
                //             'instansi' => $record->instansi,
                //             'perusahaan' => 'BKN Kanreg XIV',
                //             'tanggal' => $agenda->tanggal_pelaksanaan->translatedFormat('d F Y'),
                //         ]);
                //         $template->saveAs($outputPath);

                //         $docxPaths[] = $outputPath;
                //     }

                //     // Buat ZIP dari semua .docx
                //     $zipPath = storage_path('app/temp/sertifikat-bulk-' . now()->timestamp . '.zip');
                //     $zip = new ZipArchive();
                //     if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
                //         foreach ($docxPaths as $path) {
                //             $zip->addFile($path, basename($path));
                //         }
                //         $zip->close();
                //     }

                //     // Hapus semua file docx setelah masuk ZIP
                //     foreach ($docxPaths as $path) {
                //         File::delete($path);
                //     }

                //     // Download ZIP dan hapus setelah dikirim
                //     return response()->download($zipPath)->deleteFileAfterSend(true);
                // }),


            ])
            ->emptyStateActions([
                // Tables\Actions\CreateAction::make(),
            ]);
    }
}
