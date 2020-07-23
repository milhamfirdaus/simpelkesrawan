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
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <button id="btn-tambah" class="btn btn-success"> Tambah</button>
                            <button style="display: none;" id="btn-batal" type="reset" class="btn btn-danger">Batal</button>
                        </div>
                    </div>

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

                    <div class="col-lg-12" id="form" style="display: none;">
                        <div class="card">
                            <div class="card-body">
                                <form id="insertData">
                                    <div class="form-body">
                                        <h3 class="card-title">Tambah Data <?= $page?></h3>
                                        <hr>
                                        
                                        <input type="hidden" id="memberID" name="memberID" class="form-control" value="">
                                        <div class="form-row" style="margin-left:12px; margin-right:12px;">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">NIK</label>
                                                    <input type="text" id="memberNIK" name="memberNIK" class="form-control form-control-sm" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nama Lengkap</label>
                                                    <input type="text" id="memberNama" name="memberNama" class="form-control form-control-sm" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Jenis Kelamin</label>
                                                    <select name="memberJK" id="memberJK" class="form-control form-control-sm">
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="J">Laki-laki</option>
                                                        <option value="B">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label class="control-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="memberTTL" name="memberTTL">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row" style="margin-left:12px; margin-right:12px;">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Alamat</label>
                                                        <input type="text" id="memberAlamat" name="memberAlamat" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3" >
                                                    <div class="form-group">
                                                        <label class="control-label">Kecamatan</label>
                                                        <select name="memberKecamatan" id="memberKecamatan" class="form-control form-control-sm">
                                                            <option value="">Pilih Kecamatan</option>
                                                            <?php foreach ($data_kecamatan as $d):?>
                                                            <option value="<?= $d->kecamatanID?>"><?= $d->kecamatanNama?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Desa</label>
                                                        <select name="memberDesa" id="memberDesa" class="form-control form-control-sm" disabled>
                                                            <option value=""> Pilih Desa </option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-row" style="margin-left:12px; margin-right:12px;">
                                            <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label class="control-label">No HP</label>
                                                        <input type="text" id="memberHandphone" name="memberHandphone" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3" >
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="email" id="memberEmail" name="memberEmail" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Username</label>
                                                        <input type="text" id="memberUsername" name="memberUsername" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label>
                                                        <input type="password" id="memberPassword" name="memberPassword" class="form-control form-control-sm" placeholder="">
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-actions text-center" style="margin-top:20px">
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
			  url: "<?php echo site_url('Master/dataMember') ?>",
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

		$("#btn-update").click(function(e){
			e.preventDefault();
            $("#form").show();
            $("#table").hide();

			$.ajax({
				url : "<?= site_url('Master/updateMember')?>",
				data : new FormData($("#insertData")[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					swal("Update Data Success","","success");
                    clearall();
					location.reload();
				}
			});
		});

		$(document).on("click",".edit",function(e){
			e.preventDefault();
    		var id = $(this).attr("data-id");
    		$.ajax({
				url : "<?= site_url('Master/getIDMember')?>",
				data : {memberID:id},
				type: 'POST',
				success : function(e){
					var Obj = JSON.parse(e);
                    $("#form").show();
                    $("#table").hide();
					$("select option").removeAttr("selected","selected");
					$("#memberID").val(Obj.memberID);
                    $("#memberNIK").val(Obj.memberNIK);
					$("#memberNama").val(Obj.memberNamaLengkap);
                    $("#memberJK [value="+Obj.memberJenisKelamin+"]").attr("selected","selected");
                    $("#memberTTL").val(Obj.memberTTL);
                    $("#memberAlamat").val(Obj.memberAlamat);
                    $("#memberKecamatan [value="+Obj.parent_id+"]").attr("selected","selected");
					$("#memberDesa [value="+Obj.desaID+"]").attr("selected","selected");
                    $("#memberHandphone").val(Obj.memberHandphone);
                    $("#memberEmail").val(Obj.memberEmail);
                    $("#memberUsername").val(Obj.memberUsername).attr('readonly');
					$("#btn-update").show();
					$("#btn-cancel").show();
					$("#btn-submit").hide();
				}
			});
		});

		$("#btn-cancel").click(function(e){
			e.preventDefault();
            $("#form").hide();
            $("#table").show();

			$(this).hide();
			$("#btn-submit").show();
			$("#btn-reset").trigger("click");
    		$("#btn-cancel").hide();
			$("#btn-update").hide();
            clearall();
		});

        $("#btn-tambah").click(function(e){
            e.preventDefault();
            $(this).hide();
            $("#btn-batal").show();
            $("#form").show();
            $("#table").hide();
            clearall();
        });

        $("#btn-batal").click(function(e){
            e.preventDefault();
            $(this).hide();
            $("#btn-tambah").show();
            $("#form").hide();
            $("#table").show();
            clearall();
        });

		$("#insertData").submit(function(e){
			e.preventDefault();
            $("#form").hide();
            $("#table").show();
			$.ajax({
				url : "<?= site_url('Master/insertmember')?>",
				data : new FormData($(this)[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					if(e=="1"){
						swal("Insert Data Berhasil","","success");
                        $("#form").hide();
                        $("#table").show();
    					location.reload();
                        clearall();
					}else{
						swal("Insert Data Gagal!","","error");
					}
				}
			});
		});

        $("#memberKecamatan").change(function(){
            var id = $(this).val();
            if (id == ""){
               $("#memberDesa").attr("disabled", true); 
               $("#memberDesa").val(""); 
            }
            else{
                $.ajax({
                    url : "<?= site_url('Desa/getByKecamatan')?>",
                    data : {kecamatan:id},
                    dataType: 'json',
                    type: 'POST',
                    success : function(response){
                        $('#memberDesa option').remove();
                        $("#memberDesa").attr("disabled", false); 
                        if(response.data_desa){
                            $.each(response.data_desa, function(key, value){
                                $("#memberDesa").append('<option value=' + value.desaID + '>' + value.namaDesa + '</option>');
                            });
                        }
                    }
                });
            }
        });

        function clearall(){
            $("#memberDesa").attr("disabled", true); 
            $('#form').find("input[list], input[type=number], input[type=text], input[type=hidden], input[type=password], input[type=email], textarea, select").val("").prop('readonly', false);
        }
        
	</script>
</body>

</html>