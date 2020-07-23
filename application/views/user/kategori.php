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
    <!-- End Header =============================================== -->
    <section class="parallax_window_in" data-parallax="scroll" data-image-src="<?=base_url('assets/')?>gambar/slide-2.jpg" data-natural-width="1400" data-natural-height="720">
        <div id="sub_content_in">
            <h1 style="text-transform:none"> <?= $gKategoriNamaByID->kategoriNama?>  <strong id="js-rotating" style="text-transform:uppercase"></strong></h1>
            <p>SIMPLE KESRAWAN</p>
        </div>
    </section>
    <!-- End SubHeader ============================================ -->
        <div id="position" style="margin-top: 15px;">
            <div class="container">
                <ul>
                    <li>Kategori
                    </li>
                    <li><?= $gKategoriNamaByID->kategoriNama?></li>
                </ul>
            </div>
        </div>
        <div class="container margin_60_30">
        <div class="row">
            <div class="col-md-9">
			<?php if($dataPost):?>
             
			<?php foreach ($dataPost as $dt):?>
                
                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="img_wrapper">
                        <div class="img_container">
                            <a href="<?=site_url('informasi/'.$dt->postID)?>">
                            <img src="<?=base_url('assets/img/post/').$dt->postFeaturedImage?>" width="800" height="533" class="img-responsive" alt="">                      
                            <div class="short_info">
                                <small><?= $dt->postTanggalInsert?></small>
                                <h3><?= $dt->postJudul?></h3>
                                <em>Klik untuk Selengkapnya</em>
                                <p><?php 
                                    echo substr($dt->postKonten, 0,150);
                                    ?> . . .
                                </p>
                                <div class="score_wp">
                                    <?= $gKategoriNamaByID->kategoriNama?><div id="score_5" class="score" data-value="7.5"></div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <!-- End img_wrapper -->
                </div>
                <?php 
                endforeach;else:?>
			<div class="post">
				<h3>Tidak ada postingan untuk kategori <?= $gKategoriNamaByID->kategoriNama?></h3>
			</div>
            <?php endif;?>
                <nav>
                <?php echo $this->pagination->create_links();?>
                </nav>
            </div>
            
            <!-- End col-md-9-->

            <aside class="col-md-3" id="sidebar">
                <div id="search-2" class="widget widget_search"> 
                        <form id="custom-search-input-blog" action="<?=site_url('informasi');?>" method="post">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-lg" placeholder="Search" value="" name="search" id="search">
                            <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="submit">
                                <i class="icon-search-1"></i>
                            </button>
                        </span>
                        </div>
                        </form> 
                </div><hr>
                <div class="widget" style="margin-bottom: 20px;">
                    <h4>Kategori</h4>
                    <ul id="cat_nav_blog">
                    <?php foreach($kategori as $kat):?>
                        <li><a href="<?= site_url('kategori/').$kat->kategoriID?>"><?= $kat->kategoriNama?></a></li>
                    <?php endforeach;?>
                    </ul>
                </div>
            </aside>
            <!-- End aside -->

        </div>
    </div>
    <!-- End container -->
    <!-- COMMON SCRIPTS -->
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

</html>