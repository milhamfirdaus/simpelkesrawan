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
                                        <h3 class="card-title"><?= $page?> Baru</h3>
                                        <hr>
                                        <div class="col-md-12">
                                        	<input type="hidden" id="postID" name="postID" value="<?= $dataPost->postID ?>">
                                            <div class="form-group">
                                                <label class="control-label">Judul</label>
                                                <input type="text" id="postJudul" name="postJudul" class="form-control form-control-sm" placeholder="" value="<?= $dataPost->postJudul ?>">
                                            </div>
                                          <div class="form-group">
                                                <label class="control-label">Feature Image</label>
                                                <input data-provide="dropify" type="file" data-default-file="<?= base_url('assets/img/post/').$dataPost->postFeaturedImage ?>" id="feauredImage" name="featuredImage" class="featuredImage">
                                                <input type="hidden" name="old_foto" value="<?= $dataPost->postFeaturedImage;?>">
                                            </div>
                                            <div class="form-group">
                                            	<textarea name="postKonten" id="postKonten" class="form-control ckeditor" rows="15" placeholder="Enter text ..."><?= $dataPost->postKonten ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Kategori</label>
                                                <select id="kategori" name="kategori" class="form-control col-md-4">
                                                <?php foreach ($kategori as $kat):?>
                                                	<option <?php echo $kat->kategoriID==$dataPost->kategori?'selected="selected"':'' ?> value="<?= $kat->kategoriID?>"><?= $kat->kategoriNama?></option>
                                            	<?php endforeach;?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Link Video (Youtube)</label>
                                                <input type="text" id="postYoutube" name="postYoutube" class="form-control form-control-sm" placeholder="" value="<?= $dataPost->video ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button id="btn-update" type="submit" class="btn btn-success"> Update</button>
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
    <script src="<?= base_url('assets/')?>node_modules/datatables/jquery.dataTables.min.js"></script>
     <!-- This is sweet alert -->
 	<script src="<?= base_url('assets/')?>node_modules/dropify/dist/js/dropify.min.js"></script>
    <script src="<?= base_url('assets/')?>node_modules/sweetalert/sweetalert.min.js"></script>
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="<?= base_url('assets/')?>node_modules/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="<?= base_url('assets/')?>node_modules/html5-editor/bootstrap-wysihtml5.js"></script>
    <script src="<?= site_url('assets/ckeditor')?>/ckeditor.js"></script>
		<script type="text/javascript">
		$('.featuredImage').dropify({
            messages: {
                default: 'Drag atau drop untuk memilih Featured Image',
                replace: 'Ganti',
                remove:  'Hapus',
                error:   'error'
            }
        });
		$('textarea').each(function(){
			CKEDITOR.replace(this.name);
		});
		$("#insertData").submit(function(e){
			e.preventDefault();
			$("#postKonten").text(CKEDITOR.instances.postKonten.getData());
			$.ajax({
				url : "<?= site_url('Post/updatePost')?>",
				data : new FormData($(this)[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					swal("Update Data Success","","success");
					location.reload(); 
				}
			});
		});
	</script>	
</body>

</html>