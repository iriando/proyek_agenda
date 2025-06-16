@extends('layouts.app')

@section('content')
<main class="main">
<!-- Service Details Section -->
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
