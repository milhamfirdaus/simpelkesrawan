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
    <header id="plain">
    <div class="container-fluid">
        <div class="row">
          <?php $this->load->view('_part/user/_nav.php')?>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
	</header>
    <!-- End Header =============================================== -->
    <!-- SubHeader =============================================== -->
 
    <!-- End SubHeader ============================================ -->
    	<div id="position">
            <div class="container">
                <ul>
                    <li>Page
                    </li>
                    <li>Artikel</li>
                </ul>
            </div>
        </div>
        <div class="container margin_60_30">
        <div class="row">

            <div class="col-md-9">
            <?php if($dataPost):?>
              <?php foreach ($dataPost as $dt):?>
                <div class="post">
                    <h2><?= $dt->postJudul?></h2>
                    <?php 
                    echo substr($dt->postKonten, 0,600);
                    ?>
                    
                </div>
                <a href="<?= site_url('informasi/'.$dt->postID)?>" class="button">Baca Selengkapbnya</a>
                <?php endforeach;?>
                <!-- end post -->
                <nav>
                <?php echo $this->pagination->create_links();?>
                
                </nav>
			<?php else:?>
		 	<div class="post">
				<h3>Saat ini belum ada postingan terkait event !</h3>
			</div>
			<?php endif;?>
            </div>
            <!-- End col-md-9-->


            <aside class="col-md-3" id="sidebar">
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