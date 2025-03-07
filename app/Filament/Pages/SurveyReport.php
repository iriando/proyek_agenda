<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Agenda;
use App\Models\Survey;
use App\Models\Survey_question;
use Illuminate\Support\Facades\DB;

class SurveyReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static string $view = 'filament.pages.survey-report';

    public ?Agenda $agenda = null;
    public $surveyResults = [];

    public function mount($record)
    {
        $this->agenda = Agenda::findOrFail($record);

        // Ambil survey terkait dengan agenda ini
        $survey = $this->agenda->survey;

        // Jika survey tidak ditemukan, kosongkan data
        if (!$survey) {
            $this->surveyResults = [];
            return;
        }

        // Ambil pertanyaan beserta hasil survei berdasarkan survey_id
        $this->surveyResults = Survey_question::where('survey_id', $survey->id)
            ->with(['answer' => function ($query) {
                $query->select('question_id', 'answer', DB::raw('COUNT(*) as total'))
                    ->groupBy('question_id', 'answer');
            }])->get();
    }
}
