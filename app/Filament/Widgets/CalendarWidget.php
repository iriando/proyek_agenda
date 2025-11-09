<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AgendaResource;
use App\Models\Agenda;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public function fetchEvents(array $fetchInfo): array
    {
        return Agenda::all()->map(function ($agenda) {
            return [
                'id' => $agenda->id,
                'title' => $agenda->judul,
                'start' => $agenda->tanggal_pelaksanaan,
                // 'url' => AgendaResource::getUrl(name: 'view', parameters: ['record' => $agenda]),
                'url' => route('filament.admin.resources.agendas.view', $agenda->slug),
            ];
        })->toArray();
    }

    public function config(): array
    {
        return [
            'firstDay' => 1,
            'headerToolbar' => [
                'right' => '',
                'center' => 'title',
                'left' => 'prev,next',
            ],
        ];
    }
}
