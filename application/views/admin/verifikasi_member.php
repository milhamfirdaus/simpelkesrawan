        <?php $this->load->view('_part/admin/_style')?>
        <style>
<!--
.cke_textarea_inline {
            border: 1px solid #ced4da;
            margin: 1px;
            padding:4px;
            border-radius : 3px;
        }
        #insertSoal{
            font-size: 15px;
        }
-->
</style>
        
    <!-- Mapbox core js -->
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css' rel='stylesheet' />
    <link href="<?= base_url('assets/')?>node_modules/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/')?>node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css">
        
        <?php $this->load->view('_part/admin/_head')?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Data Member</h3>
                    </div>
                </div>

                <div id="alert">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Info : </strong> Data yang ditampilkan pada halaman ini merupakan data member yang mendaftar.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <div>

                <div class="row">

                    <div class="col-lg-12" id="table" >
                        <div class="card">
                            <div class="card-body">
                                    <div class="form-body">
                                        <h3 class="card-title">Data Member</h3>
                                        <hr>
                                        <div class="table-responsive">
                                            <table id="demo-foo-addrow" class="display nowrap table table-hover" data-page-size="10">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th width="15%">NIK</th>
                                                        <th width="10%">Nama</th>
                                                        <th width="50%">Handphone</th>
                                                        <th width="10%">Kecamatan</th>
                                                        <th width="10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dt_tab">
                                                    
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
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
    <script src="<?= base_url('assets/')?>node_modules/dropify/dist/js/dropify.min.js"></script>
    <script src="<?= site_url('assets/ckeditor')?>/ckeditor.js"></script>
		<script type="text/javascript">
		
	 	$("#demo-foo-addrow").DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			ordering: false,
			processing: true,
			serverSide: true,
			ajax: {
			  url: "<?php echo site_url('verifikasi/vDataMember') ?>",
			  type:'POST'
			}
		});

		$(document).on("click",".hapus",function(e){
			e.preventDefault();
    		var id = $(this).attr("data-id");
    		swal({
			title:"Konfirmasi",
			text:"Yakin akan menghapus data ini ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Ya",
			cancelButtonText: "Tidak",
			closeOnConfirm: true,
			},
			function(){
				$.ajax({
					url : "<?= site_url('Master/deleteMember')?>",
					data : {memberID:id},
					type: 'POST',
					success : function(e){
						swal("Hapus Data Berhasil","","success");
						$('#demo-foo-addrow').DataTable().ajax.reload();
						$("#btn-cancel").trigger("click");
					}
				});
			});
		});
        
	</script>
</body>

</html>