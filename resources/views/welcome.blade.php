

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Webinar Kantor Regional XIV BKN</title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        <!-- Favicons -->
        <link href="bkn/logo_bkn.png" rel="icon">
        <link href="bkn/logo_bkn.png" rel="apple-touch-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets_new/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets_new/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets_new/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets_new/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets_new/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Main CSS File -->
        <link href="assets_new/css/main.css" rel="stylesheet">

        <!-- =======================================================
        * Template Name: Append
        * Template URL: https://bootstrapmade.com/append-bootstrap-website-template/
        * Updated: Aug 07 2024 with Bootstrap v5.3.3
        * Author: BootstrapMade.com
        * License: https://bootstrapmade.com/license/
        ======================================================== -->
    </head>

    <body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="assets_new/img/hero-bg.jpg" alt="" data-aos="fade-in">

            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <h2 data-aos="fade-up" data-aos-delay="100">Webinar Kanreg XIV BKN</h2>
                        <p data-aos="fade-up" data-aos-delay="200">Jelajahi topik terkini, dapatkan wawasan dari para ahli, dan perluas jaringan profesional Anda melalui webinar interaktif kami</p>
                    </div>
                    <div class="col-lg-5" data-aos="fade-up" data-aos-delay="300">
                        <form action="forms/newsletter.php" method="post" class="php-email-form">
                            <div class="sign-up-form"><input type="email" name="email"><input type="submit" value="Cari"></div>

                        </form>
                    </div>
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
                    @foreach($agenda as $agenda)
                        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">

                            <article>

                                <div class="post-img">
                                    <img src="{{ asset('storage/' . $agenda->poster) }}" alt="" class="img-fluid">
                                </div>

                                <span class="badge

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

                                ">{{$agenda->status}}</span>

                                <h2 class="title">
                                    <a href="{{ route('agenda.show', $agenda->slug) }}">{{$agenda->judul}}</a>
                                </h2>

                                <div class="d-flex align-items-center">
                                    <img src="assets_new/img/blog/blog-author-3.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                                    <div class="post-meta">
                                        <p class="post-author">{{$agenda->deskripsi}}</p>
                                        <p class="post-date">
                                            <time datetime="2022-01-01">{{ date('d M Y', strtotime($agenda->tanggal_pelaksanaan)) }}</time>
                                        </p>
                                    </div>
                                </div>

                            </article>
                        </div>
                    @endforeach

                </div>

            </div>

        </section><!-- /Recent Posts Section -->


    </main>

    <footer id="footer" class="footer position-relative light-background">


        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="sitename">Webinar Kanreg XIV</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by Bidang Informasi Kepegawaian</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets_new/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_new/vendor/php-email-form/validate.js"></script>
    <script src="assets_new/vendor/aos/aos.js"></script>
    <script src="assets_new/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets_new/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets_new/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets_new/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets_new/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets_new/js/main.js"></script>

    </body>

    </html>

