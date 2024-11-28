<style>
    table,
    tr,
    td,
    th {
        text-align: center;
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
                <div class="me-auto"></div> <!-- Menambahkan margin untuk mengisi ruang -->
        <div class="float-right ms-2"> <!-- Tambahkan kelas ms-2 untuk margin kiri -->
            <button type="button" onclick="confirmDeleteAll('<?php echo site_url('laporan/hapus_semua/' . $id_seminar); ?>')" class="btn btn-danger btn-sm d-flex align-items-center">
                <i class="feather icon-trash me-1"></i> <!-- Menggunakan ikon hapus -->
                Hapus Semua Data
            </button>
        </div>
                
                <div class="card-header-right">
                
                   
                    
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            



                
                <div class="">
                    <div class="customer-scroll" style="height:auto;position:relative;">
                        <div class="dt-responsive table-responsive">
    <table id="laporanTable" class="table table-bordered table-hover display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Email</th>
                <th>Tanggal Transaksi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
    <?php if (empty($laporan)) { ?>
        <tr>
            <td colspan="5" class="text-center">Tidak ada data keuangan.</td>
        </tr>
    <?php } else { 
        $no = 1;
        foreach ($laporan as $l) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $l->nama_mhs ?></td>
                <td><?= $l->email ?></td>
                <td><?= date('d-m-Y', strtotime($l->tgl_transaksi)) ?></td>
                <td>Rp <?= number_format($l->jumlah, 0, ',', '.') ?></td>
            </tr>
    <?php } 
    } ?>
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

    function confirmDeleteAll(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Seluruh data akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus Semua!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
