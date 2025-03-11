@extends('layouts.app')

@section('title', 'Daftar Hadir')

@section('content')

<section id="service-details" class="service-details section">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

            <div class="service-box">
                <h4>Daftar layanan</h4>
                <div class="services-list">
                    <a href="{{ route('agenda.show', $agenda->slug) }}">
                        <i class="bi bi-ticket-detailed"></i><span> Detail Webinar</span>
                    </a>
                    @if($agenda->status !== 'Selesai')
                        @if ($agenda->status === 'Sedang Berlangsung')
                            <a href="{{ route('peserta.show', $agenda->slug) }}" class="active">
                                <i class="bi bi-person-check"></i><span> Daftar Hadir</span>
                            </a>
                        @endif
                        @if(!empty($agenda->zoomlink)) <a href="{{ $agenda->zoomlink }}" target="_blank">
                            <i class="bi bi-camera-video"></i><span> Link Zoom Meeting</span>
                        </a>
                        @endif
                    @endif

                    @if($agenda->materi->count() > 0)
                        @foreach($agenda->materi as $materi)
                            <a href="{{ asset('storage/' . $materi->file) }}" download>
                                <i class="bi bi-file-earmark-arrow-down"></i><span>Download materi {{ $materi->judul }}</span>
                            /a>
                        @endforeach
                    @endif

                    @if($agenda->survey && $agenda->survey->is_active == 1)
                        <a href="{{ route('survey.show', $agenda->slug) }}">
                            <i class="bi bi-clipboard-check"></i><span> Survey</span>
                        </a>
                    @endif
                </div>
            </div><!-- End Services List -->

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

            <form action="{{ route('peserta.store', $agenda->slug) }}" method="POST">
                @csrf
            <h4 class="text-center">Daftar Hadir untuk {{ $agenda->judul }}</h4>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

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

                    <label class="form-label fw-bold">Instansi</label>
                    <input type="text" name="instansi" class="form-control @error('nama') is-invalid @enderror" value="{{ old('instansi') }}" required>
                    @error('instansi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
            </div>
            </form>

        </div>
    </div>
</section><!-- /Service Details Section -->


@endsection
