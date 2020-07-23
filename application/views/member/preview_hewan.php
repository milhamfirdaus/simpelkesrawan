    	<?php $this->load->view('_part/member/_style')?>
	   	
	<link rel="stylesheet" href="<?= base_url('assets/')?>node_modules/html5-editor/bootstrap-wysihtml5.css" /><script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css' rel='stylesheet' />
    <link href="<?= base_url('assets/')?>node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    	<?php $this->load->view('_part/member/_head')?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php 
        if($dataHewan->hewanJenisKelamin=='J'){
            $jk = 'Jantan';
        }else{
            $jk = 'Bentina';
        }   
    ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                          <img src="<?= base_url('assets/img/').$dataHewan->hewanGambar?>" class="card-img-top" alt="...">
                          <div class="card-body">
                            <h5 class="card-title"> Nama Hewan : <?= $dataHewan->hewanNama?></h5>
                            <p class="card-text"></p>
                            <p class="card-text"></p>
                            <p>Pemilik : <?= $dataHewan->memberNamaLengkap?>, <?= $dataHewan->memberHandphone?>, </p>
                            <p><?= $dataHewan->memberAlamat?>, Kelurahan <?=$dataHewan->namaDesa?>, Kecamatan <?= $dataHewan->kecamatanNama?></p>
                    <span><em></em></span><hr>
                    <ul class="list-group">
                      <li class="list-group-item active">Spesies <?= $dataHewan->spesiesNama?></li>
                      <li class="list-group-item">Jenis Kelamin : <?= $jk?></li>
                    </ul><br>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card" id="map"class="" style="height: 450px;width: : auto;">
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <footer class="footer">
                © 2019 SIMPEL KESRAWAN | All Rights Reserved.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
	<?php $this->load->view('_part/member/_src_foot')?>
     <!-- This is data table -->
    <script src="<?= base_url('assets/')?>node_modules/datatables/jquery.dataTables.min.js"></script>
     <!-- This is sweet alert -->
    <script src="<?= base_url('assets/')?>node_modules/sweetalert/sweetalert.min.js"></script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="<?= base_url('assets/')?>node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="<?= base_url('assets/')?>node_modules/html5-editor/bootstrap-wysihtml5.js"></script>

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