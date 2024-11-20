<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <title>History Seminar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styling untuk tabel */
        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
            
        }

        .table th, .table td {
            border: 1px solid #dee2e6; /* Adds a nice border for table columns */
            vertical-align: middle; /* Center align content vertically */
            text-align: center; /* Memusatkan teks judul tabel */
        }

        .table {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect for the table */
        }

        .container-custom {
            padding: 20px;
            border-radius: 10px; /* Rounded corners */
            background-color: #f8f9fa; /* Light background for the container */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Shadow effect for the container */
        }

        /* CSS to ensure download buttons (both active and disabled) are the same size */
        .btn-download {
            width: 120px; /* Set the width of the button */
            padding: 10px; /* Adjust padding for consistent size */
            text-align: center; /* Center text */
            display: flex; /* Flexbox untuk ikon dan teks */
            align-items: center; /* Center vertically */
            justify-content: center; /* Center horizontally */
        }

        .btn-download .icon {
            margin-right: 5px; /* Jarak antara ikon dan teks */
        }

        .btn-download.disabled, .btn-download[disabled] {
            opacity: 0.65; /* Maintain visual appearance for disabled state */
        }

        /* Container untuk sertifikat */
        .certificate-container {
            width: 100%; /* Lebar container */
            max-width: 800px; /* Lebar maksimum untuk tampilan desktop */
            margin: auto; /* Center container */
            border: 2px solid #ccc; /* Border sertifikat */
            border-radius: 10px; /* Sudut membulat */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Bayangan */
            background-color: #fff; /* Latar belakang putih */
            padding: 0px; /* Padding untuk isi sertifikat */
            text-align: center; /* Center text */
            position: relative; /* Posisi relative untuk teks nama */
            display: flex; /* Menggunakan flexbox */
            flex-direction: column; /* Kolom */
            align-items: center; /* Center horizontal */
            justify-content: center; /* Center vertical */
            height: auto; /* Tinggi otomatis agar sesuai dengan isi */
        }

        /* Styling untuk gambar sertifikat */
        .imgA1 {
            width: 100%; /* Lebar sertifikat 100% dari container */
            height: auto; /* Tinggi otomatis untuk menjaga aspek rasio */
            object-fit: contain; /* Pastikan gambar tidak terpotong dan sesuai dengan ukuran container */
        }

        /* Styling untuk teks nama mahasiswa */
        .nama-mahasiswa {
            position: absolute;
            z-index: 2; /* Teks di depan background */
            top: 10%; /* Atur jarak dari atas background */
            left: 50%; /* Atur jarak dari kiri background */
            transform: translate(-50%, -50%); /* Center teks di tengah */
            font-size: 5%; /* Ukuran font relatif untuk responsivitas */
            font-weight: bold; /* Tebal teks */
            color: gold; /* Warna emas */
            font-family: 'Times New Roman', Times, serif; /* Gaya font klasik */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); /* Bayangan teks */
        }

        /* Menambahkan CSS untuk memusatkan tombol download */
        .button-container {
            text-align: center; /* Center button */
            margin-top: 10px; /* Jarak atas untuk tombol */
        }
    </style>
</head>
<body>
<div class="container mt-5 container-custom">
    <h2 class="text-left" style="font-size: 2rem; font-weight: 700; color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
            <i class="fas fa-money-check-alt"></i> History Seminar
        </h2>


        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Silahkan download sertifikat seminar anda.</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-style-hover" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Seminar</th>
                                        <th>Tanggal Pelaksanaan</th>
                                        <th>Sertifikat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($history_seminar as $s) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $s->nama_seminar ?></td>
                                            <td><?= date('d M Y', strtotime($s->tgl_pelaksana)) ?></td>
                                            <td class="text-center"> <!-- Menambahkan class untuk center text -->
                                                <?php if (empty($s->sertifikat)): ?>
                                                    <!-- Tidak ada sertifikat, tidak ada tombol download -->
                                                    <span>-</span>
                                                <?php else: ?>
                                                    <div class="certificate-container">
                                                        <?php
                                                        // Simpan gambar dan nama mahasiswa ke dalam variabel
                                                        $sertifikatUrl = base_url('uploads/sertifikat/' . $s->sertifikat);
                                                        $namaMahasiswa = $s->nama_mahasiswa;
                                                        ?>
                                                        <img class="img-responsive imgA1" src="<?= $sertifikatUrl; ?>" alt="Sertifikat">
                                                        <div class="nama-mahasiswa">
                                                            <?= $namaMahasiswa; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <!-- Pindahkan tombol unduh ke kolom Aksi -->
                                                <?php if (empty($s->sertifikat)): ?>
                                                    <button class="btn btn-sm btn-secondary mt-2 btn-download" disabled>
                                                        <span class="icon"><i class="fas fa-download"></i></span>
                                                        Unduh
                                                    </button>
                                                <?php else: ?>
                                                    <div class="button-container"> <!-- Memusatkan tombol download -->
                                                        <button id="btn-download-<?= $s->id_seminar; ?>" class="btn btn-primary btn-download">
                                                            <span class="icon"><i class="fas fa-download"></i></span>
                                                            Unduh
                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.js"></script>

    <script>
        // Fungsi untuk mendownload sertifikat
        function downloadCertificate(buttonId, sertifikatUrl, namaMahasiswa) {
            // Mendapatkan elemen gambar sertifikat (imgA) dan teks nama mahasiswa (namaMahasiswa)
            var imgA = document.querySelector('.imgA1[src="' + sertifikatUrl + '"]');
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');

            // Mengambil ukuran asli dari gambar sertifikat (imgA)
            var widthA = imgA.naturalWidth;
            var heightA = imgA.naturalHeight;

            // Mengatur ukuran canvas sesuai gambar sertifikat
            canvas.width = widthA;
            canvas.height = heightA;

            // Menggambar gambar sertifikat ke canvas
            ctx.drawImage(imgA, 0, 0, widthA, heightA);

            // Posisi teks nama mahasiswa (sesuai styling CSS)
            var fontSize = heightA * 0.08; // Menghitung ukuran font berdasarkan tinggi gambar
            ctx.font = fontSize + "px 'Times New Roman'";
            ctx.fillStyle = 'gold';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.shadowColor = 'rgba(0, 0, 0, 0.5)';
            ctx.shadowBlur = 5;
            ctx.shadowOffsetX = 2;
            ctx.shadowOffsetY = 2;

            // Menghitung posisi teks nama mahasiswa di tengah
            var xPos = canvas.width / 2;
            var yPos = canvas.height / 2.3; // Selalu di tengah

            // Menggambar teks nama mahasiswa di canvas
            ctx.fillText(namaMahasiswa, xPos, yPos);

            // Mendapatkan hasil gambar dalam format PNG
            var dataURL = canvas.toDataURL('image/png');

            // Membuat elemen untuk memicu download
            var downloadLink = document.createElement('a');
            downloadLink.href = dataURL;
            downloadLink.download = 'sertifikat-seminar.png';

            // Memicu aksi download
            downloadLink.click();
        }

        // Menambahkan event listener untuk setiap tombol download
        <?php foreach ($history_seminar as $s) { ?>
            document.getElementById('btn-download-<?= $s->id_seminar; ?>').addEventListener('click', function() {
                downloadCertificate(this.id, '<?= base_url('uploads/sertifikat/' . $s->sertifikat); ?>', '<?= $s->nama_mahasiswa; ?>');
            });
        <?php } ?>
    </script>
</body>
</html>
