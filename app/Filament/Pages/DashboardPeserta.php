<?php

namespace App\Filament\Pages;

use App\Models\Agenda;
use Filament\Pages\Page;
use Filament\Actions\Action;

class DashboardPeserta extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.dashboard-peserta';
    // protected static ?string $navigationLabel = 'Dashboard Peserta';
    protected static ?string $slug = 'dashboard-peserta';

    public function getTitle(): string
    {
        return '';
    }

    public function getViewData(): array
    {
        return [
            'agendas' => Agenda::all()->filter(fn($agenda) => $agenda->status === 'Belum Dimulai')->sortBy('tanggal_pelaksanaan'),
        ];
    }
}
