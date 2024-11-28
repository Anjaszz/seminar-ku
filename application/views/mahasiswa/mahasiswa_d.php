<style>
    .btn-icon,
    .drp-icon {
        width: 40px;
        height: 40px;
        padding: 10px 12px;
        border-radius: 50%;
    }

    .csa {
        max-height: 100px;
        min-width: 100px;
        min-height: 100px;
        max-width: 100px;
    }

    .edit-btn-container {
        text-align: right; /* Align the button to the right */
        margin-top: -50px; /* Adjust vertical position relative to card */
        margin-right: 10px; /* Add some spacing on the right */
    }

    .btn-edit {
        background-color: #f4c542;
        color: white;
        border: none;
    }

    .btn-edit:hover {
        background-color: #e0b638;
        color: white;
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
                    <li class="breadcrumb-item"><a href="#!"><?= $parent ?></a></li>
                    <li class="breadcrumb-item"><a href="#!"><?= $title ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xl-4">
        <div class="card">
            <div class="widget-profile-card-3">
                <img class="img-fluid img-thumbnail csa" src="<?php echo base_url() ?>assets/images/widget/user.png" alt="Profile-user">
            </div>
            <div class="card-body text-center">
                <h3><?= $nama_mhs ?></h3>
            </div>
            <div class="card-footer bg-inverse">
                <div class="row text-center">
                    <div class="col">
                        <h4><?= $nama_prodi ?></h4>
                        <span>Departemen</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="card" style="height:425px;">
            <div class="card-header">
                <h5><?= $title ?></h5>
                <div class="edit-btn-container">
                    <?php echo anchor(
                        "mahasiswa/update/{$id_mahasiswa}",
                        "<i class='feather icon-edit'></i> Edit",
                        ['class' => 'btn btn-edit btn-sm']
                    ); ?>
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
            <div class="card-body">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-danger btn-icon" href="#!" role="button"><i class="fas fa-street-view"></i></a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Departemen</div>
                        <p class="chat-header text-muted"><?= $nama_fakultas ?></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-info btn-icon" href="#!" role="button"><i class="fas fa-tag"></i></a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Jurusan</div>
                        <p class="chat-header text-muted"><?= $nama_prodi ?></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-primary btn-icon" href="#!" role="button"><i class="fas fa-at"></i></a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Email</div>
                        <p class="chat-header text-muted"><?= $email ?></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-success btn-icon" href="#!" role="button"><i class="fas fa-mobile-alt"></i></a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">No Telepon</div>
                        <p class="chat-header text-muted"><?= $no_telp ?></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-info btn-icon" href="#!" role="button"><i class="fas fa-birthday-cake"></i></a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Tanggal Lahir</div>
                        <p class="chat-header text-muted"><?= $tanggal_lahir ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
