<style>
    table,
    tr,
    td,
    th {
        text-align: center;
    }

    .img-fluid {
        max-height: 75px;
        min-height: 75px;
        max-width: 75px;
        min-width: 75px;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .file-icon {
        font-size: 24px;
        margin-right: 5px;
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
                    <li class="breadcrumb-item"><a href="<?= site_url('home') ?>"><i class="feather icon-home"></i></a></li>
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
            <div class="card-body">
                <!-- Pesan Flashdata Sukses -->
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <!-- Pesan Flashdata Error -->
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <div class="dt-responsive table-responsive">
                    <table id="table-style-hover" class="table table-striped table-hover table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Seminar</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($file as $s) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $s->nama_seminar ?></td>
                                    <td><?= date('d M Y', strtotime($s->tgl_pelaksana)) ?></td>
                                    <td>
                                        <div class="col-sm-12">
                                    
                                                <?php if (!empty($s->file)) { ?>
                                                    <i class="file-icon fas fa-file-download"></i>
                                                    <span><?= htmlspecialchars($s->file) ?></span> <!-- Nama file hanya ditampilkan sebagai teks biasa -->
                                                <?php } else { ?>
                                                    <span>No File</span>
                                                <?php } ?>
                                        
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-end">
                                            <!-- Form Upload -->
                                            <form action="<?= site_url('file/upload/' . $s->id_seminar) ?>" method="post" enctype="multipart/form-data" class="d-block">
                                                <input type="file" name="file" accept="*/*" required>
                                                <button type="submit" class="btn btn-sm btn-gradient-success">Upload</button>
                                            </form>

                                            <!-- Tombol Hapus di Bawah Upload -->
                                            <?php if (!empty($s->file)) { ?>
                                                <a href="<?= site_url('file/hapus_file/' . $s->id_seminar) ?>" class="btn btn-sm btn-gradient-danger mt-2">Hapus</a>
                                            <?php } else { ?>
                                                <button class="btn btn-sm btn-secondary mt-2" disabled>Hapus</button>
                                            <?php } ?>
                                        </div>
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
