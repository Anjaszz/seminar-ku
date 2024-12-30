<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo base_url('user/home'); ?>">
            <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" alt="SIMAS Logo" class="img-fluid" style="max-width: 150px; height: auto;">
        </a>
        <button id="profileButton" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-person-circle icon-gradient"></i>
            <span id="namaMahasiswa"><?php echo isset($nama_mahasiswa) ? explode(' ', $nama_mahasiswa)[0] : 'User'; ?></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(3) == 'profil') ? 'active' : ''; ?>" href="<?php echo base_url('user/home/profil'); ?>">
                        <i class="bi bi-person-circle icon-gradient"></i> Profil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(3) == 'index') ? 'active' : ''; ?>" href="<?php echo base_url('user/home/index'); ?>">
                        <i class="bi bi-house-door icon-gradient"></i> Beranda
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-geo-alt icon-gradient"></i> 
                        <?php 
                        // Display the selected location or default to "Semua Lokasi"
                        if (isset($_GET['id_lokasi']) && $_GET['id_lokasi'] != 0) {
                            // Find the selected location name
                            $selected_location = array_filter($lokasi_seminar, function($lokasi) {
                                return $lokasi->id_lokasi == $_GET['id_lokasi'];
                            });
                            echo !empty($selected_location) ? reset($selected_location)->nama_provinsi : 'Semua Lokasi';
                        } else {
                            echo 'Semua Lokasi';
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($lokasi_seminar as $lokasi): ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url('user/home/index?id_lokasi=' . $lokasi->id_lokasi); ?>">
                                    <?php echo $lokasi->nama_provinsi; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(3) == 'belumbayar') ? 'active' : ''; ?>" href="<?php echo base_url('user/home/belumbayar'); ?>">
                        <i class="bi bi-exclamation-circle icon-gradient"></i> Belum Bayar
                        <span class="badge badge-gradient ms-2"><?php echo $jumlah_belum_bayar; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(3) == 'terdaftar') ? 'active' : ''; ?>" href="<?php echo base_url('user/home/terdaftar'); ?>">
                        <i class="bi bi-calendar-event icon-gradient"></i> Seminar yang diikuti
                        <span class="badge badge-gradient ms-2"><?php echo $jumlah_seminar; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(3) == 'file') ? 'active' : ''; ?>" href="<?php echo base_url('user/home/file'); ?>">
                        <i class="bi bi-folder icon-gradient"></i> File/Modul
                        <span class="badge badge-gradient ms-2"><?php echo $jumlah_history; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(3) == 'seminar_history') ? 'active' : ''; ?>" href="<?php echo base_url('user/home/seminar_history'); ?>">
                        <i class="bi bi-clock-history icon-gradient"></i> History Seminar
                        <span class="badge badge-gradient ms-2"><?php echo $jumlah_history; ?></span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('user/auth'); ?>">
                        <i class="bi bi-box-arrow-right icon-gradient"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
