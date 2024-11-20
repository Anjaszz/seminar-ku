<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminar Yang Diikuti</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
       

        .card {
            max-width: 300px; /* Ubah ukuran maksimum card */
            margin: 10px auto; /* Pusatkan card dan beri sedikit margin */
        }
        .card:hover {
            transform: scale(1.02); /* Efek zoom saat hover */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Bayangan */
        }

        .card-img-top {
            width: 100%; /* Gambar akan memenuhi lebar card */
            height: auto; /* Tinggi mengikuti ukuran gambar */
            border-top-left-radius: 0.25rem; /* Rounded corners for top */
            border-top-right-radius: 0.25rem; /* Rounded corners for top */
        }

        .card-body {
            padding: 10px; /* Kurangi padding dalam card untuk menghemat ruang */
        }

        .card-title {
            font-size: 1rem; /* Kurangi ukuran font judul */
        }

        .card-text {
            font-size: 0.875rem; /* Kurangi ukuran font teks */
        }

        .badge {
            font-size: 0.75rem; /* Kurangi ukuran badge */
        }

        .btn {
            border-radius: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-hover {
            transform: scale(1.05);
        }

        .d-flex .btn {
            flex: 0 0 48%; /* Buat tombol lebih kecil dan sejajar */
        }

        .d-flex .me-1,
        .d-flex .ms-1 {
            margin: 0; /* Hilangkan margin antar tombol */
        }

        @media (max-width: 576px) {
            .card {
                margin-bottom: 10px; /* Jarak antar card pada mobile */
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-left" style="font-size: 2rem; font-weight: 700; color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
            <i class="fas fa-graduation-cap"></i> Seminar Yang Diikuti
        </h2>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center"> <!-- Pusatkan konten -->
            <?php if (!empty($seminar_data)): ?>
                <?php foreach ($seminar_data as $seminar):
                    // Calculate remaining days
                    $today = new DateTime();
                    $seminar_date = new DateTime($seminar->tgl_pelaksana);
                    $remaining_days = $today->diff($seminar_date)->days;
                ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-3"> <!-- Responsive kolom dengan jarak lebih kecil -->
                        <div class="card h-100 shadow-sm border-primary">
                            <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" class="card-img-top" alt="Seminar Image">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; color: #007bff;">
                                    <i class="fas fa-chalkboard-teacher"></i> <?php echo $seminar->nama_seminar; ?>
                                </h5>
                                <p class="card-text">
                                    <strong><i class="fas fa-calendar-alt"></i> Tanggal Pelaksanaan:</strong> 
                                    <strong><?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?></strong>
                                </p>
                                <span class="badge bg-warning text-dark"><?php echo $remaining_days; ?> Hari Lagi</span>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <a href="<?php echo base_url('user/home/detail/' . $seminar->id_seminar); ?>" class="btn btn-primary me-1">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                    <a href="<?php echo base_url('user/generate/etiket/' . $seminar->id_mahasiswa . '/' . $seminar->id_seminar); ?>" class="btn btn-success ms-1">
                                        <i class="fas fa-qrcode"></i> E-Tiket
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> Anda belum mendaftar pada seminar apapun.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
