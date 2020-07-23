    	<?php $this->load->view('_part/admin/_style')?>
	   	
	<link rel="stylesheet" href="<?= base_url('assets/')?>node_modules/html5-editor/bootstrap-wysihtml5.css" />
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
                        <h3 class="text-themecolor"><?= $page?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="insertData">
                                    <div class="form-body">
                                        <h3 class="card-title">Tambah <?= $page?> Baru</h3>
                                        <hr>
                                        <input type="hidden" id="postID" name="postID" class="form-control" value="">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Judul</label>
                                                <input type="text" id="postJudul" name="postJudul" class="form-control form-control-sm" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Feature Image</label>
                                                <input data-provide="dropify" type="file" data-default-file="<?= base_url('assets/gambar/default_featuredImage.jpg')?>" id="feauredImage" name="featuredImage" class="featuredImage">
                                            </div>
                                            <br/>
                                            <div class="form-group">
                                            	<textarea name="postKonten" id="postKonten" rows="15" placeholder="Enter text ..."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Kategori</label>
                                                <select name="kategori" id="kategori" class="form-control col-md-4">
                                                <?php foreach ($kategori as $kat):?>
                                                	<option value="<?= $kat->kategoriID?>"><?= $kat->kategoriNama?></option>
                                            	<?php endforeach;?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Link Video (Youtube)</label>
                                                <input type="text" id="postYoutube" name="postYoutube" class="form-control form-control-sm" placeholder="">
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
	<script src="<?= base_url('assets/')?>node_modules/dropify/dist/js/dropify.min.js"></script>
    <script src="<?= base_url('assets/')?>node_modules/datatables/jquery.dataTables.min.js"></script>
     <!-- This is sweet alert -->
    <script src="<?= base_url('assets/')?>node_modules/sweetalert/sweetalert.min.js"></script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="<?= base_url('assets/')?>node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="<?= base_url('assets/')?>node_modules/html5-editor/bootstrap-wysihtml5.js"></script>
 	<script src="<?= site_url('assets/ckeditor')?>/ckeditor.js"></script>
    <script src="<?= site_url('assets/js')?>/responsive-ckeditor.js"></script>
    
		<script type="text/javascript">
		$('.featuredImage').dropify({
            messages: {
                default: 'Drag atau drop untuk memilih Featured Image',
                replace: 'Ganti',
                remove:  'Hapus',
                error:   'error'
            }
        });
		CKEDITOR.replace('postKonten');
		$("#kontenHidden").val(CKEDITOR.instances.postKonten.getData());
	 	$("#demo-foo-addrow").DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			ordering: false,
			processing: true,
			serverSide: true,
			ajax: {
			  url: "<?php echo site_url('Post/gDataTablePost') ?>",
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
					url : "<?= site_url('Post/deletePost')?>",
					data : {postID:id},
					type: 'POST',
					success : function(e){
						swal("Hapus Data Berhasil","","success");
						$('#demo-foo-addrow').DataTable().ajax.reload();
						$("#btn-cancel").trigger("click");
					}
				});
			});
		});
		$("#insertData").submit(function(e){
			e.preventDefault();
			$("#postKonten").text(CKEDITOR.instances.postKonten.getData());
			$.ajax({
				url : "<?= site_url('Post/insertPost')?>",
				data : new FormData($(this)[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					if(e=="1"){
						swal("Insert Data Berhasil","","success");
						window.location = "<?= site_url('Post') ?>";
					}else{
						alert(e);
					}
				}
			});
		});
	</script>	
</body>

</html>