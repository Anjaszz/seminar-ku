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

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10"><?= $title ?></h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url('master/home') ?>"><i class="feather icon-home"></i></a></li>
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
                <div class="card-header-right">
                    <div class="float-right">
                        <?php echo $btntambah ?>
                    </div>
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
        
            <div class="card-body p-3 mt-2">
                <div class="">
                    <div class="customer-scroll" style="height:auto;position:relative;">
                        <div class="table-responsive">
                            <table id="table-style-hover" class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama vendor</th>
                                        <th>Status</th>
                                        <th>Tanggal Langganan</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($vendor as $r) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <h6 class="m-0"><?= $r->nama_vendor ?></h6>
                                            </td>
                                            <td>
                            <span class="badge <?= $r->active === '1' ? 'badge-aktif' : 'badge-nonaktif'; ?>">
                                <?= $r->active === '1' ? 'Aktif' : 'Nonaktif'; ?>
                            </span>
                        </td>
                                            <td><?= $r->tgl_subs ?></td>
                                            <td><?= $r->email ?></td>
                                            <td><?= $r->no_telp ?></td>
                                            <td>
                                                <?php echo anchor("master/vendor/detail/{$r->id_vendor}", "<i class='feather icon-eye'></i>Detail", ['class' => 'btn btn-sm btn-gradient-info']) ?>
                                                <?php echo anchor("master/vendor/update/{$r->id_vendor}", "<i class='feather icon-edit'></i>Edit", ['class' => 'btn btn-sm btn-gradient-warning']) ?>
                                                <a href="#" data-url="<?php echo site_url('master/vendor/delete/' . $r->id_vendor); ?>" class="btn btn-sm btn-gradient-danger remove-vendor">
                                                    <i class='feather icon-trash-2'></i>Hapus
                                                </a>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Konfirmasi Hapus dengan SweetAlert2 -->
<script>
    // Gunakan event delegation untuk menghindari duplikasi event listener
document.addEventListener('click', function(event) {
    if (event.target.closest('.remove-vendor')) {
        event.preventDefault();
        const button = event.target.closest('.remove-vendor');
        const url = button.getAttribute('data-url');

        // Tampilkan konfirmasi SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan penghapusan dengan AJAX
                $.ajax({
                    url: url,
                    type: 'POST', // Sesuaikan dengan metode yang digunakan di server
                    success: function(response) {
                        // Tampilkan notifikasi berhasil
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil dihapus.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Reload halaman setelah sukses
                        });
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan notifikasi gagal
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }
});

</script>
