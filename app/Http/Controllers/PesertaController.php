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
        $agenda = Agenda::where('slug', $slug)->with('attdaftarhadir')->firstOrFail();

        // Simpan NIP ke session
        session(['nip_terdaftar' => $request->nip]);

        // Ambil status duplikat dari atribut daftar hadir (default: false)
        $duplikatDiizinkan = $agenda->attdaftarhadir?->duplikat ?? false;

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

        // Jika tidak diizinkan duplikat, lakukan pengecekan
        if (!$duplikatDiizinkan) {
            $sudahTerdaftar = Peserta::where('agenda_id', $agenda->id)
                ->where('nip', $request->nip)
                ->exists();

            if ($sudahTerdaftar) {
                return redirect()->route('peserta.show', $agenda->slug)
                    ->with('success', 'Anda sudah mengisi daftar hadir sebelumnya.');
            }
        }

        // Simpan
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
