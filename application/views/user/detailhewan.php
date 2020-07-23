    <?php $this->load->view('_part/user/_head')?>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.css' rel='stylesheet' /> 
<link rel='stylesheet' id='travelguide-popup-css-css'  href='<?= site_url('assets/user/')?>css/magnific-popup.css' type='text/css' media='all' />
</head>
<body>
    <?php 
		if($dataHewan->hewanJenisKelamin=='J'){
		    $jk = 'Jantan';
		}else{
		    $jk = 'Bentina';
		}   
    ?>
    <header>
        <div class="container-fluid">
            <div class="row">
            <?php $this->load->view('_part/user/_nav.php')?>
            </div>
            <!-- End row -->
        </div>
    </header>
    <?php if($dataHewan):?>
    <section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url('assets/img/').$dataHewan->hewanGambar?>" data-natural-width="1400" data-natural-height="720">
        <div id="sub_content_in">
            <div id="sub_content_in_left">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h1><?= $dataHewan->hewanNama?></h1>
                            <span><i class="icon_pin"></i> Kelurahan <?=$dataHewan->namaDesa?>, Kecamatan <?= $dataHewan->kecamatanNama?></span></div>
                        <div class="col-md-4">
                            <div class="score_wp_in"><?= $dataHewan->spesiesNama?></div>                                                    
                        </div>
                    </div>
                </div>
            </div>
            <!-- End sub_content_left -->
        </div>
    </section>
            
    <div class="container margin_60_30">
        <div class="box_style_general add_bottom_30">   
            <div class="row magnific-gallery">
                <div class="col-md-12 col-lg-6 col-lg-6">
                    <div class="img_container">
                        <a href="<?= base_url('assets/img/').$dataHewan->hewanGambar?>" title="<?= $dataHewan->hewanNama?>">
                            <img style="margin-bottom:35px; max-height: 10%;" class="img-responsive" alt="" src="<?= base_url('assets/img/').$dataHewan->hewanGambar?>">
                        </a>
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box_info">
                        <h3>Informasi Hewan</h3>
                        <ul>
                            <li><strong>Nama Hewan </strong> : <?= $dataHewan->hewanNama?></li>
                            <li><strong>Jenis Kelamin</strong> : <?= $jk?></li>
                            <li><strong>Spesies Hewan</strong> : <?= $dataHewan->spesiesNama?></li>
                        </ul>
                    </div>
                </div>  
                <div class="col-md-6">
                    <div class="box_info">
                        <h3>Informasi Pemilik</h3>
                        <ul>
                            <li><strong>Nama Pemilik </strong> : <?= $dataHewan->memberNamaLengkap?></li>
                            <li><strong>Alamat</strong> : <?= $dataHewan->memberAlamat?></li>
                            <li><strong>No Handphone</strong> : <?= $dataHewan->memberHandphone?></li>
                        </ul>
                    </div>
                </div>  
            </div>
        </div>
        <div class="box_style_general add_bottom_30">
            <div class="main_title add_bottom_30">
                <h3>Lokasi Hewan</h3> 
                <p>Kelurahan <?=$dataHewan->namaDesa?>, Kecamatan <?= $dataHewan->kecamatanNama?></p>
                <span><em></em></span>
            </div>
            <div id="map" style="height: 425px; margin-bottom:50px;"></div>  
        </div>
    </div>
    <?php else:?>
        <section class="parallax_window_in" data-parallax="scroll" data-image-src="<?=base_url('assets/')?>gambar/slide-2.jpg" data-natural-width="1400" data-natural-height="720">
            <div id="sub_content_in">
                <h1 style="text-transform:none">Opps! <strong id="js-rotating" style="text-transform:uppercase"></strong></h1>
                <p>Informasi yang anda cari tidak ditemukan</p>
            </div>
        </section>
    <?php endif;?>
    <?php $this->load->view('_part/user/__footerpage')?>
	<?php $this->load->view('_part/user/_jsfoot')?>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibmJiMTI4MDUiLCJhIjoiY2o3eTN4Y3R5NXQ3ZDJ3cW5yMnVwYzVmdyJ9.rA_Z0QLuHzufgnxn-Fgvqw';
        var map = new mapboxgl.Map({
        container: 'map', 
        style: 'mapbox://styles/mapbox/streets-v11', 
        center: [<?= $dataHewan->hewanLng?>,<?= $dataHewan->hewanLat?>],
        zoom: 13 
        });
        map.addControl(new mapboxgl.FullscreenControl({container: 'map'}));
        var marker = new mapboxgl.Marker().setLngLat([<?= $dataHewan->hewanLng?>,<?= $dataHewan->hewanLat?>]).addTo(map);
    </script>
</body>

</html>