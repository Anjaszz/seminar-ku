<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAS - Sistem Manajemen Seminar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            position: relative;
            background: linear-gradient(315deg, rgba(101,0,94,1) 3%, rgba(60,132,206,1) 38%, rgba(48,238,226,1) 68%, rgba(255,25,25,1) 98%);
            animation: gradient 15s ease infinite;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 0% 0%;
            }
        }

        .wave {
            background: rgb(255 255 255 / 25%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }
            25% {
                transform: translateX(-25%);
            }
            50% {
                transform: translateX(-50%);
            }
            75% {
                transform: translateX(-25%);
            }
            100% {
                transform: translateX(1);
            }
        }

        /* Hero Section */
        .hero-section {
            color: white;
            text-align: center;
            padding: 100px 20px;
            position: relative;
            overflow: hidden;
        }

        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            animation: fadeInDown 1s;
            z-index: 1;
            position: relative;
        }

        .hero-section p {
            font-size: 1.2rem;
            animation: fadeInUp 1.5s;
            z-index: 1;
            position: relative;
        }

        .hero-section .btn-login {
            margin-top: 40px;
            padding: 10px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            background-color: #007bff;
            color: white;
            border: none;
            animation: fadeInUp 2s;
            z-index: 1;
            position: relative;
        }

        .hero-section .btn-login:hover {
            background-color: #0056b3;
        }

        /* Features Section */
        .features-section {
            padding: 60px 20px;
            background: transparent;
            text-align: center;
        }

        .features-section h2 {
            margin-bottom: 40px;
            animation: fadeIn 1.5s;
            color: white;
        }

        .features-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .feature-card {
            flex-basis: 100%;
            animation: fadeInUp 1s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.5); /* Transparan */
            max-width: 1000px;
            margin: 0 auto;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding-bottom: 10px;
        }

        .feature-item .bi {
            font-size: 1.5rem;
            color: #28a745;
            margin-right: 15px;
        }

        .feature-item p {
            font-size: 1.1rem;
            margin: 0;
            color: #6c757d;
            font-weight: bold;
            animation: fadeIn 1.5s;
        }

        /* Steps Section */
        .steps-section {
            padding: 60px 20px;
            background: transparent;
            text-align: center;
        }

        .steps-section h2 {
            margin-bottom: 40px;
            animation: fadeIn 1.5s;
            color: white;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5); /* Transparan untuk langkah */
            margin: 15px;
        }

        /* Footer */
        .footer {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

    
    </style>
</head>

<body>
    <!-- Waves Background -->
    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="background-animation">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" alt="SIMAS Logo" class="img-fluid" style="max-width: 250px; height: auto;">
        <h1 class="animate__animated animate__fadeInDown">Selamat Datang di SIMAS</h1>
        <p class="animate__animated animate__fadeInUp">Sistem Manajemen Seminar yang efisien dan akurat untuk memudahkan mahasiswa mendaftar seminar</p>
        <a href="<?= base_url('user/auth') ?>" class="btn-login animate__animated animate__fadeInUp">Masuk ke Aplikasi</a>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <h2 class="animate__animated animate__fadeIn">Fitur Unggulan SIMAS</h2>
        <div class="features-container">
            <div class="feature-card">
                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>Akun user yang sudah terintegrasi dengan data kampus.</p>
                </div>
                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>Pendaftaran online yang memudahkan Anda memilih seminar yang diinginkan dengan cepat dan mudah.</p>
                </div>
                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>Pembayaran yang mudah dengan berbagai pilihan metode, semua dapat dilakukan secara online.</p>
                </div>
                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>Generate E-tiket untuk kemudahan presensi hanya dengan sekali scan.</p>
                </div>
                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>Riwayat Seminar yang pernah diikuti akan tersimpan di aplikasi SIMAS.</p>
                </div>
                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>Sertifikat seminar dapat diunduh dengan mudah di aplikasi.</p>
                </div>
                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <p>Antarmuka yang responsif dan mudah diakses melalui smartphone.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Steps Section -->
    <div class="steps-section">
    <h2 class="animate__animated animate__fadeIn">Bagaimana Cara Mengikuti Seminar Di Aplikasi SIMAS</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title"><i class="bi bi-person-fill"></i> 1. Login</h5>
                <p class="card-text step-text">Login menggunakan akun yang terdaftar dikampus.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title"><i class="bi bi-calendar-event"></i> 2. Pilih Seminar</h5>
                <p class="card-text step-text">Pilih seminar yang ingin anda ikuti.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title"><i class="bi bi-credit-card-fill"></i> 3. Pembayaran</h5>
                <p class="card-text step-text">Lakukan pembayaran melalui metode yang tersedia.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title"><i class="bi bi-file-earmark-check-fill"></i> 4. E-Tiket</h5>
                <p class="card-text step-text">Dapatkan e-tiket Anda setelah pembayaran berhasil.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title"><i class="bi bi-calendar-check"></i> 5. Hadiri Seminar</h5>
                <p class="card-text step-text">Hadiri seminar sesuai dengan jadwal yang Anda pilih.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title"><i class="bi bi-check-circle"></i> 6. Presensi</h5>
                <p class="card-text step-text">Scan e-tiket sebelum masuk ruangan seminar untuk presensi.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title"><i class="bi bi-file-earmark-arrow-down"></i> 7. Download File</h5>
                <p class="card-text step-text">Unduh file yang diperlukan untuk seminar di aplikasi dan ikuti acara sampai selesai.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-title"><i class="bi bi-file-earmark-check"></i> 8. Download Sertifikat</h5>
                <p class="card-text step-text">Unduh sertifikat setelah mengikuti seminar di halaman History Seminar.</p>
            </div>
        </div>
    </div>
</div>



    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2024 SIMAS - Sistem Manajemen Seminar.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
