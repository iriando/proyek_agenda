<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function show($slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();
        return view('peserta.form', compact('agenda'));
    }

    public function store(Request $request, $slug)
    {
        $agenda = Agenda::where('slug', $slug)->firstOrFail();

        $request->validate([
            'nip' => 'required|string|max:20|unique:pesertas,nip,NULL,id,agenda_id,' . $agenda->id,
            'nama' => 'required|string|max:255',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.string' => 'NIP harus berupa teks.',
            'nip.max' => 'NIP tidak boleh lebih dari 20 karakter.',
            'nip.unique' => 'NIP ini sudah terdaftar untuk agenda ini.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.string' => 'Nama lengkap harus berupa teks.',
            'nama.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
        ]);

        Peserta::create([
            'agenda_id' => $agenda->id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'instansi' => $request->instansi,
        ]);

        return redirect()->route('peserta.show', $agenda->slug)->with('success', 'Daftar hadir berhasil disimpan!');
    }
}
