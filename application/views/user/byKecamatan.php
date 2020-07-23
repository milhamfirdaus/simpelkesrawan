<?php $this->load->view('_part/user/_head')?>
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
                <div class="col--md-4 col-sm-3 col-xs-4">
                    <a href="<?= site_url('assets/user/')?>index.html" id="logo"><img src="<?= site_url('assets/user/')?>img/logo.png" width="170" height="30" alt="" data-retina="true">
                    </a>
                </div>
              <?php $this->load->view('_part/user/_nav.php')?>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </header>
    <!-- End Header =============================================== -->

    <div class="container-fluid full-height">
        <div class="row row-height">
            <div class="col-lg-7 col-md-6 content-left">
                <div id="filters_map"></div>
                <div class="row">
                <?php if($dataByKecamatanID):?>
                <?php foreach ($dataByKecamatanID as $dt):?>
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <div class="img_wrapper">
                            <div class="tools_i">
                                <div class="directions_list_map" onclick="onHtmlClick('Hotels', 7)">
                                    <a class="tooltip_styled tooltip-effect-4"><span class="tooltip-item"></span>
								<div class="tooltip-content">Lihat di peta</div>
								</a>
                                </div>
                            </div>
                            <!-- End tool_i -->
                            <div class="img_container">
                                <a href="<?= site_url('assets/user/')?>florence-hotel-detail.html">
                                    <img src="<?= site_url('assets/img/').$dt->kucingGambar?>" width="800" height="533" class="img-responsive" alt="">
                                    <div class="short_info">
                                        <strong>From 30$</strong>
                                        <h3><?= $dt->kucingNama?></h3>
                                        <em><?= $dt->spesiesNama?></em>
                                        <p>
                                            <?= $dt->kucingKeterangan?>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End img_wrapper -->
                    </div>
                    <?php endforeach;?>
                    <?php else:?>
                    	<!-- jika data tidak ada -->
                    <?php endif;?>
                </div>
                <!-- End row -->
                <?php echo $this->pagination->create_links();?>
 
            </div>
            <!-- End content-left-->

            <div class=" col-lg-5 col-md-6 map-right">
                <div class="map" id="map"></div>
                <!-- map-->
            </div>

        </div>
        <!-- End row-->
    </div>
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