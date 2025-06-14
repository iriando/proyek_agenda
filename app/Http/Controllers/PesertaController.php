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

        // Simpan NIP ke session
        session(['nip_terdaftar' => $request->nip]);

        // Cek apakah peserta dengan NIP ini sudah terdaftar untuk agenda ini
        $sudahTerdaftar = Peserta::where('agenda_id', $agenda->id)
            ->where('nip', $request->nip)
            ->exists();

        if ($sudahTerdaftar) {
            return redirect()->route('peserta.show', $agenda->slug)
                ->with('success', 'Anda sudah mengisi daftar hadir sebelumnya.');
        }

        $request->validate([
            'nip' => 'required|numeric|digits:18',
            'nama' => 'required|string|max:255',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.digits' => 'NIP harus tepat 18 digit.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.string' => 'Nama lengkap harus berupa teks.',
            'nama.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
        ]);

        Peserta::create([
            'agenda_id' => $agenda->id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'instansi' => $request->instansi,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'harapan' => $request->harapan,
        ]);

        return redirect()->route('peserta.show', $agenda->slug)
            ->with('success', 'Daftar hadir berhasil disimpan!');
    }
}
