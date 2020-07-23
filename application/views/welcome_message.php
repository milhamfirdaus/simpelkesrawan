<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Simpel Kesrawan</title>

    <!-- Favicon -->
    <link rel="icon" href="./img/core-img/logo.png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?=site_url('assets/slide/')?>style.css">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- /Preloader -->

    <!-- Header Area Start -->
    <header class="header-area">
        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="alimeNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="<?=site_url('beranda');?>"><img src="<?= site_url('assets/slide/')?>./img/core-img/header.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li><a href="<?=site_url('beranda')?>">Beranda</a></li>
                                    <li><a href="<?=site_url('auth')?>">Login</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Welcome Area Start -->
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">
            <!-- Single Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" style="background-image: url('<?=site_url('assets/gambar/');?>slide-2.jpg');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <!-- Welcome Text -->
                        <div class="col-12 col-lg-8 col-xl-6">
                            <div class="welcome-text">
                                <h2 data-animation="bounceInDown" data-delay="100ms">Selamat <br>Datang</h2>
                                <p data-animation="bounceInDown" data-delay="500ms">Di Sistem Pelayanan Kesehatan dan Kesejahteraan Hewan (SIMPEL KESRAWAN) Bidang Peternakan dan Kesehatan Hewan. Dinas Ketahanan Pangan, Pertanian dan Perikanan Kota Sukabumi.</p>
                                <div class="hero-btn-group" data-animation="bounceInDown" data-delay="100ms">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide -->
            <div class="single-welcome-slide bg-img bg-overlay" 
            style="background-image: url('<?=site_url('assets/gambar/');?>slide-1.jpg');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <!-- Welcome Text -->
                        <div class="col-12 col-lg-8 col-xl-6">
                            <div class="welcome-text">
                                <h2 data-animation="bounceInUp" data-delay="100ms">Simpel <br>Kesrawan</h2>
                                <p data-animation="bounceInUp" data-delay="500ms">Bertujuan meningkatkan kualitas pelayanan kesehatan dan kesejahteraan hewan bagi masyarakat dalam rangka akselerasi pengendalian Zoonosis di Kota Sukabumi. </p>
                                <div class="hero-btn-group" data-animation="bounceInDown" data-delay="100ms">
                                    <a href="<?=site_url('beranda');?>" class="btn alime-btn mb-3 mb-sm-0 mr-4">LEBIH LANJUT TENTANG KAMI </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome Area End -->

    <!-- Footer Area Start -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-content d-flex align-items-center justify-content-between">
                        <!-- Copywrite Text -->
                        <div class="copywrite-text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> SIMPEL KESRAWAN | All Rights Reserved.
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- **** All JS Files ***** -->
    <!-- jQuery 2.2.4 -->
    <script src="<?= site_url('assets/slide/')?>js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="<?= site_url('assets/slide/')?>js/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= site_url('assets/slide/')?>js/bootstrap.min.js"></script>
    <!-- All Plugins -->
    <script src="<?= site_url('assets/slide/')?>js/alime.bundle.js"></script>
    <!-- Active -->
    <script src="<?= site_url('assets/slide/')?>js/default-assets/active.js"></script>

</body>

</html>