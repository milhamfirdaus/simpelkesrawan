    	<?php $this->load->view('_part/admin/_style')?>
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
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor"><?= $page?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form id="insertData">
                                    <div class="form-body">
                                        <h3 class="card-title">Tambah <?= $page?> Baru</h3>
                                        <hr>
                                        <input type="hidden" id="kecamatanID" name="kecamatanID" class="form-control" value="">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Kecamatan</label>
                                                <input type="text" id="kecamatanNama" name="kecamatanNama" class="form-control form-control-sm" placeholder="">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button id="btn-submit" type="submit" class="btn btn-success"> Save</button>
                                                <button style="display: none;" id="btn-update" type="submit" class="btn btn-success"> Update</button>
                                                <button id="btn-reset" type="reset" class="btn btn-inverse">Reset</button>
                                                <button style="display: none;" id="btn-cancel" type="reset" class="btn btn-danger"> Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- Row -->

                <!-- Row -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form id="insertData">
                                    <div class="form-body">
                                        <h3 class="card-title">Data <?= $page?></h3>
                                        <hr>
                                    	<div class="table-responsive">
                                            <table id="demo-foo-addrow" class="display nowrap table table-hover" data-page-size="10">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kecamatan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dt_tab">
                                                    
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
		<script type="text/javascript">
	 	$("#demo-foo-addrow").DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			ordering: false,
			processing: true,
			serverSide: true,
			ajax: {
			  url: "<?php echo site_url('Master/gDataTableKecamatan') ?>",
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
					url : "<?= site_url('Master/deleteKecamatan')?>",
					data : {kecamatanID:id},
					type: 'POST',
					success : function(e){
						swal("Hapus Data Berhasil","","success");
						$('#demo-foo-addrow').DataTable().ajax.reload();
						$("#btn-cancel").trigger("click");
					}
				});
			});
		});
		$("#btn-update").click(function(e){
			e.preventDefault();
			$.ajax({
				url : "<?= site_url('Master/updateKecamatan')?>",
				data : new FormData($("#insertData")[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					swal("Update Data Success","","success");
					$('#demo-foo-addrow').DataTable().ajax.reload();
				}
			});
		});
		$(document).on("click",".edit",function(e){
			e.preventDefault();
    		var id = $(this).attr("data-id");
    		console.log(id);
    		$.ajax({
				url : "<?= site_url('Master/getIDKecamatan')?>",
				data : {kecamatanID:id},
				type: 'POST',
				success : function(e){
					var Obj = JSON.parse(e);
					$("#kecamatanID").val(Obj.kecamatanID);
					$("#kecamatanNama").val(Obj.kecamatanNama);
					$("#btn-update").show();
					$("#btn-cancel").show();
					$("#btn-submit").hide();
				}
			});
		});
		$("#btn-cancel").click(function(e){
			e.preventDefault();
			$(this).hide();
			$("#btn-submit").show();
			$("#btn-reset").trigger("click");
    		$("#btn-cancel").hide();
			$("#btn-update").hide();
		});
		$("#insertData").submit(function(e){
			e.preventDefault();
			$.ajax({
				url : "<?= site_url('Master/insertKecamatan')?>",
				data : new FormData($(this)[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					if(e=="1"){
						swal("Insert Data Berhasil","","success");
    					$('#demo-foo-addrow').DataTable().ajax.reload();
					}else{
						var msg = JSON.parse(e);
						alert(e);
					}
				}
			});
		});
	</script>
</body>

</html>