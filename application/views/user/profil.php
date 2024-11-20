<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            transition: color 0.3s;
        }

        h2:hover {
            color: #0056b3;
        }

        .table th {
            background-color: #007bff;
            color: white;
            text-align: left;
        }

        .table td {
            font-weight: 500;
            padding: 5px;
        }

        .table tr {
            height: 40px;
        }

        .icon {
            font-size: 1.5rem;
            color: #007bff;
            margin-right: 10px;
            transition: color 0.3s;
        }

        .icon:hover {
            color: #0056b3;
        }

        @media (max-width: 576px) {
            .table-responsive {
                margin-top: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .icon {
                font-size: 1.2rem;
            }
        }

        .btn-custom {
            border-radius: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-custom:hover {
            transform: scale(1.05);
        }

        .button-container {
            display: flex;
            justify-content: space-between; /* Mengatur jarak antara tombol */
            margin-top: 20px; /* Jarak antara tabel dan tombol */
        }

        .card-header .profile-name {
            font-weight: bold;
            font-size: 1.25rem;
            color: #007bff; /* Warna nama disamakan dengan warna ikon */
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-left">
            <i class="fas fa-user-graduate icon"></i> Profil Mahasiswa
        </h2>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <!-- Tambahkan ikon user di atas nama -->
                <i class="fas fa-user-graduate icon" style="font-size: 80px; color: #007bff;"></i>
                <!-- Nama mahasiswa ditambahkan di bawah ikon dengan teks tebal dan warna disamakan -->
                <p class="profile-name" style="font-size: 30px;"><?php echo $mahasiswa->nama_mhs; ?></p>
            </div>
            <div class="card-body">
                <!-- Tabel Profil Mahasiswa -->
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>NIM</th>
                            <td><?php echo $mahasiswa->nim; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $mahasiswa->email; ?></td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td><?php echo $mahasiswa->no_telp; ?></td>
                        </tr>
                        <tr>
                            <th>Prodi</th>
                            <td><?php echo $mahasiswa->nama_prodi; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="button-container">
                    <a href="<?php echo base_url('user/home/seminar_history/'); ?>" class="btn btn-custom btn-info">
                        <i class="fas fa-history"></i> History Seminar
                    </a>
                    <a href="<?php echo base_url('user/auth/ubah_password/'); ?>" class="btn btn-custom btn-warning">
                        <i class="fas fa-key"></i> Ubah Password
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for Bootstrap Icons and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
