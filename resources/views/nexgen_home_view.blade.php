<!DOCTYPE html>

<html lang="en">

<head>

    <!-- ==============================================
        Basic Page Needs
        =============================================== -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->

    <title>NIXUS - Gateway to Seamless Logistics</title>

    <meta name="description" content="Business, Consulting, Finance, Insurance, Startup and Technology">
    <meta name="subject" content="Business, Consulting, Finance, Insurance, Startup and Technology">
    <meta name="author" content="Codings">

    <!-- ==============================================
        Favicons
        =============================================== -->
    <link rel="shortcut icon" href="theme/nexgen/images/favicon.ico">
    <link rel="apple-touch-icon" href="theme/nexgen/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="theme/nexgen/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="theme/nexgen/images/apple-touch-icon-114x114.png">

    <!-- ==============================================
        Vendor Stylesheet
        =============================================== -->
    <link rel="stylesheet" href="theme/nexgen/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="theme/nexgen/css/vendor/slider.min.css">
    <link rel="stylesheet" href="theme/nexgen/css/main.css">
    <link rel="stylesheet" href="theme/nexgen/css/vendor/icons.min.css">
    <link rel="stylesheet" href="theme/nexgen/css/vendor/icons-fa.min.css">
    <link rel="stylesheet" href="theme/nexgen/css/vendor/animation.min.css">
    <link rel="stylesheet" href="theme/nexgen/css/vendor/gallery.min.css">
    <link rel="stylesheet" href="theme/nexgen/css/vendor/cookie-notice.min.css">

    <!-- ==============================================
        Custom Stylesheet
        =============================================== -->
    <link rel="stylesheet" href="theme/nexgen/css/default.css">

    <!-- ==============================================
        Theme Color
        =============================================== -->
    <meta name="theme-color" content="#21333e">

    <!-- ==============================================
        Theme Settings
        =============================================== -->
    <style>
        :root {
            --hero-bg-color: #000000;

            --section-1-bg-color: #eef4ed;
            --section-2-bg-color: #111117;
            --section-3-bg-color: #eef4ed;
            --section-4-bg-color: #ffffff;
            --section-5-bg-color: #111117;
            --section-5-bg-image: url('../../assets/images/bg-1.jpg');
            --section-6-bg-color: #eef4ed;

            --footer-bg-color: #111117;
            --footer-bg-image: url('../../assets/images/bg-10.jpg');
        }
    </style>

</head>

