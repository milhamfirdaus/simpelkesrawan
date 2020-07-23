<?php $this->load->view('_part/user/_head')?>
    <link href="<?= base_url('assets/user/')?>css/blog.css" rel="stylesheet">
</head>
<body>

    <!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="<?= site_url('assets/user/')?>http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->

    <div class="layer"></div>
    <!-- Menu mask -->

    <!-- Header ================================================== -->
    <header>
    <div class="container-fluid">
        <div class="row">
          <?php $this->load->view('_part/user/_nav.php')?>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
    </header>
    <section class="parallax_window_in" data-parallax="scroll" data-image-src="<?=base_url('assets/')?>gambar/home1.jpg" data-natural-width="1400" data-natural-height="550">
        <div id="sub_content_in">
            <h1 style="text-transform:none">SIMPEL KESRAWAN <strong id="js-rotating" style="text-transform:uppercase"></strong></h1>
            <p>Sistem Informasi Pelayanan Kesehatan dan Kesejahteraan Hewan</p>
        </div>
        
    </section>


    <!-- End Header =============================================== -->
    <div class="container margin_60_30 fix_mobile">

        <div class="main_title">
            <h2><strong>Tentang</strong> SIMPEL KESRAWAN</h2>
            <p>Sistem Informasi Pelayanan Kesehatan dan Kesejahteraan Hewan (SIMPEL KESRAWAN) merupakan wujud komitmen Bidang Peternakan dan Kesehatan Hewan pada Dinas Ketahanan Pangan, Pertanian dan Perikanan Kota Sukabumi yang bertujuan meningkatkan kualitas pelayanan kesehatan dan kesejahteraan hewan bagi masyarakat dalam rangka akselerasi pengendalian Zoonosis di Kota Sukabumi</p>
           <!-- <p>SIMPEL KESRAWAN dibangun dengan menggunakan semua data base peternakan dan kesehatan hewan yang sudah terverifikasi, kemudian diolah dan disajikan dengan memanfaatkan teknologi informasi berbasis Web-Gis dan bersifat real time sehingga dapat berfungsi sebagai early warning system dalam pengendalian zoonosis yang dapat dilakukan dengan  cepat dan akurat. SIMPEL KESRAWAN akan meningkatan kinerja petugas dalam penyusunan dan penyelenggaraan kegiatan vaksinasi, pengobatan, surveillance, eliminasi, sosialisasi, edukasi, promosi, dll. SIMPEL KESRAWAN akan mempermudah masyarakat pemilik hewan kesayangan dan ternak mendapatkan pelayanan kesehatan hewan serta mempermudah para pemangku kepentingan lainnya memperoleh data dan informasi tentang kondisi kesehatan dan kesejahteraan hewan di Kota Sukabumi.
            </p> -->
            <span><em></em></span>
        </div>

        <div class="row box_cat">
            <div class="col-md-3 col-sm-6">
                <a href="<?= site_url('member')?>">
                    <span>1</span>
                    <i class="icon_set_1_icon-39"></i>
                    <h3>Pendaftaran</h3>
                    <p>
                        Mendaftarkan hewan secara online.
                    </p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="<?= site_url('informasi')?>">
                    <span>2</span>
                    <i class="icon_set_1_icon-17"></i>
                    <h3>Artikel</h3>
                    <p>
                        Informasi dengan beragam kategori seputar SIMPEL KESRAWAN.
                    </p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="<?= site_url('geoanimal')?>">
                    <span>3</span>
                    <i class="icon_set_1_icon-41"></i>
                    <h3>Geoanimal</h3>
                    <p>
                        Menampilkan lokasi Hewan penyebar Rabies dengan menggunakan Map (Peta).
                    </p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="<?= site_url('kategori/10')?>">
                    <span>4</span>
                    <i class="icon_set_1_icon-54"></i>
                    <h3>Komunitas</h3>
                    <p>
                        Informasi komunitas pecinta hewan yang terdata di PUSKESWAN Kota Sukabumi
                    </p>
                </a>
            </div>
        </div>
        
        <!-- End row -->
    </div>
    <?php $this->load->view('_part/user/_jsfoot')?>
    <script>
        'use strict';
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                size: 'small'
            });
        });

        $("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 30,
            max: 180,
            from: 60,
            to: 130,
            type: 'double',
            step: 1,
            prefix: "Min. ",
            grid: false
        });
    </script>
</body>
    <?php $this->load->view('_part/user/__footerpage')?>
</html>