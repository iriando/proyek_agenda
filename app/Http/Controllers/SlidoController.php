<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class SlidoController extends Controller
{
    public function show($slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();;

        return view('slido.show', compact('agenda'));
    }
}
