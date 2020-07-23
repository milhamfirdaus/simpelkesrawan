<footer>
    <div class="container">
        <div class="row">
                        <div class="textwidget"><div class="col-md-4 col-sm-12">
                <h3>Bidang Peternakan dan Kesehatan Hewan.</h3>
                <p>Dinas Ketahanan Pangan, Pertanian dan Perikanan Kota Sukabumi.</p>
                <p><img src="<?= site_url('assets/user/')?>img/kesrawan.png" alt="img" class="hidden-xs" width="170" height="30" data-retina="true">
                </p>
            </div></div>
                                <div class="textwidget"><div class="col-md-3 col-sm-4">
                <h3>Halaman</h3>
                <ul>
                    <li><a href="<?= site_url('geoanimal')?>">Geoanimal</a>
                    </li>
                    <li><a href="<?= site_url('informasi')?>">Informasi</a>
                    </li>
                    <li><a href="<?=is_login_link();?>"><?=is_login_print();?></a>
                    </li>
                </ul>
            </div></div>
                                
                <div class="textwidget"><div class="col-md-3 col-sm-4" id="newsletter">
                <h3>Cari Informasi</h3>
                <form action="<?=site_url('informasi');?>" method="post">
                    <div class="form-group">
                        <input name="search" id="search" type="text" value="" placeholder="Cari ..." class="form-control">
                    </div>
                    <p>
                        <button class="button" type="submit">Cari</button>
                    </p>
                </form>
            </div></div>
                                
                </div>
        <!-- End row -->
        <hr>
        <div class="row">
            <div class="col-sm-6">© 2019 SIMPEL KESRAWAN | All Rights Reserved.</div>
            <div class="col-sm-6">
                <div id="social_footer">
                    <ul>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-google"></i></a></li>
                        <li><a href="#"><i class="icon-instagram"></i></a></li>             
                    </ul>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</footer>