@extends('layouts.app')

@section('title', 'Isi Survey')

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
                        <a href="{{ route('survey.show', $agenda->slug) }}" class="active">
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

            <form action="{{ route('survey.submit', $agenda->slug) }}" method="POST">
                @csrf
            <h4 class="text-center">Survey untuk {{ $agenda->judul }}</h4>
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                @foreach($agenda->survey->question as $question)
                    <div class="mb-4">
                        <label class="form-label fw-bold">{{ $question->question }} @if($question->required) <span class="text-danger">*</span> @endif</label>

                        @if($question->type === 'text')
                            <textarea name="answers[{{ $question->id }}]" class="form-control" rows="4" required></textarea>

                        @elseif($question->type === 'multiple_choice')
                            @php
                                $options = is_array($question->options) ? $question->options : json_decode($question->options, true);
                            @endphp
                            <select name="answers[{{ $question->id }}]" class="form-select" required>
                                <option value="" selected disabled>Pilih jawaban</option>
                                @foreach($options as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>

                        @elseif($question->type === 'rating')
                            <select name="answers[{{ $question->id }}]" class="form-select" required>
                                <option value="" selected disabled>Pilih rating</option>
                                <option value="1">⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="5">⭐⭐⭐⭐⭐</option>
                            </select>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">Kirim Survey</button>
            </div>
            </form>

        </div>
    </div>
</section><!-- /Service Details Section -->

@endsection
