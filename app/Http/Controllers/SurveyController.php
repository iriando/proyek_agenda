<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\Survey_question;
use App\Models\Survey_response;

class SurveyController extends Controller
{
    public function show($slug, $surveySlug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();
        $survey = $agenda->surveys()->where('slug', $surveySlug)->with('question')->firstOrFail();

        return view('survey.form', compact('agenda', 'survey'));
    }

    public function submit(Request $request, $slug)
    {
        $agenda = Agenda::where('slug', $slug)->with('survey')->firstOrFail();
        $survey = $agenda->survey;
        $questions = $survey->question;

        foreach ($questions as $question) {
            Survey_response::create([
                'agenda_id' => $agenda->id,
                'survey_id' => $survey->id,
                'question_id' => $question->id,
                'answer' => $request->input("answers.{$question->id}"),
            ]);
        }

        return redirect()->route('survey.show', $agenda->slug)->with('success', 'Survey berhasil dikirim!');
    }
}
