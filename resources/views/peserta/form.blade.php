@extends('layouts.app')

@section('title', 'Daftar Hadir')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Daftar Hadir untuk {{ $agenda->judul }}</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan error validasi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peserta.store', $agenda->slug) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">NIP</label>
            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" required>
            @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Instansi</label>
            <input type="text" name="instansi" class="form-control @error('nama') is-invalid @enderror" value="{{ old('instansi') }}" required>
            @error('instansi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <a href="{{ route('agenda.show', $agenda->slug) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>
</div>
@endsection
