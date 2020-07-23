
</head>

<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">ADMIN <?= NAMA_APLIKASI?> </p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= site_url('beranda'); ?>">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url('assets/')?>images/sclicon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?= base_url('assets/')?>images/sclicon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="<?= base_url('assets/')?>images/logo-texts.png" alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->    
                         <strong style="color:#ffffff;">Admin</strong></span></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="hidden-md-down"><strong style="color: #ffffff;"><?php if($this->session->has_userdata('sess_admin_')){ echo $this->session->sess_admin_->adminUsername;}else{echo $this->session->sess_member_->memberUsername;}?> &nbsp;<i class="fa fa-angle-down"></i></span></strong></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li><a href="<?= site_url('Auth/logout')?>"><i class="fa fa-power-off"></i> Keluar</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="<?= site_url('Dashboard/index')?>" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <?php if($this->session->has_userdata('sess_member_')):?>
                            <li> <a class="waves-effect waves-dark" href="<?= site_url('master/dataKucingMember')?>" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Data Hewan</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="<?= site_url('master/rekam-medis')?>" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Rekam Medis</span></a>
                            </li>
                            <li> <a class="waves-effect waves-dark" href="<?= site_url('master/dataKucingMember')?>" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Konsultasi</span></a>
                            </li>
                        <?php endif;?>
                        <?php if($this->session->has_userdata('sess_admin_')):?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Management</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?= site_url('master/hpr')?>">Data Hewan</a></li>
                                <li><a href="<?= site_url('master/spesies')?>">Data Spesies</a></li>
                                <li><a href="<?= site_url('master/kecamatan')?>">Data Kecamatan</a></li>
                                <li><a href="<?= site_url('desa')?>">Data Kelurahan</a></li>
                                <li><a href="<?= site_url('master/member')?>">Data Member</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Post</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?= site_url('Post/buatPost')?>">Buat Post</a></li>
                                <li><a href="<?= site_url('Post/index')?>">Data Post</a></li>
                                <li><a href="<?= site_url('Post/kategori')?>">Kategori</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Verifikasi</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?= site_url('verifikasi/hewan')?>">Hewan (HPR)</a></li>
                                <li><a href="<?= site_url('verifikasi/member')?>">Pendaftaran Member</a></li>
                                <li><a href="<?= site_url('verifikasi/post')?>">Posting</a></li>
                            </ul>
                        </li>
                        <?php endif;?>
                        <li> <a class="waves-effect waves-dark" href="<?= site_url('Auth/logout')?>" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Keluar</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>