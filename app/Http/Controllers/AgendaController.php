<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendasBerjalan = Agenda::all()->filter(fn ($agenda) => in_array($agenda->status, ['Belum Dimulai', 'Sedang Berlangsung']));
        $agendasSelesai = Agenda::all()->filter(fn ($agenda) => $agenda->status === 'Selesai');

        return view('welcome', compact('agendasBerjalan', 'agendasSelesai'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $agenda = Agenda::where('slug', $slug)->with('survey')->firstOrFail();
        return view('show', compact('agenda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
