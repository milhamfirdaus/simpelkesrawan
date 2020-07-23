<?php $this->load->view('_part/user/_head')?>
    <link href="<?= base_url('assets/user/')?>css/blog.css" rel="stylesheet">
    <link rel='stylesheet' id='travelguide-popup-css-css'  href='<?= site_url('assets/user/')?>css/magnific-popup.css' type='text/css' media='all' />
</head>
<body>

    <!--[if lte IE 8]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="<?= site_url('assets/user/')?>http://browsehappy.com/">upgrade your browser</a>.</p>
    <![endif]-->

    <div class="layer"></div>
    <!-- Menu mask -->

    <!-- Header ================================================== -->
    <header >
    <div class="container-fluid">
        <div class="row">
          <?php $this->load->view('_part/user/_nav.php')?>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
	</header>
        <?php if($dataPost):?>
        <section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url('assets/img/post/').$dataPost->postFeaturedImage?>" data-natural-width="1200" data-natural-height="720">
        <div id="sub_content_in">
            <h1 style="text-transform:none"><?=$dataPost->kategoriNama;?> <strong id="js-rotating" style="text-transform:uppercase"></strong></h1>
            <p><?= $dataPost->postJudul?></p>
        </div>
        <?php else:?>
            <section class="parallax_window_in" data-parallax="scroll" data-image-src="<?=base_url('assets/')?>gambar/slide-2.jpg" data-natural-width="1200" data-natural-height="720">
            <div id="sub_content_in">
                <h1 style="text-transform:none">Opps! <strong id="js-rotating" style="text-transform:uppercase"></strong></h1>
                <p>Informasi yang anda cari tidak ditemukan</p>
            </div>
        <?php endif;?>
    </section>
    <!-- End Header =============================================== -->

    <!-- End SubHeader ============================================ -->
    	<div id="position">
            <div class="container">
                <ul>
                    <li>Page
                    </li>
                    <li>Blog</li>
                </ul>
            </div>
        </div>
        <div class="container margin_60_30">
        <div class="row">
            
            <div class="col-md-9">
                <?php if($dataPost):?>
                <div class="post">
                    <?php if($dataPost->video != ""): ?>
                        <div class="img_wrapper magnific-gallery">
                            <div class="img_container">
                                <a href="<?=$dataPost->video?>" class="video" title="Video Vimeo">
                                    <img src="<?=base_url('assets/')?>gambar/play.png" alt="" class="img-responsive" style="object-fit: cover; width: 800px; height: 350px; object-position: center;">
                                </a>
                            </div>
                        </div>
                        <a href="<?=$dataPost->video?>" class="video" title="Video Vimeo">
                        <h5 class="text-center"><strong>Play Video</strong></h5><hr>
                        </a>
                    <?php else:?>
                    <img src="<?= base_url('assets/img/post/').$dataPost->postFeaturedImage?>" alt="" class="img-responsive" style="object-fit: cover; width: 800px; height: 350px; object-position: center;">
                    <?php endif;?>
                    <div class="post_info clearfix">
                        <div class="post-left">
                            <ul>
                                <li><i class="icon-calendar-empty"></i><?= $dataPost->postTanggalInsert?><em> <a href="#" title="Posts by admin" rel="author">admin</a></em>
                                </li>
                                <li><i class="icon-inbox-alt"></i><a href="<?=site_url('kategori/'.$datapost->kategoriID);?>"><?= $dataPost->kategoriNama?> </a>                                
                                </li>
                            </ul>
                        </div>
                    </div>

                    <h2><?= $dataPost->postJudul?></h2>
                    <?php echo $dataPost->postKonten;?>
                </div>
                <?php endif;?>
                
                <!-- end post -->
            </div>
            

            <!-- End col-md-9-->

                    

            <aside class="col-md-3" id="sidebar">
                <div id="search-2" class="widget widget_search"> 
                        <form id="custom-search-input-blog" action="<?=site_url('user/post');?>" method="post">
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
                <div id="recent-posts-2" class="widget widget_news">        
                    <h4>Posting Terkait</h4>         
                    <ul class="recent_post">

                    <?php 
                    if($dataRelated): 
                    foreach($dataRelated as $rel):?>
                    <li>
                        <i class="icon-calendar-empty"></i> <?= $rel->postTanggalInsert?>              
                        <div><a href="<?=site_url('informasi/'.$rel->postID)?>"><?= $rel->postJudul?></a>
                        </div>
                    </li>
                    <?php endforeach;?>
                    <?php else:?>
                    <li>Tidak ada posting terkait</li>
                    <?php endif;?>
                            
                        </ul>
                
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

    <?php $this->load->view('_part/user/__footerpage')?>

</html>