<nav class="pcoded-navbar menupos-fixed ">
    <div class="navbar-wrapper ">
    <div class="navbar-brand header-logo">
            <a href="#" class="b-brand">
                <div class="b-bg">
                    <img src="<?php echo base_url('assets/images/fav.png'); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                </div>
                <span class="b-title"><?php echo isset($nama_vendor) ? $nama_vendor : 'SIMAS'; ?></span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Menu Navigasi</label>
                </li>
                <li data-username="home" class="nav-item"><a href="<?= site_url('home') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Data Peserta</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('pendaftaran') ?>" class="">Peserta Terdaftar</a></li>
                        <li class=""><a href="<?= site_url('fakultas') ?>" class="">Data Per Departemen</a></li>
                        <li class=""><a href="<?= site_url('prodi') ?>" class="">Data Per Jurusan</a></li>
                    </ul>
                </li>
                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-mic"></i></span><span class="pcoded-mtext">Data Seminar</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('seminar') ?>" class="">Data Seminar</a></li>
                        <li class=""><a href="<?= site_url('tiket') ?>" class="">Data Tiket</a></li>
                        <li class=""><a href="<?= site_url('pembicara') ?>" class="">Data Pembicara</a></li>
                        <li class=""><a href="<?= site_url('sponsor') ?>" class="">Data Sponsor</a></li>
                    </ul>
                </li>
                
                
                <li data-username="animations" class="nav-item"><a href="<?= site_url('scan') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Scan Presensi</span></a></li>

                <li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Laporan dan Cetak</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('laporan/peserta') ?>" class="">Peserta Seminar</a></li>
                        <li class=""><a href="<?= site_url('laporan') ?>" class="">Presensi Seminar</a></li>
                        <li class=""><a href="<?= site_url('laporankeuangan') ?>" class="">Keuangan</a></li>
                    </ul>
                </li>
                <li data-username="animations" class="nav-item"><a href="<?= site_url('laporan') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Laporan Presensi</span></a></li>
                <li data-username="animations" class="nav-item"><a href="<?= site_url('laporankeuangan') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Laporan Keuangan</span></a></li>

                <!-- Navbar Sertifikat dan File -->
                <li data-username="uploads" class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Upload</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="<?= site_url('sertifikat') ?>" class="">Upload Sertifikat</a></li>
                        <li class=""><a href="<?= site_url('file') ?>" class="">Upload File</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
