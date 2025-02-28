@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-lg">

                    <!-- Tombol Kembali -->
                    <a href="{{ url('/') }}" class="position-absolute top-0 end-0 m-2 text-decoration-none text-dark">
                        <i class="bi bi-x-circle-fill fs-3"></i>
                    </a>

                    <div class="card-body text-center">
                        <!-- Gambar Poster -->
                        @if(!empty($agenda->poster) && file_exists(public_path('storage/' . $agenda->poster)))
                            <img src="{{ asset('storage/' . $agenda->poster) }}"
                                class="rounded mb-3 img-fluid"
                                style="max-width: 250px; height: auto; object-fit: cover;"
                                alt="{{ $agenda->judul }}">
                        @else
                            <img src="{{ asset('uploads/agenda/default.jpg') }}"
                                class="rounded mb-3 img-fluid"
                                style="max-width: 250px; height: auto; object-fit: cover;"
                                alt="Default Image">
                        @endif

                        <!-- Judul Agenda -->
                        <h3 class="fw-bold">{{ $agenda->judul ?? 'Agenda Tidak Ditemukan' }}</h3>

                        <!-- Deskripsi -->
                        <p class="text-muted">{{ $agenda->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>

                        <!-- Tanggal Pelaksanaan -->
                        <div class="text-muted mb-3 d-flex justify-content-center align-items-center">
                            <i class="bi bi-calendar-event me-2"></i>
                            <span>{{ isset($agenda->tanggal_pelaksanaan) ? date('d M Y', strtotime($agenda->tanggal_pelaksanaan)) : 'Tanggal belum tersedia' }}</span>
                        </div>

                        <!-- Jam Pelaksanaan -->
                        <div class="text-muted mb-3 d-flex justify-content-center align-items-center">
                            <i class="bi bi-clock me-2"></i>
                            <span>{{ isset($agenda->tanggal_pelaksanaan) ? date('H:i', strtotime($agenda->tanggal_pelaksanaan)) : 'Jam belum tersedia' }}</span>
                        </div>

                        <div class="mt-3 d-flex flex-wrap justify-content-center gap-2">
                            @if(!empty($agenda->zoomlink))
                                <a href="{{ $agenda->zoomlink }}" target="_blank" class="btn btn-primary">
                                    <i class="bi bi-camera-video"></i> Join Meeting
                                </a>
                            @endif

                            @if($agenda->materi->count() > 0)
                                @foreach($agenda->materi as $materi)
                                    <a href="{{ asset('storage/' . $materi->file) }}" class="btn btn-success" download>
                                        <i class="bi bi-file-earmark-arrow-down"></i> Download materi {{ $materi->judul }}
                                    </a>
                                @endforeach
                            @endif

                            @if(!empty($agenda->survey))
                                <a href="{{ route('survey.show', $agenda->slug) }}" class="btn btn-warning">
                                    <i class="bi bi-clipboard-check"></i> Isi Survey
                                </a>
                            @endif
                        </div>

                        <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">
                            <!-- Share via WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($agenda->judul . ' - ' . url()->current()) }}" target="_blank" class="btn btn-success">
                                <i class="bi bi-whatsapp"></i>
                            </a>

                            <!-- Share via Native API (untuk perangkat yang mendukung) -->
                            <button id="shareButton" class="btn btn-secondary">
                                <i class="bi bi-share-fill"></i>
                            </button>
                        </div>

                        <script>
                            document.getElementById('shareButton').addEventListener('click', async () => {
                                if (navigator.share) {
                                    try {
                                        await navigator.share({
                                            title: "{{ $agenda->judul }}",
                                            text: "{{ $agenda->deskripsi }}",
                                            url: "{{ url()->current() }}"
                                        });
                                    } catch (error) {
                                        console.error('Error sharing:', error);
                                    }
                                } else {
                                    alert('Fitur share tidak didukung di perangkat ini.');
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
