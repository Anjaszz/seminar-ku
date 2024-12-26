<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        table,
        tr,
        td,
        th {
            text-align: center;
            border: 1px solid #ddd; /* Tambahkan border untuk tabel */
        }

        th {
            background-color: #f2f2f2; /* Warna latar belakang header tabel */
        }

        .badge {
            display: inline-block;
            padding: .25em .4em;
            font-size: 100%;
            font-weight: 00;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10"><?= $title ?></h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('home') ?>"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!"><?= $title ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5><?= $title ?></h5>
            </div>
            <div class="card-body p-3 mt-2">
                <div class="">
                    <div class="customer-scroll" style="height:auto;position:relative;">
                        <div class="table-responsive">
                            <table id="laporanTable" class="table table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID User</th>
                                        <th>Nama Peserta</th>
                                        <th>Email</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($laporan)) { ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data keuangan.</td>
                                        </tr>
                                    <?php } else { 
                                        $no = 1;
                                        foreach ($laporan as $l) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $l->nim ?></td> <!-- Tampilkan NIM -->
                                                <td><?= $l->nama_mhs ?></td>
                                                <td><?= $l->email ?></td>
                                                <td><?= date('d-m-Y', strtotime($l->tgl_transaksi)) ?></td>
                                                <td>Rp <?= number_format($l->jumlah, 0, ',', '.') ?></td>
                                            </tr>
                                    <?php } ?>
                                        <tr>
                                            <td colspan="5"><strong>Total Transaksi</strong></td>
                                            <td><strong>Rp <?= number_format($total_transaksi, 0, ',', '.') ?></strong></td> <!-- Tampilkan total transaksi -->
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
</div>

<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

</body>
</html>
