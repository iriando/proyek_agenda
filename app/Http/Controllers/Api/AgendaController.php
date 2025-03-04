<?php

namespace App\Http\Controllers\Api;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function index()
    {
        return response()->json(Agenda::all(), 200);
    }

    public function show($id)
    {
        $agenda = Agenda::find($id);
        if (!$agenda) {
            return response()->json(['message' => 'Agenda tidak ditemukan'], 404);
        }
        return response()->json($agenda, 200);
    }
}
