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
        $agenda = Agenda::with(['materi', 'pemateri', 'peserta', 'surveys'])->orderBy('created_at', 'desc')->take(3)->get();
        return view('welcome', compact('agendasBerjalan', 'agendasSelesai', 'agenda'));
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
        $agenda = Agenda::where('slug', $slug)->with(['surveys', 'links'])->firstOrFail();
        $agendaBaru = Agenda::orderBy('created_at', 'asc')->take(3)->get();
        return view('show', compact('agenda','agendaBaru'));

        // $agenda = Agenda::where('slug', $slug)->with('surveys')->firstOrFail();
        // $agendaBaru = Agenda::orderBy('created_at', 'asc')->take(3)->get();
        // return view('show', compact('agenda','agendaBaru'));
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
