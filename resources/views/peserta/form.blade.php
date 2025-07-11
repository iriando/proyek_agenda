@extends('layouts.app')

@section('title', 'Daftar Hadir')

@section('content')

<section id="service-details" class="service-details section">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

            @include('components.sidebar', ['agenda' => $agenda])

            <div class="service-box">
            <h4>Share Webinar</h4>
                <div class="">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($agenda->judul . ' - ' . url()->current()) }}" target="_blank" class="btn btn-success">
                    <i class="bi bi-whatsapp"></i>
                    </a>

                    <!-- Share via Native API (untuk perangkat yang mendukung) -->
                    <button id="shareButton" class="btn btn-secondary">
                        <i class="bi bi-share-fill"></i>
                    </button>
                </div>
            </div><!-- End Services List -->
        </div>

        <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">

            @php
                $nipSession = session('nip_terdaftar');
                $sudahTerdaftar = false;

                $duplikatDiizinkan = $agenda->attdaftarhadir?->duplikat ?? false;

                if ($nipSession && !$duplikatDiizinkan) {
                    $sudahTerdaftar = $agenda->peserta->where('nip', $nipSession)->isNotEmpty();
                }
            @endphp

            @if (!$sudahTerdaftar)
                <form action="{{ route('peserta.store', $agenda->slug) }}" method="POST">
                    @csrf
                <h4 class="text-center">Daftar Hadir untuk {{ $agenda->judul }}</h4>
                <div class="mb-3">
                    <div class="mb-4">
                        <label class="form-label fw-bold">NIP</label>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" required>
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label class="form-label fw-bold">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" required>
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label class="form-label fw-bold">Instansi</label>
                        @if($agenda->attdaftarhadir && $agenda->attdaftarhadir->instansi->isNotEmpty())
                            <select name="instansi" class="form-select @error('instansi') is-invalid @enderror" required>
                                <option value="">-- Pilih Instansi --</option>
                                @foreach($agenda->attdaftarhadir->instansi as $instansi)
                                    <option value="{{ $instansi->nama_instansi }}"
                                        {{ old('instansi') == $instansi->nama_instansi ? 'selected' : '' }}>
                                        {{ $instansi->nama_instansi }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="instansi" class="form-control @error('instansi') is-invalid @enderror"
                                value="{{ old('instansi') }}" placeholder="Tulis nama instansi..." required>
                        @endif
                        @error('instansi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror


                        <label class="form-label fw-bold">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control @error('nomor_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                        @error('nomor_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label class="form-label fw-bold">Email</label>
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label class="form-label fw-bold">Harapan anda untuk Kanreg XIV BKN</label>
                        <textarea name="harapan" class="form-control" rows="3"></textarea>
                        {{-- <input type="text" name="harapan" class="form-control @error('harapan') is-invalid @enderror" value="{{ old('harapan') }}" required> --}}
                        @error('harapan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">Simpan</button>
                </div>
                </form>
            @else
                <div class="alert alert-info text-center mt-4">
                    Anda sudah mengisi daftar hadir. Terima kasih 🙏
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</section><!-- /Service Details Section -->


@endsection
