@extends('layouts.app')

@section('content')
<main class="main">
<!-- Service Details Section -->
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
                        @foreach ($agenda->surveys as $sv)
                            @if ($sv->is_active == 1)
                                <a href="{{ route('survey.show', ['agendaSlug' => $agenda->slug, 'surveySlug' => $sv->slug]) }}">
                                    <i class="bi bi-clipboard-check"></i><span> {{ $sv->title }}</span>
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

            <div class="widgets-container" style="margin-top: 30px;">
                <!-- Recent Posts Widget -->
                <div class="recent-posts-widget widget-item">
                    <h4 class="widget-title">Baru ditambahkan</h3>
                    @foreach ($agendaBaru as $new)
                        <div class="post-item">
                            <img src="{{ asset('uploads/' . $new->poster) }}" alt="" class="flex-shrink-0">
                            <div>
                            <h4><a href="{{ route('agenda.show', $new->slug) }}">{{$new->judul}}</a></h4>
                            <time>{{ date('d M Y H:i', strtotime($new->tanggal_pelaksanaan)) }}</time>
                            </div>
                        </div><!-- End recent post item-->
                    @endforeach
                </div><!--/Recent Posts Widget -->
            </div>
        </div>

        <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
            @if(!empty($agenda->poster) && file_exists(public_path('uploads/' . $agenda->poster)))
                <img src="{{ asset('uploads/' . $agenda->poster) }}" class="img-fluid services-img" alt="{{ $agenda->judul }}">
            @else
                <img src="{{ asset('uploads/default.jpg') }}" class="img-fluid services-img" alt="Default Image">
            @endif

            <!-- Judul Agenda -->
            <h3 class="fw-bold">{{ $agenda->judul ?? 'Agenda Tidak Ditemukan' }}</h3>

            <!-- Deskripsi -->
            <p class="text-muted">{{ $agenda->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>

            <!-- Pemateri -->
            {{-- @foreach($agenda->pemateri as $pemateri) --}}
                <div class="text-muted mb-3 d-flex">
                    <i class="bi bi-person me-2"></i>
                        <span>{{ $agenda->pemateri->first()->user->name ?? 'Tidak ada pemateri' }}</span>
                </div>
            {{-- @endforeach --}}

            <!-- Tanggal Pelaksanaan -->
            <div class="text-muted mb-3 d-flex">
                <i class="bi bi-calendar-event me-2"></i>
                    <span>{{ isset($agenda->tanggal_pelaksanaan) ? date('d M Y', strtotime($agenda->tanggal_pelaksanaan)) : 'Tanggal belum tersedia' }}</span>
            </div>

            <!-- Jam Pelaksanaan -->
            <div class="text-muted mb-3 d-flex">
                <i class="bi bi-clock me-2"></i>
                    <span>{{ isset($agenda->tanggal_pelaksanaan) ? date('H:i', strtotime($agenda->tanggal_pelaksanaan)) : 'Jam belum tersedia' }}</span>
            </div>
        </div>
    </div>
</section><!-- /Service Details Section -->

</main>
@endsection
