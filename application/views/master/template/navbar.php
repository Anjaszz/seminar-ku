```html
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
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Menu Navigasi</label>
                </li>
                <li data-username="home" class="nav-item">
                    <a href="<?= site_url('master/home') ?>" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-grid"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">Manajemen Peserta</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="<?= site_url('mahasiswa') ?>">Peserta Terdaftar</a></li>
                        <li><a href="<?= site_url('fakultas') ?>">Data Per Departemen</a></li>
                        <li><a href="<?= site_url('prodi') ?>">Data Per Jurusan</a></li>
                    </ul>
                </li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-briefcase"></i></span>
                        <span class="pcoded-mtext">Manajemen Vendor</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="<?= site_url('master/vendor') ?>">Data Vendor</a></li>
                        <li><a href="<?= site_url('master/vendor/vendor_aktif') ?>">Data Vendor Aktif</a></li>
                        <li><a href="<?= site_url('master/vendor/vendor_nonaktif') ?>">Data Vendor Nonaktif</a></li>
                    </ul>
                </li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                        <span class="pcoded-mtext">Laporan dan Cetak</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li><a href="<?= site_url('master/laporan/keuangan') ?>">Data Keuangan</a></li>
                        <li><a href="<?= site_url('master/laporan/peserta') ?>">Data Peserta</a></li>
                        <li><a href="<?= site_url('master/laporan/vendor') ?>">Data Vendor</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
```