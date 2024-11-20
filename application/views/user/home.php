<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <style>
        /* Styling untuk efek typing tanpa garis */
        .typing-effect {
            font-weight: bold; /* Menebalkan teks */
            color: white; /* Warna teks putih */
            font-size: 1.25rem; /* Ukuran font */
            white-space: nowrap; /* Teks tidak membungkus ke baris baru */
            overflow: hidden; /* Sembunyikan teks yang belum ditampilkan */
        }
        .card {
            border-radius: 2px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .icon:hover {
            color: #0056b3;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease;
        }
        .popup-overlay.show {
            display: flex;
            opacity: 1;
        }
        .popup-content {
            background: #fff;
            padding: 2px;
            border-radius: 1px;
            position: relative;
            max-width: 90%;
            max-height: 90%;
            overflow: auto;
            animation: fadeIn 0.3s ease;
        }
        .popup-content img {
            width: 100%;
            height: auto;
        }
        .close-popup {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #333;
            cursor: pointer;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Responsif untuk tampilan mobile */
        @media (max-width: 576px) {
            .typing-effect {
                white-space: normal; /* Izinkan teks membungkus ke baris baru */
            }
        }

        header {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            height: 200px; /* Atur tinggi header tetap */
            position: relative; /* Posisi relative untuk kontrol lebih lanjut */
            overflow: hidden; /* Sembunyikan elemen yang melampaui batas */
        }

        /* Agar teks berada di tengah secara vertikal */
        .header-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Pusatkan elemen */
            text-align: center;
            width: 100%; /* Pastikan lebar penuh */
        }

        /* Warna putih untuk judul "Selamat datang" */
        .welcome-title {
            color: white; /* Warna teks putih */
        }
    </style>
</head>
<body>

<header class="container-fluid">
    <div class="header-content">
        <h1 class="display-5 welcome-title">Selamat datang, <?php echo $nama_mahasiswa; ?>!</h1>
        <p class="lead typing-effect" id="typing-text"></p>
    </div>
</header>

<!-- "Daftar Seminar" Title -->
<div class="container mt-4">
    <h2 class="text-left" style="font-size: 2rem; font-weight: 700; color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
        <i class="fas fa-list-alt"></i> Daftar Seminar
    </h2>
</div>
<script>
    <?php if ($this->session->flashdata('message_success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?php echo $this->session->flashdata('message_success'); ?>',
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('message_error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?php echo $this->session->flashdata('message_error'); ?>',
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>
</script>


<div class="container mt-5">
    <div class="row">
        <?php if (!empty($seminar_data)): ?>
            <?php foreach ($seminar_data as $seminar): 
                // Menghitung sisa hari
                $today = new DateTime();
                $seminar_date = new DateTime($seminar->tgl_pelaksana);
                $remaining_days = $today->diff($seminar_date)->days;
            ?>
                <div class="col-6 col-md-6 mb-3">
                <div class="card h-100 d-flex flex-column seminar-card" style="height: 350px;">
                        <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" 
                             class="card-img-top seminar-image" 
                             alt="Seminar Image" 
                             style="object-fit: contain; width: 100%; height: auto;" 
                             data-image="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>">
                        <div class="card-body d-flex flex-column justify-content-between" style="padding: 10px;">
                            <div class="flex-grow-1">
                                <h5 class="card-title" style="font-size: 1rem; margin-bottom: 5px;">
                                    <i class="fas fa-chalkboard-teacher"></i> <?php echo $seminar->nama_seminar; ?>
                                </h5>
                            </div>
                            <div class="mt-auto">
                                
                                <p class="card-text" style="font-size: 0.875rem; line-height: 1.2;">
                                    
                                    <i class="fas fa-calendar-alt"></i> <?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?>
                                </p>
                                <p class="card-text" style="font-size: 0.875rem; line-height: 1.2;">
                                    <i class="fas fa-tags"></i> Rp <?php echo number_format($seminar->harga_tiket, 0, ',', '.'); ?>
                                </p>
                            </div>
                            <span class="badge bg-warning text-dark"><?php echo $remaining_days; ?> Hari Lagi</span>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between">
                                    <?php if ($seminar->is_history): ?>
                                        <a href="<?php echo base_url('user/home/seminar_history/' . $seminar->id_seminar); ?>" class="btn btn-info" style="flex: 1; margin-right: 5px; font-size: 0.875rem;">
                                            <i class="fas fa-history"></i> History
                                        </a>
                                    <?php elseif ($seminar->is_slot_habis): ?>
                                        <button class="btn btn-danger" style="flex: 1; margin-right: 5px; font-size: 0.875rem;" disabled>
                                            <i class="fas fa-times"></i> Habis
                                        </button>
                                    <?php elseif (isset($seminar->is_registered) && $seminar->id_stsbyr == 1): ?>
                                        <button class="btn btn-secondary" style="flex: 1; margin-right: 5px; font-size: 0.875rem;" disabled>
                                            <i class="fas fa-check"></i> Diikuti
                                        </button>
                                    <?php elseif ($seminar->is_registered): ?>
                                        <a href="<?php echo base_url('payment/bayar/' . $seminar->id_seminar); ?>" class="btn btn-warning" style="flex: 1; margin-right: 5px; font-size: 0.875rem;">
                                            <i class="fas fa-money-bill"></i> Bayar
                                        </a>
                                    <?php else: ?>
                                        <a href="javascript:void(0);" class="btn btn-success daftar-seminar" data-seminar-id="<?php echo $seminar->id_seminar; ?>" style="flex: 1; margin-right: 5px; font-size: 0.875rem;">
                                            <i class="fas fa-user-plus"></i> Daftar
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo base_url('user/home/detail/' . $seminar->id_seminar); ?>" class="btn btn-primary" style="flex: 1; margin-left: 5px; font-size: 0.875rem;">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">Tidak ada seminar yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="popup-overlay" id="popup-overlay" onclick="closePopup()">
    <div class="popup-content" onclick="event.stopPropagation()">
        <img src="" alt="Popup Image" class="popup-image" id="popup-image">
    </div>
</div>

<script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    // Fungsi untuk efek mengetik yang berulang
    const typingText = "Nikmati pengalaman seminar yang seru dan menarik.";
    const typingElement = document.getElementById('typing-text');
    let index = 0;

    function type() {
        if (index < typingText.length) {
            typingElement.textContent += typingText.charAt(index);
            index++;
            setTimeout(type, 100);
        } else {
            setTimeout(() => {
                typingElement.textContent = ""; // Reset teks
                index = 0; // Reset indeks
                type(); // Panggil lagi fungsi mengetik
            }, 2000); // Tunggu 2 detik sebelum mengetik ulang
        }
    }

    // Mulai efek mengetik
    type();

    document.querySelectorAll('.seminar-image').forEach(image => {
        image.addEventListener('click', function() {
            const imageSrc = this.getAttribute('data-image');
            document.getElementById('popup-image').src = imageSrc;
            document.getElementById('popup-overlay').classList.add('show');
        });
    });

    function closePopup() {
        document.getElementById('popup-overlay').classList.remove('show');
    }

    // SweetAlert2 konfirmasi untuk daftar seminar
    document.querySelectorAll('.daftar-seminar').forEach(function(button) {
        button.addEventListener('click', function() {
            const seminarId = this.getAttribute('data-seminar-id');
            Swal.fire({
                title: 'Apakah Anda yakin ingin mendaftar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo base_url('user/home/daftar/'); ?>' + seminarId;
                }
            });
        });
    });
</script>

</body>
</html>
