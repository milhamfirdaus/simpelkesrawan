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
                <div id="alert">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Info : </strong> Data yang ditampilkan pada halaman ini merupakan data hewan yang di input oleh member dan harus di verifikasi sebelum ditampilkan pada halaman geoanimal.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <div>

                <div class="row">
                <!-- Row -->

                <!-- Row -->
                    <div class="col-lg-12">
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
                                                        <th>Nama Hewan</th>
                                                        <th>Spesies</th>
                                                        <th>Oleh / Pemilik</th>
                                                        <th>Status</th>
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
              url: "<?php echo site_url('verifikasi/vDataTableHewan') ?>",
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
    </script>   
</body>

</html>