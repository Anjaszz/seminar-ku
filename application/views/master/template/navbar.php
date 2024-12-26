<nav class="pcoded-navbar menupos-fixed ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="#" class="b-brand">
                <div class="b-bg">
                    <img src="<?php echo base_url('assets/images/fav.png'); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                </div>
                <span class="b-title">SIMAS</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Menu Navigasi</label>
                </li>
                <li data-username="home" class="nav-item"><a href="<?= site_url('master/home') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Manajemen Peserta</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('mahasiswa') ?>" class="">Peserta Terdaftar</a></li>
                        <li class=""><a href="<?= site_url('fakultas') ?>" class="">Data Per Departemen</a></li>
                        <li class=""><a href="<?= site_url('prodi') ?>" class="">Data Per Jurusan</a></li>
                    </ul>
                </li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Manajemen Vendor</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('master/vendor') ?>" class="">Data Vendor</a></li>
                        <li class=""><a href="<?= site_url('master/vendor/vendor_aktif') ?>" class="">Data Vendor Aktif</a></li>
                        <li class=""><a href="<?= site_url('master/vendor/vendor_nonaktif') ?>" class="">Data Vendor Nonaktif</a></li>
                        
                    </ul>
                </li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-mic"></i></span><span class="pcoded-mtext">Laporan dan Cetak</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('master/laporan/keuangan') ?>" class="">Data Keuangan</a></li>
                        <li class=""><a href="<?= site_url('master/laporan/peserta') ?>" class=""> Data Peserta</a></li>
                        <li class=""><a href="<?= site_url('master/laporan/vendor') ?>" class=""> Data Vendor</a></li>
            
                    </ul>
                </li>
                
                
            </ul>
        </div>
    </div>
</nav>
