@extends('layouts.app')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="img/hero-bg.jpg" alt="" data-aos="fade-in">

            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <h2 data-aos="fade-up" data-aos-delay="100">Webinar Kanreg XIV BKN</h2>
                        <p data-aos="fade-up" data-aos-delay="200">Jelajahi topik terkini, dapatkan wawasan dari para ahli,
                            dan perluas jaringan profesional Anda melalui webinar interaktif kami</p>
                    </div>
                    {{-- <div class="col-lg-5" data-aos="fade-up" data-aos-delay="300">
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="sign-up-form"><input type="email" name="email"><input type="submit" value="Cari">
                        </form>
                    </div> --}}
                </div>
                <div class="text-center mt-4">
                    <a href="#recent-posts" class="btn-lg scroll-to">
                        {{-- <p data-aos="fade-up" data-aos-delay="100" style="font-size: 1rem; color: white;">Klik!</p> --}}
                        <i class="bi bi-chevron-down" style="font-size: 4rem; color: white;"></i>
                    </a>
                </div>
            </div>


        </section><!-- /Hero Section -->

        <!-- Recent Posts Section -->
        <section id="recent-posts" class="recent-posts section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Webinar Terbaru</h2>
                <p>Tingkatkan Pengetahuan dan Keterampilan Anda dengan Webinar Eksklusif!</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    @forelse($agendasBerjalan as $agenda)
                        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">

                            <article>

                                @if ($agenda->poster)
                                    <div class="post-img">
                                        {{-- <img src="uploads/{{$agenda->poster}}" alt="" class="img-fluid"> --}}
                                        <img src="{{ $agenda->poster }}" alt="" class="img-fluid">
                                    </div>
                                @endif
                                <span
                                    class="badge

                                @switch($agenda->status)
                                    @case('Selesai')
                                    text-bg-danger
                                    @break
                                    @case('Belum Dimulai')
                                    text-bg-success
                                    @break
                                    @case('Sedang Berlangsung')
                                    text-bg-primary
                                    @break
                                @endswitch

                                ">{{ $agenda->status }}</span>

                                <h2 class="title">

                                    <a href="{{ route('agenda.show', $agenda->slug) }}">{{ $agenda->judul }}</a>

                                </h2>


                                <div class="d-flex align-items-center">
                                    <img src="bkn/logo_bkn.png" alt=""
                                        class="img-fluid post-author-img flex-shrink-0">
                                    <div class="post-meta">
                                        <p class="post-author">{{ $agenda->deskripsi }}</p>
                                        <p class="post-date">
                                            <time>{{ date('d M Y H:i', strtotime($agenda->tanggal_pelaksanaan)) }}</time>
                                        </p>
                                    </div>
                                </div>

                            </article>
                        </div>
                    @empty
                        <p class="text-center text-muted">Belum ada agenda yang dibuat.</p>
                    @endforelse

                </div>

            </div>

        </section><!-- /Recent Posts Section -->

        <!-- History Posts Section -->
        <section id="recent-posts" class="recent-posts section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>History Webinar</h2>
                <p>Webinar telah selesai</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    @forelse($agendasSelesai as $agenda)
                        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">

                            <article>

                                @if ($agenda->poster)
                                    <div class="post-img">
                                        <img src="uploads/{{ $agenda->poster }}" alt="" class="img-fluid">
                                    </div>
                                @endif

                                <h2 class="title">
                                    <a href="{{ route('agenda.show', $agenda->slug) }}">{{ $agenda->judul }}</a>
                                </h2>


                                <div class="d-flex align-items-center">
                                    <img src="bkn/logo_bkn.png" alt=""
                                        class="img-fluid post-author-img flex-shrink-0">
                                    <div class="post-meta">
                                        <p class="post-author">{{ $agenda->deskripsi }}</p>
                                        <p class="post-date">
                                            <time
                                                datetime="2022-01-01">{{ date('d M Y H:i', strtotime($agenda->tanggal_pelaksanaan)) }}</time>
                                        </p>
                                    </div>
                                </div>

                            </article>
                        </div>
                    @empty
                        <p class="text-center text-muted">Belum ada agenda yang dibuat.</p>
                    @endforelse

                </div>

            </div>

        </section><!-- /Recent Posts Section -->


    </main>
@endsection
