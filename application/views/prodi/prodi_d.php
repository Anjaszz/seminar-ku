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
            <div class="card-body p-3 mt-2">
                <div class="">
                    <div class="customer-scroll" style="height:auto;position:relative;">
                        <table id="table-style-hover" class="table  table-hover m-b-0">
                            <thead>
                            <tr>
                                    <th>No</th>
                                    <th>Nama Peserta</th>
                                    <th>Departemen</th>
                                    <th>Jurusan</th>
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                    <th>Aksi
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($prodi as $r) { ?>
                                    <tr>
            <td><?= $no++ ?></td>
            <td>
                <h6 class="m-0"><?= $r->nama_mhs ?></h6>
            </td>
            <td>
                <label class="badge badge-info"><?= $r->kode_fakultas ?></label>
            </td>
            <td>
                <label class="badge badge-success"><?= $r->nama_prodi ?></label> <!-- Tampilkan nama_prodi -->
            </td>
            <td><?= $r->email ?></td>
            <td><?= $r->no_telp ?></td>
            <td>
                <?php echo anchor("mahasiswa/detail/{$r->id_mahasiswa}", "<i class='feather icon-eye'></i>Detail", ['class' => 'btn btn-sm btn-gradient-info']) ?>
                <?php echo anchor("mahasiswa/update/{$r->id_mahasiswa}", "<i class='feather icon-edit'></i>Edit", ['class' => 'btn btn-sm btn-gradient-warning']) ?>
                <a href="#" data-url="<?php echo site_url('mahasiswa/delete/' . $r->id_mahasiswa); ?>" class="btn btn-sm btn-gradient-danger remove-mahasiswa">
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