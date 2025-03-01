    @extends('layouts.app')

    @section('content')
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#">e-Agenda Kantor Regional XIV BKN</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/admin">Login</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="/admin/register">Daftar Akun</a></li> --}}
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        {{-- <h1 class="text-white font-weight-bold">Your Favorite Place for Free Bootstrap Themes</h1> --}}
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        {{-- <p class="text-white-75 mb-5">Start Bootstrap can help you build better websites using the Bootstrap framework! Just download a theme and start customizing, no strings attached!</p> --}}
                        {{-- <a class="btn btn-primary btn-xl" href="/admin/register">Segera Daftar</a> --}}


                    </div>
                    <!-- Tombol Scroll ke Agenda -->
                    <div class="text-center mt-4">
                        <a href="#agenda" class="btn-lg scroll-to">
                            <p style="font-size: 1rem; color: white;">Klik!</p>
                            <i class="bi bi-chevron-down" style="font-size: 4rem; color: white;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Agenda Section -->
        <section class="page-section bg-light" id="agenda">
            <div class="container">
                <h2 class="text-center">Agenda Terbaru</h2>

                <div class="row">
                    @forelse($agendas as $agenda)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                @if($agenda->poster)
                                    <div class="d-flex justify-content-center mt-3">
                                        <img src="{{ asset('storage/' . $agenda->poster) }}"
                                            class="rounded"
                                            style="width: 180px; height: auto; object-fit: cover;"
                                            alt="{{ $agenda->judul }}">
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $agenda->judul }}</h5>
                                    <p class="card-text">{{ $agenda->deskripsi }}</p>
                                    <p class="text-muted">
                                        <i class="bi bi-calendar-event"></i>
                                        {{ date('d M Y', strtotime($agenda->tanggal_pelaksanaan)) }}
                                    </p>
                                    <p class="text-muted">
                                        <i class="bi bi-clock"></i>
                                        {{ date('H:i', strtotime($agenda->tanggal_pelaksanaan)) }}
                                    </p text-center>
                                    <a href="{{ route('agenda.show', $agenda->slug) }}" class="btn center btn-success btn-sm">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">Belum ada agenda mendatang.</p>
                    @endforelse
                </div>
            </div>
        </section>


        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2025 - Kanreg XIV BKN</div></div>
        </footer>

    @endsection
