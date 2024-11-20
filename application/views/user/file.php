<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>File/Modul</title>
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
            border: 1px solid #dee2e6;
            vertical-align: middle;
            text-align: center;
        }

        .table {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .container-custom {
            padding: 20px;
            border-radius: 10px; /* Rounded corners */
            background-color: #f8f9fa; /* Light background for the container */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Shadow effect for the container */
        }

        /* CSS untuk tombol download */
        .btn-download {
            width: 120px;
            padding: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto; /* Posisi tengah */
        }

        .btn-download .icon {
            margin-right: 5px;
        }
        .badge {
            font-size: 0.75rem; /* Ukuran badge */
        }
        
    </style>
</head>
<body>
    <div class="container mt-5 container-custom">
    <h2 class="text-left" style="font-size: 2rem; font-weight: 700; color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
            <i class="fas fa-file-alt"></i> File/Modul
        </h2>

        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Silakan unduh file/modul yang Anda ikuti.</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Seminar</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($file_data as $s) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $s->nama_seminar ?></td>
                                            
                                            <td>
                                                <?php if (!empty($s->file)) { ?>
                                                    <i class="file-icon fas fa-file-download"></i>
                                                    <span><?= htmlspecialchars($s->file) ?></span> <!-- Nama file hanya ditampilkan sebagai teks biasa -->
                                                <?php } else { ?>
                                                    <span>No File</span>
                                                <?php } ?>
                                            </td>

                                            <td class="text-center">
                                                <?php if (empty($s->file)): ?>
                                                    <button class="btn btn-sm btn-secondary btn-download" disabled>
                                                        <span class="icon"><i class="fas fa-download"></i></span>
                                                        Unduh
                                                    </button>
                                                <?php else: ?>
                                                    <a href="<?= base_url('uploads/file/' . $s->file); ?>" class="btn btn-sm btn-primary btn-download" download>
                                                        <span class="icon"><i class="fas fa-download"></i></span>
                                                        Unduh
                                                    </a>
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
</body>
</html>
