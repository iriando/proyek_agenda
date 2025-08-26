<?php

namespace App\Http\Controllers\Api;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;

class AgendaController extends Controller
{
    // public function index()
    // {
    //     return response()->json(Agenda::all(), 200);
    // }

    public function index()
    {
        //get 3 latest agenda
        $agendas = Agenda::latest()->take(3)->get();

        //return collection of agendas as a resource
        return new AgendaResource(true, 'List Data Agendas', $agendas);
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
