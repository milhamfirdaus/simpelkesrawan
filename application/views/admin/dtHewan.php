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
                        <h3 class="text-themecolor"><?= $page?></h3>
                    </div>
                </div>
                <div id="alert">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Info : </strong> Data yang di input / ditampilkan pada halaman ini adalah data hewan yang telah terverifikasi.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form id="insertData">
                                    <div class="form-body">
                                        <h3 class="card-title">Tambah Data <?= $page?></h3>
                                        <hr>
                                        <input type="hidden" id="hewanID" name="hewanID" class="form-control" value="">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Nama hewan</label>
                                                <input type="text" id="hewanNama" name="hewanNama" class="form-control form-control-sm" placeholder="Nama Hewan">
                                                </div>
                                        </div>  
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Pemilik</label>
                                                 <input list="browsers" id="pemilik" name="pemilik" class="form-control form-control-sm" placeholder="Nama Pemilik">
                                                 <small class="form-text">* Kosongkan jika tidak diketahui pemiliknya.</small>
                                                    <datalist id="browsers">
                                                        <?php foreach ($data_member as $d):?>
                                                        <option value="<?= $d->memberID?>">[<?= $d->memberID?>] <?= $d->memberNamaLengkap?></option>
                                                        <?php endforeach;?>
                                                    </datalist> 
                                            </div>
                                        </div>

                                        <div class="form-row" style="margin-left:12px; margin-right:12px;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Jenis Kelamin</label>
                                                    <select name="hewanJK" id="hewanJK" class="form-control form-control-sm">
                                                        <option value="J">Jantan</option>
                                                        <option value="B">Betina</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Spesies</label>
                                                    <select name="hewanSpesies" id="hewanSpesies" class="form-control form-control-sm">
                                                        <?php foreach ($data_spesies as $d):?>
                                                        <option value="<?= $d->spesiesID?>"><?= $d->spesiesNama?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row" style="margin-left:12px; margin-right:12px;">
                                                <div class="col-sm-6" >
                                                    <div class="form-group">
                                                        <label class="control-label">Kecamatan</label>
                                                        <select name="hewanKecamatan" id="hewanKecamatan" class="form-control form-control-sm" placeholder="Pilih Kecamatan">
                                                            <option value=""> Pilih Kecamatan </option>
                                                            <?php foreach ($data_kecamatan as $d):?>
                                                            <option value="<?= $d->kecamatanID?>"><?= $d->kecamatanNama?></option>
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Kelurahan</label>
                                                        <select name="hewanDesa" id="hewanDesa" class="form-control form-control-sm">
                                                            <option value=""> Pilih Kelurahan </option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        
                                        <div class="col-md-12" hidden>
                                            <div class="form-group">
                                                <label class="control-label">Keterangan</label>
                                                <textarea class="form-control" rows="" cols="" name="hewanKeterangan" id="hewanKeterangan"></textarea>
                                            </div>
                                        </div>

                                    	<div class="form-group col-md-12">
                                    	<div id="map" class="" style="height: 240px;margin-bottom: 23px;"></div>
                                        </div>
                                    	<div class="form-group col-md-12" hidden>
                                        <input type="text" name="lat" class="form-control col-md-5 col-sm-push-4" id="cordinate_b" placeholder="Lat">
                                        <input type="text" name="lng" class="form-control col-md-5" id="cordinate_a" placeholder="Lng"> 
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="file" data-provide="dropify" name="filefoto" id="filefoto" data-default-file="" class="dropify col-md-12">
                                            <input type="hidden" name="old_foto" id="old_foto">
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
                                    <div class="form-body">
                                        <h3 class="card-title">Data <?= $page?></h3>
                                        <hr>
                                    	<div class="table-responsive">
                                            <table id="demo-foo-addrow" class="display nowrap table table-hover" data-page-size="10">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Spesies</th>
                                                        <th>Oleh</th>
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
    <script src="<?= base_url('assets/')?>node_modules/dropify/dist/js/dropify.min.js"></script>
    <script src="<?= site_url('assets/ckeditor')?>/ckeditor.js"></script>
		<script type="text/javascript">
		$('textarea').each(function(){
			CKEDITOR.replace(this.name);
		});
		 $('.dropify').dropify({
            messages: {
                default: 'Drag atau drop untuk memilih gambar',
                replace: 'Ganti',
                remove:  'Hapus',
                error:   'error'
            }
        });
		 mapboxgl.accessToken = 'pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog';
         var map = new mapboxgl.Map({
             container: 'map', // container id
             style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
             center: [106.92667,-6.91806], // starting position [lng, lat]
             zoom: 13, // starting zoom
             logoPosition:'top-right',
         });
         
         var marker = new mapboxgl.Marker({
             draggable: true
         })
             .setLngLat([106.92667,-6.91806])
             .addTo(map);
         function onDragEnd() {
             var lngLat = marker.getLngLat();
             
             var a = lngLat.lng;
             var b = lngLat.lat;
             $("#cordinate_a").val(a);
             document.getElementById("cordinate_b").value = b; 
         }
         
         marker.on('dragend', onDragEnd);

		
	 	$("#demo-foo-addrow").DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			ordering: false,
			processing: true,
			serverSide: true,
			ajax: {
			  url: "<?php echo site_url('Master/getHewan') ?>",
			  type:'POST'
			}
		});
		$(document).on("click",".hapus",function(e){
			e.preventDefault();
    		var id = $(this).attr("data-id");
    		var gambar = $(this).attr("gambar-nama");
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
					url : "<?= site_url('Master/deleteHewan')?>",
					data : {id:id,gambar:gambar},
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
			$("#hewanKeterangan").text(CKEDITOR.instances.hewanKeterangan.getData());
			$.ajax({
				url : "<?= site_url('Master/updateHewan')?>",
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
    		$.ajax({
				url : "<?= site_url('Master/getHewanID')?>",
				data : {hewanID:id},
				type: 'POST',
				success : function(e){
					var Obj = JSON.parse(e);
					$("select option").removeAttr("selected","selected");
                    $("#pemilik").val(Obj.memberID);
					$("#hewanID").val(Obj.hewanID);
	                $("#old_foto").val(Obj.hewanGambar);
	                $('.dropify').attr('data-default-file',"<?= base_url('assets/img/')?>"+Obj.hewanGambar);
	                $('.dropify').dropify();
					$("#hewanNama").val(Obj.hewanNama);
					$("#hewanKeterangan").text(CKEDITOR.instances.hewanKeterangan.setData(Obj.hewanKeterangan));
					$("#cordinate_b").val(Obj.hewanLat);
					$("#cordinate_a").val(Obj.hewanLng);
					$("#hewanKecamatan [value="+Obj.parent_id+"]").attr("selected","selected");
					$("#hewanDesa [value="+Obj.desaID+"]").attr("selected","selected");
					$("#hewanSpesies [value="+Obj.spesiesID+"]").attr("selected","selected");
					$("#hewanJK [value="+Obj.hewanJenisKelamin+"]").attr("selected","selected");
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
			$("#hewanKeterangan").text(CKEDITOR.instances.hewanKeterangan.getData());
			$.ajax({
				url : "<?= site_url('Master/inserthewan')?>",
				data : new FormData($(this)[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					if(e=="1"){
						swal("Insert Data Berhasil","","success");
    					$('#demo-foo-addrow').DataTable().ajax.reload();
					}else{
						alert(e);
					}
				}
			});
		});

        $("#hewanKecamatan").change(function(){
    		var id = $(this).val();
    		$.ajax({
				url : "<?= site_url('Desa/getByKecamatan')?>",
				data : {kecamatan:id},
                dataType: 'json',
				type: 'POST',
				success : function(response){
                    $('#hewanDesa option').remove();
                    if(response.data_desa != ""){
                        $.each(response.data_desa, function(key, value){
                            $("#hewanDesa").append('<option value=' + value.desaID + '>' + value.namaDesa + '</option>');
                        });
                    }
                    else{
                        $("#hewanDesa").append('<option value="">Pilih Kelurahan</option>');
                    }
				}
			});
		});

	</script>
</body>

</html>