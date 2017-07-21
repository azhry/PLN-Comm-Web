<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?= base_url('assets/images/user.png') ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
                    <div class="email">john.doe@example.com</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="seperator" class="divider"></li> -->
                            <li><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="<?= base_url('admin') ?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/artikel') ?>">
                            <i class="material-icons">art_track</i>
                            <span>Artikel</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/karyawan') ?>">
                            <i class="material-icons">people</i>
                            <span>Karyawan</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people_outline</i>
                            <span>Dosen</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?= base_url('admin/dosen') ?>">Data Dosen</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/buku') ?>">Buku</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/mata_kuliah') ?>">Mata Kuliah</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/penelitian') ?>">Penelitian</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/publikasi') ?>">Publikasi</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/seminar') ?>">Seminar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.4
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->