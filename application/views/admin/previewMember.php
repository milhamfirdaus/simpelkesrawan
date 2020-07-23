    	<?php $this->load->view('_part/admin/_style')?>
	   	
	<link rel="stylesheet" href="<?= base_url('assets/')?>node_modules/html5-editor/bootstrap-wysihtml5.css" /><script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css' rel='stylesheet' />
    <link href="<?= base_url('assets/')?>node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    	<?php $this->load->view('_part/admin/_head')?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <?php 
        if($dataMember->memberJK=='P'){
            $jk = 'Perempuan';
        }else{
            $jk = 'Laki-laki';
        }   

        if($dataMember->verified=="0"){
            $status="Belum diverifikasi";
        }
        else if($dataMember->verified=="2"){
            $status="Ditolak";
        }
        else if($dataMember->verified=="1"){
            $status="Terverifikasi";
        }
    ?>
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-md-6">
                        <div class="card">
                          <div class="card-body">
                            <h3 class="card-title text-center"> Data Pendaftar</h3>
                            <ul class="list-group">
                              <li class="list-group-item">Nama Lengkap : <?= $dataMember->memberNamaLengkap?></li>
                              <li class="list-group-item">NIK : <?= $dataMember->memberNIK?></li>
                              <li class="list-group-item">Jenis Kelamin : <?= $jk;?></li>
                              <li class="list-group-item">Handphone : 0<?= $dataMember->memberHandphone;?></li>
                              <li class="list-group-item">Tanggal Lahir : <?= $dataMember->memberTTL;?></li>
                              <li class="list-group-item">Alamat : <?= $dataMember->memberAlamat;?>, Kelurahan : <?= $dataMember->desaID;?>, Kecamatan : <?= $dataMember->kecamatanNama;?></li>
                              <li class="list-group-item"><?= $dataMember->memberEmail;?></li>
                              <li class="list-group-item"><?= $status;?></li>
                            </ul><br>
                            <div class="text-center">
                                <form id="insertData">    
                                    <input type="hidden" id="memberID" name="memberID" value="<?= $dataMember->memberID ?>">
                                </form>
                                <button  id='btn-publish' class="btn btn-info">Publish</button>
                                <button  id='btn-tolak' class="btn btn-danger">Tolak</button>
                            </div>
                          </div>
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
	<?php $this->load->view('_part/admin/_src_foot')?>
     <!-- This is data table -->
    <script src="<?= base_url('assets/')?>node_modules/datatables/jquery.dataTables.min.js"></script>
     <!-- This is sweet alert -->
    <script src="<?= base_url('assets/')?>node_modules/sweetalert/sweetalert.min.js"></script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="<?= base_url('assets/')?>node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="<?= base_url('assets/')?>node_modules/html5-editor/bootstrap-wysihtml5.js"></script>
	<script type="text/javascript">

		$("#btn-publish").click(function(e){
            e.preventDefault();
            $.ajax({
                url : "<?= site_url('verifikasi/verifikasi_member')?>",
                data : new FormData($("#insertData")[0]),
                type: 'POST',
                contentType: false,
                processData: false,
                success : function(e){
                    swal("Verified","","success");
                    window.location = "<?=site_url('verifikasi/member')?>";
                }
            });
        });

        $("#btn-tolak").click(function(e){
            e.preventDefault();
            $.ajax({
                url : "<?= site_url('verifikasi/tolak_member')?>",
                data : new FormData($("#insertData")[0]),
                type: 'POST',
                contentType: false,
                processData: false,
                success : function(e){
                    swal("Ditolak","","error");
                    window.location = "<?=site_url('verifikasi/member')?>";
                }
            });
        });

	</script>	
</body>

</html>