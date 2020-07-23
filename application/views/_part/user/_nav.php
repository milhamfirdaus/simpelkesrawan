<div class="col--md-4 col-sm-3 col-xs-4">
                    <a href="<?= site_url()?>" id="logo"><img src="<?= site_url('assets/user/')?>img/kesrawan.png" alt="" data-retina="true">
                    </a>
                </div>
   <nav class="col--md-8 col-sm-9 col-xs-8">
             
                    <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                    <div class="main-menu">
                        <div id="header_menu">
                            <img src="<?= site_url('assets/user/')?>img/kesrawan.png" alt="img" data-retina="true" width="170" height="30">
                        </div>
                        <a href="#" class="open_close" id="close_in"><i class="arrow_left"></i></a>
                        <ul>
                            <li>
                                <a href="<?= site_url()?>" class="show-submenu" style="color: #33b5ff;"><b>Portal</b></a>
                            </li>
                            <li class="active">
                                <a href="<?= site_url('beranda')?>" class="show-submenu"><strong>Beranda</strong></a>
                            </li>
                            <li id="menu-item-259" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-ancestor current-menu-parent menu-item-has-children menu-item-259 default_dropdown default_style drop_to_right submenu_default_width columns1">
                                <a href="#" class="item_link  disable_icon" tabindex="6">
                                    <i class=""></i> 
                                    <span class="link_content">
                                        <span class="link_text">
                                            <strong>Peta</strong>
                                        </span>
                                    </span>
                                </a>
                                <ul class="mega_dropdown">
                                <li id="menu-item-263" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-263 default_dropdown default_style drop_to_right submenu_default_width columns1">
                                    <a href="<?= site_url('geoanimal')?>" class="item_link  disable_icon" tabindex="7">
                                        <i class=""></i> 
                                        <span class="link_content">
                                            <span class="link_text">
                                                Geoanimal
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li id="menu-item-263" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-263 default_dropdown default_style drop_to_right submenu_default_width columns1">
                                    <a href="http://simpelkesrawan.sukabumikota.go.id/frontend/map" class="item_link  disable_icon" tabindex="7">
                                        <i class=""></i> 
                                        <span class="link_content">
                                            <span class="link_text">
                                                Sistem Informasi Geografis
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                </ul><!-- /.mega_dropdown -->
                            </li>
                            <li>
                                <a href="<?= site_url('informasi')?>" class="show-submenu"><strong>Informasi</strong></a>
                            </li>
                            <li><a href="<?=is_login_link();?>"><strong><?=is_login_print();?></strong></a></li>
                        </ul>
                    </div>
                    <!-- End main-menu -->
                </nav>