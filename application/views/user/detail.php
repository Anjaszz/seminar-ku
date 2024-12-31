<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Seminar</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Background abu-abu muda */
        }

        .card {
            margin: auto; /* Pusatkan card dan beri sedikit margin */
            border: 1px solid #007bff; /* Border card */
        }

        .table {
            margin-top: 20px; /* Margin atas tabel */
        }

        .btn-warning {
            background-color: #ffc107; /* Warna tombol Kembali */
            border: none; /* Hapus border tombol */
        }

        .btn-warning:hover {
            background-color: #e0a800; /* Warna tombol saat hover */
        }

        h2 {
            font-size: 1.5rem; /* Ukuran font judul */
            font-weight: bold; /* Teks judul tebal */
            color: #007bff; /* Warna judul */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>
                            <i class="fas fa-chalkboard-teacher"></i> <!-- Ikon untuk judul -->
                            <?php echo $seminar->nama_seminar; ?>
                        </h2>
                    </div>
                    <div class="card-body">
                        <!-- Gambar Seminar -->
                        <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" class="img-fluid mb-4" alt="Seminar Image" style="max-width: 100%; height: auto;">

                        <!-- Table for Seminar Details -->
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row">Tanggal Acara</th>
                                    <td><?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Jam Mulai</th>
                                    <td><?php echo date('H:i', strtotime($seminar->tgl_pelaksana)); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Lokasi</th>
                                    <td><?php echo $seminar->nama_provinsi; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Detail Lokasi</th>
                                    <td><?php echo $seminar->lokasi; ?></td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">Pembicara</th>
                                    <td><?php echo $seminar->nama_pembicara; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Latar Belakang</th>
                                    <td><?php echo $seminar->latar_belakang; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Slot Tiket</th>
                                    <td><?php echo $seminar->slot_tiket; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sisa Tiket</th>
                                    <td><?php echo $seminar->sisa_tiket; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sponsor</th>
                                    <td><?php echo $seminar->nama_sponsor; ?></td>
                                </tr>
                                
                            </tbody>
                        </table>

                        <div class="text-center mt-4">
                            <button onclick="history.back()" class="btn btn-primary back-button" style="border-radius: 20px; transition: background-color 0.3s, transform 0.3s;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
