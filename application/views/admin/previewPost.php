    	<?php $this->load->view('_part/admin/_style')?>
	   	
	<link rel="stylesheet" href="<?= base_url('assets/')?>node_modules/html5-editor/bootstrap-wysihtml5.css" />
	<link href="<?= base_url('assets/')?>node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    	<?php $this->load->view('_part/admin/_head')?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <?php if ($dataPost->publish != 1 && $this->session->userdata('sess_admin_')):?>
                            <form id="insertData">    
                                <input type="hidden" id="postID" name="postID" value="<?= $dataPost->postID ?>">
                            </form>
                            <div class="card-header text-center">
                                <button class='hapus btn btn-success btn-md waves-effect waves-light' id='btn-publish'>Publish</button>
                                <button class='hapus btn btn-danger btn-md waves-effect waves-light' id='btn-tolak'>Tolak</button>
                            </div>
                            <?php endif;?>
                            
                            <div class="card-body">
								<h1><?= $dataPost->postJudul ?></h1>
								<small>Publish By <b>Admin</b></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="">
									<img alt="" src="<?= base_url('assets/img/post/').$dataPost->postFeaturedImage?>">
								</div>
								<small><i class="fa fa-calendar"></i> Diinsert Pada : <b><?= $dataPost->postTanggalInsert?></b></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<small><i class="fa fa-calendar"></i> Disunting Pada : <b><?= $dataPost->postTanggalUpdate ==''? '-':$dataPost->postTanggalUpdate?></b></small>
								<hr/>
								<div>
									<?= $dataPost->postKonten?>
								</div>
                            </div>
                        </div>
                    </div>
                <!-- Row -->

                    </row>
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
                url : "<?= site_url('verifikasi/publish_post')?>",
                data : new FormData($("#insertData")[0]),
                type: 'POST',
                contentType: false,
                processData: false,
                success : function(e){
                    swal("Posting Berhasil Publish","","success");
                    window.location = "<?=site_url('verifikasi/post')?>";
                }
            });
        });

        $("#btn-tolak").click(function(e){
            e.preventDefault();
            $.ajax({
                url : "<?= site_url('verifikasi/tolak_post')?>",
                data : new FormData($("#insertData")[0]),
                type: 'POST',
                contentType: false,
                processData: false,
                success : function(e){
                    swal("Posting ditolak","","success");
                    window.location = "<?=site_url('verifikasi/post')?>";
                }
            });
        });

	</script>	
</body>

</html>