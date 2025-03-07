<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Agenda;
use App\Models\Survey_question;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class ReportAgenda extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.report-agenda';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?int $navigationSort = 2;

    public function getAgendas()
    {
        // dd(Agenda::withCount('peserta')->get());
        return Agenda::withCount('peserta')->get();
    }

    public function getSurveyData()
    {
        // dd(Survey_question::with('answer')->first());
        return Survey_question::with(['answer' => function ($query) {
            $query->select('question_id', 'answer', DB::raw('COUNT(*) as total'))
                ->groupBy('question_id', 'answer');
        }])->get();
    }
}
