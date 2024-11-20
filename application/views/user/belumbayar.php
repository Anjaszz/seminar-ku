<!DOCTYPE html>
<html lang="en">
<head>
    <title>Seminar yang Belum Dibayar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .card {
            max-width: 300px; /* Membatasi lebar maksimum card */
            margin: 10px auto; /* Jarak antar card */
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            width: 300px; /* Gambar akan memenuhi lebar card */
            height: 300px; /* Tinggi gambar yang ditetapkan */
            object-fit: cover; /* Menjaga gambar memenuhi area tanpa terpotong */
            border-top-left-radius: 0.25rem; /* Sudut melengkung untuk bagian atas */
            border-top-right-radius: 0.25rem; /* Sudut melengkung untuk bagian atas */
        }

        .card-body {
            padding: 10px; /* Mengurangi padding dalam card */
            
        }

        .card-title {
            font-size: 1rem; /* Ukuran judul */
            font-weight: bold;
            color: #007bff;
        }
        .card:hover {
            transform: scale(1.02); /* Efek zoom saat hover */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Bayangan */
        }

        .card-text {
            font-size: 0.875rem; /* Ukuran teks */
        }

        .badge {
            font-size: 0.75rem; /* Ukuran badge */
        }

        .btn {
            border-radius: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .d-flex .btn {
            flex: 0 0 48%; /* Ukuran tombol yang lebih kecil dan sejajar */
        }

        @media (max-width: 576px) {
            .card {
                margin-bottom: 10px; /* Jarak antar card pada mobile */
            }
        }
        

        .btn-hover {
            transform: scale(1.05);
        }

        
    </style>
</head>
<body>
<div class="container mt-4">
<h6 class="text-left" style="font-size: 1.5rem; font-weight: 700; color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
            <i class="fas fa-money-check-alt"></i> Seminar yang Belum Dibayar
        </h6>
    </div>

    <div class="container mt-5" style="max-width: 100%;"> <!-- Mengubah ukuran container -->
        <div class="row justify-content-center"> <!-- Memusatkan konten -->
            <?php if (!empty($seminar_data)): ?>
                <?php foreach ($seminar_data as $seminar): 
                    // Menghitung sisa hari
                    $today = new DateTime();
                    $seminar_date = new DateTime($seminar->tgl_pelaksana);
                    $remaining_days = $today->diff($seminar_date)->days;
                ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3"> <!-- Responsive kolom -->
                        <div class="card h-100 shadow-sm border-primary">
                            <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" class="card-img-top" alt="Seminar Image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-chalkboard-teacher"></i> <?php echo $seminar->nama_seminar; ?>
                                </h5>
                                <p class="card-text">
                                    <strong><i class="fas fa-calendar-alt"></i> Tanggal Pelaksanaan:</strong> 
                                    <strong><?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?></strong>
                                </p>
                                <p class="card-text">
                                    <strong><i class="fas fa-tags"></i> Harga: Rp <?php echo number_format($seminar->harga_tiket, 0, ',', '.'); ?></strong>
                                </p>
                                <span class="badge bg-warning text-dark"><?php echo $remaining_days; ?> Hari Lagi</span>
                                <div class="mt-3 d-flex justify-content-between"> <!-- Menambahkan d-flex untuk tombol -->
                                    <a href="<?php echo base_url('payment/bayar/' . $seminar->id_seminar); ?>" class="btn btn-warning me-1 w-100">
                                        <i class="fas fa-money-bill"></i> Bayar
                                    </a>
                                    <button class="btn btn-danger ms-1 w-100 btn-batal" data-url="<?php echo base_url('user/home/batal/' . $seminar->id_pendaftaran); ?>">
                                        <i class="fas fa-ban"></i> Batalkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> Tidak ada seminar yang belum dibayar.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- SweetAlert2 for Batal Alert and Cancel Confirmation -->
    <script>
        document.querySelectorAll('.btn-batal').forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan aksi ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });

        // Alert Pembatalan Berhasil
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Pembatalan Berhasil',
                text: '<?php echo $this->session->flashdata('success'); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>

        // Alert Pembatalan Gagal
        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Pembatalan Gagal',
                text: '<?php echo $this->session->flashdata('error'); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>
    </script>

    <script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
