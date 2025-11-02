<?php

namespace App\Filament\Pages;

use App\Models\Survey;
use App\Models\Survey_question;
use App\Models\Survey_response;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Pages\Page;

class SubmitSurvey extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.submit-survey';

    public $surveyId;
    public $questions = [];
    public $answers = []; // Jawaban peserta

    public function getLayout(): string
    {
        return 'filament::components.layouts.base'; // Menggunakan layout dasar tanpa sidebar
    }

    public function mount($survey)
    {
        $survey = Survey::findOrFail($survey);
        $this->surveyId = $survey->id;
        $this->questions = $survey->question;

        // Inisialisasi jawaban peserta agar tidak error
        foreach ($this->questions as $question) {
            $this->answers[$question->id] = null;
        }
    }

    public function form(Form $form): Form
    {
        $schema = [];

        foreach ($this->questions as $question) {
            if ($question->type === 'text') {
                $schema[] = Forms\Components\TextInput::make("answers.{$question->id}")
                    ->label($question->question)
                    ->required();
            } elseif ($question->type === 'multiple_choice') {
                $options = is_array($question->options) ? $question->options : json_decode($question->options, true);

                $schema[] = Forms\Components\Select::make("answers.{$question->id}")
                    ->label($question->question)
                    ->options(array_combine($options, $options))
                    ->required();
            } elseif ($question->type === 'rating') {
                $schema[] = Forms\Components\Select::make("answers.{$question->id}")
                    ->label($question->question)
                    ->options([
                        1 => '⭐',
                        2 => '⭐⭐',
                        3 => '⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        5 => '⭐⭐⭐⭐⭐',
                    ])
                    ->required();
            }
        }

        return $form->schema($schema);
    }

    public function submit(Survey $surveyId)
    {
        $userId = auth()->id();

        // Cek apakah user sudah mengisi survei
        $hasFilledSurvey = Survey_response::where('user_id', $userId)
            ->where('survey_id', $surveyId)
            ->exists();

        if ($hasFilledSurvey) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah mengisi survei ini.');
        }

        $this->validate([
            'answers.*' => 'required', // Validasi semua jawaban harus diisi
        ]);

        foreach ($this->answers as $questionId => $answer) {
            Survey_response::updateOrCreate(
                [
                    'survey_id' => $this->surveyId,
                    'question_id' => $questionId,
                    'user_id' => auth()->id(),
                ],
                ['answer' => $answer]
            );
        }

        session()->flash('success', 'Survei telah dikirim!');
        return redirect()->route('filament.pages.submit-survey', ['survey' => $this->surveyId]);
    }
}
