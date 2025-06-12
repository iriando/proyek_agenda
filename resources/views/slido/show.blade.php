@extends('layouts.app')

@section('title', 'Slido')

@section('content')

<section id="service-details" class="service-details section">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

            <div class="service-box">
                <h4>Daftar layanan</h4>
                <div class="services-list">
                    <a href="{{ route('agenda.show', $agenda->slug) }}" class="active">
                        <i class="bi bi-ticket-detailed"></i><span> Detail Webinar</span>
                    </a>

                    @php
                        use Carbon\Carbon;
                        $now = Carbon::now();
                        $tanggalMulai = Carbon::parse($agenda->tanggal_pelaksanaan);
                        $isThirtyMinutesAfterStart = $now->greaterThanOrEqualTo($tanggalMulai->addMinutes(30));
                    @endphp


                    @if($agenda->status !== 'Selesai')
                        @if ($agenda->status === 'Sedang Berlangsung' && $isThirtyMinutesAfterStart)
                            <a href="{{ route('peserta.show', $agenda->slug) }}">
                                <i class="bi bi-person-check"></i><span> Daftar Hadir</span>
                            </a>
                        @endif
                        @if(!empty($agenda->zoomlink)) <a href="{{ $agenda->zoomlink }}" target="_blank">
                            <i class="bi bi-camera-video"></i><span> Link Zoom Meeting</span>
                        </a>
                        @endif
                        @if(!empty($agenda->slidolink)) <a href="{{ route('slido.show', $agenda->slug) }}">
                            <i class="bi bi-question-circle"></i><span> Link Slido Pertanyaan</span>
                        </a>
                        @endif
                    @endif

                    @if($agenda->materi->count() > 0)
                        @foreach($agenda->materi as $materi)
                            <a href="../uploads/{{$materi->file }}" download>
                                <i class="bi bi-file-earmark-arrow-down"></i><span>Download materi {{ $materi->judul }}</span>
                            </a>
                        @endforeach
                    @endif

                    @if($agenda->surveys->count() > 0)
                        @foreach ($agenda->surveys as $survey)
                            @if ($survey->is_active == 1)
                                <a href="{{ route('survey.show', ['slug' => $agenda->slug, 'survey' => $survey->slug]) }}">
                                    <i class="bi bi-clipboard-check"></i><span> {{ $survey->title }}</span>
                                </a>
                            @endif
                        @endforeach
                    @endif

                    @if(!empty($agenda->linksertifikat)) <a href="{{ $agenda->linksertifikat }}" target="_blank">
                        <i class="bi bi-paperclip"></i><span> Link Sertifikat</span>
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

            <iframe src="{{ $agenda->slidolink }}" height="100%" width="100%" frameBorder="0" style="min-height: 560px;" allow="clipboard-write" title="Slido"></iframe>

        </div>
    </div>
</section><!-- /Service Details Section -->


@endsection