<body class="home">

    <!-- Preloader -->
    <div id="preloader" data-timeout="2000" class="odd preloader counter">
        <div data-aos="fade-up" data-aos-delay="500" class="row justify-content-center text-center items">
            <div data-percent="100" class="radial">
                <span></span>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header id="header">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand top">
            <div class="container header">

                <!-- Navbar Items [left] -->
                {{-- <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link pl-0"><i class="fas fa-clock mr-2"></i>Open Hours: Mon - Sat - 9:00
                            - 18:00</a>
                    </li>
                </ul> --}}

                <!-- Nav holder -->
                <div class="ml-auto"></div>

                <!-- Navbar Items [right] -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-phone-alt mr-2"></i> 042-838857</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-envelope mr-2"></i>hello@thelogx.com</a>
                    </li>
                </ul>

                <!-- Navbar Icons -->
                <ul class="navbar-nav icons">
                    <li class="nav-item social">
                        <a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="nav-item social">
                        <a href="#" class="nav-link"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="nav-item social">
                        <a href="#" class="nav-link pr-0"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                </ul>

            </div>
        </nav>

        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-fixed sub">
            <div class="container header">

                <!-- Navbar Brand-->
                <a class="navbar-brand" href="/">
                    {{-- <span class="brand">
                        <span class="featured">
                            <span class="first">NEX</span>
                        </span>
                        <span class="last">GEN</span>
                    </span>
                    --}}
                    <!-- 
                            Custom Logo
                            <img src="theme/nexgen/images/logo.svg" alt="NEXGEN">
                        -->
                    <img src="theme/nexgen/images/logo_white_with_logx_2.png" alt="Nixus">
                </a>

                <!-- Nav holder -->
                <div class="ml-auto"></div>

                <!-- Navbar Items -->
                <ul class="navbar-nav items">
                    <li class="nav-item">
                        <a href="#header" class="smooth-anchor nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#services" class="smooth-anchor nav-link">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="#solution" class="smooth-anchor nav-link">Solution</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="smooth-anchor nav-link">Contact</a>
                    </li>

                </ul>

                <!-- Navbar Icons -->
                <ul class="navbar-nav icons">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#search">
                            <i class="icon-magnifier"></i>
                        </a>
                    </li>
                </ul>

                <!-- Navbar Toggle -->
                <ul class="navbar-nav toggle">
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#menu">
                            <i class="icon-menu m-0"></i>
                        </a>
                    </li>
                </ul>

                <!-- Navbar Action -->
                <ul class="navbar-nav action">
                    <li class="nav-item ml-3">
                        @if(Auth::check())
                            <a href= "/core/" target="_blank" class="btn ml-lg-auto primary-button">Try Now. Its FREE</a> 
                        @else
                            <a href= "/accounts/login/" target="_blank" class="btn ml-lg-auto primary-button">Try Now. Its FREE</a> 
                        @endif
                        <!-- 
                                Suggestion: Replace the purchase button above with a contact button.
                                
                                <a href="#contact" class="smooth-anchor btn ml-lg-auto primary-button">CONTACT US</a>
                            -->
                    </li>
                </ul>
            </div>
        </nav>

    </header>

    <!-- Hero -->
    <section id="slider" class="hero p-0 odd">
        <div class="swiper-container no-slider animation slider-h-100 slider-h-auto">
            <div class="swiper-wrapper">

                <!-- Item 1 -->
                <div class="swiper-slide slide-center">

                    <!-- Media -->
                    <video class="full-image to-bottom" data-mask="50" playsinline autoplay muted loop>
                        <source src="theme/nexgen/videos/home.mp4" type="video/mp4" />
                        {{--
                        <source
                            src="https://download-video.akamaized.net/2/playback/3cd6a50a-f07e-4bbc-b390-a53ab02d7564/601866d5-4073f635?__token__=st=1680165605~exp=1680180005~acl=%2F2%2Fplayback%2F3cd6a50a-f07e-4bbc-b390-a53ab02d7564%2F601866d5-4073f635%2A~hmac=31ace054f2e5011b9ee1bdc7b9dfa3f70c3f993ae9d033b72130f93a706b3103&r=dXMtY2VudHJhbDE%3D"
                            type="video/mp4" /> --}}

                    </video>

                    <div class="slide-content row">
                        <div class="col-10 d-flex justify-content-start justify-content-md-end inner">
                            <div class="right text-left">

                                <!-- Content -->
                                <h1 data-aos="zoom-in" data-aos-delay="2000" class="title effect-static-text"><span
                                        class="featured bottom"><span>Gateway</span></span><br>to Seamless Logistics
                                </h1>
                                <p data-aos="zoom-in" data-aos-delay="2400" class="description bigger">Our website is
                                    <b> under construction! </b><br>We are preparing something amazing and exciting for
                                    you.
                                </p>

                                <!-- Action -->
                                <div data-aos="fade-up" data-aos-delay="2800" class="buttons">
                                    <div class="d-sm-inline-flex">
                                        <a href="#contact" class="smooth-anchor mt-4 btn primary-button">GET IN
                                            TOUCH</a>
                                        <a href="#services" class="smooth-anchor ml-sm-4 mt-4 btn outline-button">READ
                                            MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Process -->
    <section id="services" class="section-1 process offers">
        <div class="container full">
            <div class="row text-center intro">
                <div class="col-12">
                    <span class="pre-title">What's coming?</span>
                    <h2><span class="featured"><span>Simplifying </span></span>Your Logistics</h2>
                    <p class="text-max-800">We employ innovative methodologies throughout the logistics process to
                        ensure maximum efficiency from start to finish, delivering your goods with precision and
                        reliability. Our commitment to innovation helps us optimize each stage of the logistics journey,
                        ensuring your shipments are handled with care and delivered on time</p>
                </div>
            </div>
            <div class="row justify-content-center text-center items">
                <div class="col-12 col-md-6 col-lg-2 item">
                    <div class="step"><span>01</span></div>
                    <h4>AI-Routing</h4>
                    <p>Nixus will utilizes cutting-edge AI technology to optimize the routing of transportation for
                        maximum efficiency and cost-effectiveness.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-2 item">
                    <div class="step"><span>02</span></div>
                    <h4>Automatic Invoicing</h4>
                    <p>Streamlining the billing process for our clients. Our platform generates invoices automatically
                        based on delivery data, eliminating the need for manual invoicing and reducing the risk of
                        errors.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-2 item">
                    <div class="step"><span>03</span></div>
                    <h4>Real-time tracking & tracing</h4>
                    <p>Allowing you to monitor the status and location of your shipments throughout the transportation
                        process. With our platform, you can easily track your goods from pickup to delivery.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-2 item">
                    <div class="step"><span>04</span></div>
                    <h4>ML based Geocoding engine</h4>
                    <p>Convert fuzzy addresses into highly precise & accurate latitude and longitude coordinates. Avoid
                        misroutes and delay in deliveries </p>
                </div>
                <div class="col-12 col-md-6 col-lg-2 item">
                    <div class="step"><span>05</span></div>
                    <h4>Automatic Workflows</h4>
                    <p>Reduce manual labor by automating key tasks such as order processing, route planning, and
                        dispatching, our platform streamlines logistics operations and eliminates unnecessary delays.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Services -->
    {{-- <section id="services" class="section-1 offers featured">
        <div class="container">
            <div class="row items">
                <div class="col-12 col-md-4 pr-md-5 text">
                    <div data-aos="fade-up" class="row intro">
                        <div class="col-12 p-0">
                            <span class="pre-title m-0">Our Business Areas</span>
                            <h2>Simplify Logistics</h2>
                            <p>Logistics platform that uses AI and Machine Learning to streamline logistics operations,
                                saving businesses time and resources, while reducing their carbon footprint, and
                                improving customer satisfaction.</p>
                            <div class="badges">
                                <span class="badge"><a href="#">Future Ready Platform</a></span>
                                <span class="badge"><a href="#">Quality</a></span>
                                <span class="badge"><a href="#">Consultative Approach</a></span>

                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group align-self-center">
                                    <a href="#" class="btn primary-button">READ MORE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-up" class="col-12 col-md-4 item">
                    <div class="card">
                        <div class="col-12">
                            <img src="theme/nexgen/images/gallery-3.jpg" alt="Logo" class="logo">
                            <h4>Technology</h4>
                            <p>Focused on developing technology solutions adapted to our client's needs.</p>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-up" class="col-12 col-md-4 item">
                    <div class="card">
                        <div class="col-12">
                            <img src="theme/nexgen/images/gallery-5.jpg" alt="Logo" class="logo">
                            <h4>Transport</h4>
                            <p>We develop operational strategies to improve logistical efficiency.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Solution -->
    <section id="solution" class="section-2 odd highlights image-right counter skills featured">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 pr-md-5 align-self-center text-center text-md-left text items">
                    <div data-aos="fade-up" class="row intro">
                        <div class="col-12 p-0">
                            <span class="pre-title m-auto m-md-0">About the network</span>
                            <h2><span class="featured"><span>Solving</span></span> Critical Logistics Initiatives</h2>
                            <p>With all of this expertise and capability comes an unrivalled commitment to customer service.</p>
                        </div>
                    </div>
                    <div data-aos="fade-up" class="row flex align-items-center text-left item">
                        <div class="col-5 col-sm-3 pl-0" style="text-align: center;">
                            {{-- <i class="fa-sharp fa-light fa-sitemap"></i> --}}
                            <i class="fas fa-sitemap mr-2" style="font-size: 3rem;"></i>
                            {{-- <div data-percent="100" class="radial">
                                <span></span>
                            </div> --}}
                        </div>
                        <div class="col-7 col-sm-9">
                            <h4 class="mt-0">Streamline</h4>
                            <p>Dramatically simplify the most complicated aspects of your delivery logistics.</p>
                        </div>
                    </div>
                    <div data-aos="fade-up" class="row flex align-items-center text-left item">
                        <div class="col-5 col-sm-3 pl-0" style="text-align: center;">
                            <i class="fas fa-light fa-handshake" style="font-size: 3rem;"></i>
                        </div>
                        <div class="col-7 col-sm-9">
                            <h4 class="mt-0">Satisfy</h4>
                            <p>Improve customer satisfaction and loyalty by ensuring on-time, accurate deliveries</p>
                        </div>
                    </div>
                    <div data-aos="fade-up" class="row flex align-items-center text-left item">
                        <div class="col-5 col-sm-3 pl-0" style="text-align: center;">
                            <i class="fas fa-layer-group mr-2" style="font-size: 3rem;"></i>
                        </div>
                        <div class="col-7 col-sm-9">
                            <h4 class="mt-0">Minimize</h4>
                            <p>Continously improve the enviromental impact from deliveries </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-0 image">
                    <img src="theme/nexgen/images/about-5.jpg" class="fit-image" alt="Fit Image">
                </div>
            </div>
        </div>
    </section>
    <!-- Services -->
    {{-- <section id="services" class="section odd offers">
        <div class="container">
            <div class="row items">
                <div class="col-12 col-md-4 pr-md-5 text">
                    <div data-aos="fade-up" class="row intro">
                        <div class="col-12 p-0">
                            <span class="pre-title m-0">What we do</span>
                            <h2 class="mb-0">We offer a full range<br>of <span
                                    class="featured bottom"><span>delivery</span></span> methods.</h2>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-up" class="col-12 col-md-8 item">
                    <div class="card">
                        <i class="icon fas fa-shipping-fast"></i>
                        <h4>Shipping Fast</h4>
                        <p>Special fast delivery service that guarantees the arrival of the object on the same day as
                            postage. Included monitoring via miobile app.</p>
                        <a href="#"><i class="btn-icon pulse fas fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div data-aos="fade-up" class="col-12 col-md-4 item">
                    <div class="card">
                        <i class="icon fas fa-motorcycle"></i>
                        <h4>Motoboy</h4>
                        <p>Functional motoboy for delivery of documents and small objects.</p>
                        <a href="#"><i class="btn-icon pulse fas fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div data-aos="fade-up" class="col-12 col-md-4 item">
                    <div class="card">
                        <i class="icon fas fa-shuttle-van"></i>
                        <h4>Shuttle Van</h4>
                        <p>Suitable for medium sized loads that need digital tracking.</p>
                        <a href="#"><i class="btn-icon pulse fas fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div data-aos="fade-up" class="col-12 col-md-4 item">
                    <div class="card">
                        <i class="icon fas fa-truck-moving"></i>
                        <h4>Mini Truck</h4>
                        <p>For dry cargo deliveries with more cubic allocation.</p>
                        <a href="#"><i class="btn-icon pulse fas fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{--
    <!-- Partners -->
    <section id="partners" class="section-3 partners">
        <div class="overflow-holder">
            <div class="container">
                <div class="swiper-container min-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-1.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-2.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-3.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-4.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-5.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-1.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-2.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-3.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-4.png" class="fit-image" alt="Fit Image">
                        </div>
                        <div class="swiper-slide slide-center item">
                            <img src="theme/nexgen/images/logo-5.png" class="fit-image" alt="Fit Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog -->
    <section id="blog" class="section-4 carousel showcase">
        <div class="overflow-holder">
            <div class="container">
                <div class="row intro">
                    <div class="col-12 col-md-9 align-self-center text-center text-md-left">
                        <span class="pre-title m-auto m-md-0">Our editorial content</span>
                        <h2>Latest <span class="featured"><span>News</span></span></h2>
                        <p>Every week we publish content about what is best in the business world.</p>
                    </div>
                    <div class="col-12 col-md-3 align-self-end">
                        <a href="#" class="btn mx-auto mr-md-0 ml-md-auto primary-button">SEE ALL</a>
                    </div>
                </div>
                <div class="swiper-container mid-slider items" data-perview="3">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-1.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>Andrea
                                        Miller</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>2 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>Increasing creativity is possible for everyone</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-2.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>John
                                        Smith</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>9 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>Because market research is part of the business plan</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-3.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>Andrea
                                        Miller</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>16 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>Working from home is now a trend</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-4.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>John
                                        Smith</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>23 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>Tips for having a good relationship at work</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-5.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>David
                                        Cooper</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>30 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>David Cooper tells about the opening of the new office in Baltimore</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-1.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>Andrea
                                        Miller</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>2 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>Increasing creativity is possible for everyone</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-2.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>John
                                        Smith</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>9 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>Because market research is part of the business plan</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-3.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>Andrea
                                        Miller</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>16 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>Working from home is now a trend</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-4.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>John
                                        Smith</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>23 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>Tips for having a good relationship at work</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide slide-center item">
                            <div class="row card p-0 text-center">
                                <div class="image-over">
                                    <img src="theme/nexgen/images/news-5.jpg" alt="Lorem ipsum">
                                </div>
                                <div class="card-footer d-lg-flex align-items-center justify-content-center">
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-user"></i>David
                                        Cooper</a>
                                    <a href="#" class="d-lg-flex align-items-center"><i class="icon-clock"></i>30 Days
                                        Ago</a>
                                </div>
                                <div class="card-caption col-12 p-0">
                                    <div class="card-body">
                                        <a href="page-single-post-1.html">
                                            <h4>David Cooper tells about the opening of the new office in Baltimore</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscribe -->
    <section id="subscribe" class="section-5 odd subscribe">
        <div class="container smaller">
            <div class="row">
                <div class="col-12 col-md-6 m-md-0 intro">
                    <span class="pre-title m-0">Newsletter</span>
                    <h2><span class="featured"><span>Know</span></span> First</h2>
                    <p>Follow closely and receive content about our company and the news of the current market.</p>
                </div>
                <div class="col-12 col-md-6">
                    <form action="php/form.php" id="nexgen-subscribe" class="row m-auto items">
                        <input type="hidden" name="section" value="nexgen_subscribe">

                        <input type="hidden" name="reCAPTCHA">
                        <!-- Remove this field if you want to disable recaptcha -->

                        <div class="col-12 mt-0 input-group align-self-center item">
                            <input type="text" name="name" class="form-control less-opacity field-name"
                                placeholder="Name">
                        </div>
                        <div class="col-12 input-group align-self-center item">
                            <input type="email" name="email" class="form-control less-opacity field-email"
                                placeholder="Email">
                        </div>
                        <div class="col-12 input-group align-self-center item">
                            <a data-aos="zoom-in" class="btn primary-button">SUBSCRIBE</a>
                        </div>
                        <div class="col-12 item">
                            <span class="form-alert mt-3 mb-0"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Contact -->
    <section id="contact" class="section-6 form contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 pr-md-5 align-self-center text">
                    <div class="row intro">
                        <div class="col-12 p-0">
                            <span class="pre-title m-0">Send a message</span>
                            <h2>Get in <span class="featured"><span>Touch</span></span></h2>
                            <p>We will respond to your message as soon as possible.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-0">
                            <form action="php/form.php" id="nexgen-simple-form" class="nexgen-simple-form">
                                <input type="hidden" name="section" value="nexgen_form">

                                <input type="hidden" name="reCAPTCHA">
                                <!-- Remove this field if you want to disable recaptcha -->

                                <div class="row form-group-margin">
                                    <div class="col-12 col-md-6 m-0 p-2 input-group">
                                        <input type="text" name="name" class="form-control field-name"
                                            placeholder="Name">
                                    </div>
                                    <div class="col-12 col-md-6 m-0 p-2 input-group">
                                        <input type="email" name="email" class="form-control field-email"
                                            placeholder="Email">
                                    </div>
                                    <div class="col-12 col-md-6 m-0 p-2 input-group">
                                        <input type="text" name="phone" class="form-control field-phone"
                                            placeholder="Phone">
                                    </div>
                                    <div class="col-12 col-md-6 m-0 p-2 input-group">
                                        <i class="icon-arrow-down mr-3"></i>
                                        <select name="info" class="form-control field-info">
                                            <option value="" selected disabled>More Info</option>
                                            <option>Audit & Assurance</option>
                                            <option>Financial Advisory</option>
                                            <option>Analytics and M&A</option>
                                            <option>Middle Marketing</option>
                                            <option>Legal Consulting</option>
                                            <option>Regulatory Risk</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12 m-0 p-2 input-group">
                                        <textarea name="message" class="form-control field-message"
                                            placeholder="Message"></textarea>
                                    </div>
                                    <div class="col-12 col-12 m-0 p-2 input-group">
                                        <span class="form-alert"></span>
                                    </div>
                                    <div class="col-12 input-group m-0 p-2">
                                        <a class="btn primary-button">SEND</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="contacts">
                        <h4>Contact now.</h4>
                        <p>Don't hesitate to contact us now and <br>we'll be happy to assist you. </p>

                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-phone-alt mr-2"></i>
                                     042-838857
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-envelope mr-2"></i>
                                    hello@thelogx.com
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                     Dubai, UAE
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="mt-2 btn outline-button" data-toggle="modal" data-target="#map">VIEW
                                    MAP</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <!-- Footer [content] -->
        <section id="footer" class="odd footer offers">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 footer-left">
                        <!-- Navbar Brand-->
                        <a class="navbar-brand" href="/">
                            <!-- 
                                    Custom Logo
                                    <img src="theme/nexgen/images/logo.svg" alt="NEXGEN">
                                -->
                            <img src="theme/nexgen/images/logo_white_with_logx_2.png" alt="Nixus">
                        </a>
                        <p>Gateway to Seamless Logistics.</p>

                    </div>
                    <div class="col-12 col-lg-9 p-0 footer-right">
                        <div class="row items">
                            <div class="col-14 col-lg-6 item">
                                <div class="card">
                                    <h4>About</h4>
                                    <a href="#"><i class="icon-arrow-right"></i>Our Services</a>
                                    <a href="#"><i class="icon-arrow-right"></i>Terms & conditions</a>
                                    <a href="#"><i class="icon-arrow-right"></i>Pricing </a>
                                </div>
                            </div>
                            <div class="col-14 col-lg-6 item">
                                <div class="card">
                                    <h4>Contact</h4>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-phone-alt mr-2"></i>
                                                 042-838857
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-envelope mr-2"></i>
                                                hello@thelogx.com
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-map-marker-alt mr-2"></i>
                                                 Dubai, UAE
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#contact" class="mt-4 btn outline-button smooth-anchor">GET IN
                                                TOUCH</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-lg-4 item">
                                <div class="card">
                                    <h4>Support</h4>
                                    <a href="#"><i class="icon-arrow-right"></i>Responsibility</a>
                                    <a href="#"><i class="icon-arrow-right"></i>Terms of Use</a>
                                    <a href="#"><i class="icon-arrow-right"></i>About Cookies</a>
                                    <a href="#"><i class="icon-arrow-right"></i>Privacy Policy</a>
                                    <a href="#"><i class="icon-arrow-right"></i>Accessibility</a>
                                    <a href="#"><i class="icon-arrow-right"></i>Information</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Copyright -->
        <section id="copyright" class="p-3 odd copyright">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 p-3 text-center text-lg-left">
                        <p>Enjoy the low price. We are tracking any intention of piracy.</p>
                        <!--
                                Suggestion: Replace the text above with a description of your website.
                             -->
                    </div>
                    <div class="col-12 col-md-6 p-3 text-center text-lg-right">
                        <p>© 2023 Nixus is Proudly Powered by <a href="https://www.logxtransport.com/"
                                target="_blank">L O G X</a></p>
                    </div>
                </div>
            </div>
        </section>

    </footer>

    <!-- Modal [search] -->
    <div id="search" class="p-0 modal fade" role="dialog" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header" data-dismiss="modal">
                    <i class="icon-close fas fa-arrow-right"></i>
                </div>
                <div class="modal-body">
                    <form class="row">
                        <div class="col-12 p-0 align-self-center">
                            <div class="row">
                                <div class="col-12 p-0">
                                    <h2>What are you looking for?</h2>
                                    <div class="badges">
                                        <span class="badge"><a href="#">Consulting</a></span>
                                        <span class="badge"><a href="#">Audit</a></span>
                                        <span class="badge"><a href="#">Assurance</a></span>
                                        <span class="badge"><a href="#">Advisory</a></span>
                                        <span class="badge"><a href="#">Financial</a></span>
                                        <span class="badge"><a href="#">Capital Markets</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group">
                                    <input type="text" class="form-control" placeholder="Enter Keywords">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group align-self-center">
                                    <button class="btn primary-button">SEARCH</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal [sign] -->
    <div id="sign" class="p-0 modal fade" role="dialog" aria-labelledby="sign" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header" data-dismiss="modal">
                    <i class="icon-close fas fa-arrow-right"></i>
                </div>
                <div class="modal-body">
                    <form action="/" class="row">
                        <div class="col-12 p-0 align-self-center">
                            <div class="row">
                                <div class="col-12 p-0 pb-3">
                                    <h2>Sign In</h2>
                                    <p>Don't have an account? <a href="#" class="primary-color" data-toggle="modal"
                                            data-target="#register">Register now</a>.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group">
                                    <input type="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-12 p-0 input-group">
                                    <input type="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group align-self-center">
                                    <button class="btn primary-button">SIGN IN</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal [register] -->
    <div id="register" class="p-0 modal fade" role="dialog" aria-labelledby="register" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header" data-dismiss="modal">
                    <i class="icon-close fas fa-arrow-right"></i>
                </div>
                <div class="modal-body">
                    <form action="/" class="row">
                        <div class="col-12 p-0 align-self-center">
                            <div class="row">
                                <div class="col-12 p-0 pb-3">
                                    <h2>Register</h2>
                                    <p>Have an account? <a href="#" class="primary-color" data-toggle="modal"
                                            data-target="#sign">Sign In</a>.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group">
                                    <input type="text" class="form-control" placeholder="Name" required>
                                </div>
                                <div class="col-12 p-0 input-group">
                                    <input type="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-12 p-0 input-group">
                                    <input type="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="col-12 p-0 input-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-0 input-group align-self-center">
                                    <button class="btn primary-button">REGISTER</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal [map] -->
    <div id="map" class="p-0 modal fade" role="dialog" aria-labelledby="map" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header absolute" data-dismiss="modal">
                    <i class="icon-close fas fa-arrow-right"></i>
                </div>
                <div class="modal-body p-0">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14449.263388581727!2d55.2110873!3d25.1250105!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6bc0e40cfe29%3A0x97c45958a23574b0!2sL%20O%20G%20X!5e0!3m2!1sen!2s!4v1680191212553!5m2!1sen!2s"
                        width="600" height="450" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal [responsive menu] -->
    <div id="menu" class="p-0 modal fade" role="dialog" aria-labelledby="menu" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content full">
                <div class="modal-header" data-dismiss="modal">
                    <i class="icon-close fas fa-arrow-right"></i>
                </div>
                <div class="menu modal-body">
                    <div class="row w-100">
                        <div class="items p-0 col-12 text-center">
                            <!-- Append [navbar] -->
                        </div>
                        <div class="contacts p-0 col-12 text-center">
                            <!-- Append [navbar] -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll [to top] -->
    <div id="scroll-to-top" class="scroll-to-top">
        <a href="#header" class="smooth-anchor">
            <i class="fas fa-arrow-up"></i>
        </a>
    </div>

    <!-- ==============================================
        Google reCAPTCHA // Put your site key here
        =============================================== -->
    <script src="https://www.google.com/recaptcha/api.js?render=6Lf-NwEVAAAAAPo_wwOYxFW18D9_EKvwxJxeyUx7"></script>

    <!-- ==============================================
        Vendor Scripts
        =============================================== -->
    <script src="theme/nexgen/js/vendor/jquery.min.js"></script>
    <script src="theme/nexgen/js/vendor/jquery.easing.min.js"></script>
    <script src="theme/nexgen/js/vendor/jquery.inview.min.js"></script>
    <script src="theme/nexgen/js/vendor/popper.min.js"></script>
    <script src="theme/nexgen/js/vendor/bootstrap.min.js"></script>
    <script src="theme/nexgen/js/vendor/ponyfill.min.js"></script>
    <script src="theme/nexgen/js/vendor/slider.min.js"></script>
    <script src="theme/nexgen/js/vendor/animation.min.js"></script>
    <script src="theme/nexgen/js/vendor/progress-radial.min.js"></script>
    <script src="theme/nexgen/js/vendor/bricklayer.min.js"></script>
    <script src="theme/nexgen/js/vendor/gallery.min.js"></script>
    <script src="theme/nexgen/js/vendor/shuffle.min.js"></script>
    <script src="theme/nexgen/js/vendor/cookie-notice.min.js"></script>
    <script src="theme/nexgen/js/vendor/particles.min.js"></script>
    <script src="theme/nexgen/js/main.js"></script>

</body>

</html>