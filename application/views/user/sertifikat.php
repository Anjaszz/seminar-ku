<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Seminar</title>
    <style>
        /* Container untuk sertifikat */
        .certificate-container {
            width: 90%; /* Lebar container */
            max-width: 800px; /* Lebar maksimum untuk tampilan desktop */
            margin: auto; /* Center container */
            border: 2px solid #ccc; /* Border sertifikat */
            border-radius: 10px; /* Sudut membulat */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Bayangan */
            background-color: #fff; /* Latar belakang putih */
            padding: 20px; /* Padding untuk isi sertifikat */
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

        /* Styling untuk tombol */
        .button-container {
            display: flex;
            justify-content: center; /* Center tombol */
            margin: 20px 0; /* Margin atas dan bawah */
        }

        .btn-download {
            background-color: #007bff; /* Warna biru untuk tombol download */
            border-color: #007bff;
            color: white; /* Warna teks */
            padding: 15px 30px; /* Padding dalam tombol */
            border-radius: 5px; /* Sudut membulat tombol */
            text-decoration: none; /* Menghilangkan garis bawah */
            transition: background-color 0.3s; /* Efek transisi */
        }

        .btn-download:hover {
            background-color: #0056b3; /* Warna saat hover */
        }
    </style>
</head>
<body>
    <?php
        // Simpan gambar dan nama mahasiswa ke dalam variabel
        $sertifikatUrl = base_url('uploads/sertifikat/' . $sertifikat->sertifikat);
        $namaMahasiswa = $mahasiswa->nama_mahasiswa;
    ?>

    <div class="col-sm-12">
        <div class="certificate-container">
            <!-- Gambar background sertifikat (dari variabel) -->
            <img class="img-responsive imgA1" src="<?= $sertifikatUrl; ?>" alt="Sertifikat">

            <!-- Nama Mahasiswa ditampilkan di tengah (dari variabel) -->
            <div class="nama-mahasiswa">
                <?= $namaMahasiswa; ?>
            </div>

            <!-- Tombol Download -->
            <div class="button-container">
                <button id="btn-download" class="btn btn-primary btn-download">
                    Unduh Sertifikat
                </button>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.4/dist/sweetalert2.min.js"></script>

    <script>
        document.getElementById('btn-download').addEventListener('click', function() {
            // Mendapatkan elemen gambar sertifikat (imgA) dan teks nama mahasiswa (namaMahasiswa)
            var imgA = document.querySelector('.imgA1');
            var namaMahasiswa = document.querySelector('.nama-mahasiswa');

            // Membuat canvas
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
            ctx.fillText(namaMahasiswa.innerText, xPos, yPos);

            // Mendapatkan hasil gambar dalam format PNG
            var dataURL = canvas.toDataURL('image/png');

            // Membuat elemen untuk memicu download
            var downloadLink = document.createElement('a');
            downloadLink.href = dataURL;
            downloadLink.download = 'sertifikat-seminar.png';

            // Memicu aksi download
            downloadLink.click();
        });
    </script>
</body>
</html>
