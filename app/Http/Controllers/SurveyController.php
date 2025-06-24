<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Survey;
use App\Models\Survey_response;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function show($agendaSlug, $surveySlug)
    {
        // Ambil agenda berdasarkan slug
        $agenda = Agenda::where('slug', $agendaSlug)->firstOrFail();

        // Ambil survey dari agenda tersebut berdasarkan slug survey
        $survey = Survey::where('agenda_id', $agenda->id)
                        ->where('slug', $surveySlug)
                        ->with('question')
                        ->firstOrFail();
        // dd($survey);
        return view('survey.form', compact('agenda', 'survey'));
    }

    public function submit(Request $request, $agendaSlug, $surveySlug)
    {
        $agenda = Agenda::where('slug', $agendaSlug)->firstOrFail();
        $survey = Survey::where('agenda_id', $agenda->id)
                        ->where('slug', $surveySlug)
                        ->with('question')
                        ->firstOrFail();

        foreach ($survey->question as $question) {
            Survey_response::create([
                'agenda_id'   => $agenda->id,
                'survey_id'   => $survey->id,
                'question_id' => $question->id,
                'answer'      => $request->input("answers.{$question->id}"),
            ]);
        }

        return redirect()->route('survey.show', [$agenda->slug, $survey->slug])->with('success', 'Survey berhasil dikirim!');
    }
}
