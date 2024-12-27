<style>
    .imgB1 {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 30%;
        position: relative;
        top: 40px;
        z-index: 3;
    }

    #rslt {
        margin-top: -14px;
        height: 525px;
    }

    .card-body {
        position: relative;
    }
</style>

<div class="card" id="rslt">
    <div class="card-header">
        <?= $this->session->flashdata('message'); ?>
        <h5>Hasil</h5>
    </div>
    <div class="card-body">
        
        <div class="row">
            <div class="col-sm-12">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-info btn-icon" href="#!" role="button"><i class="fas fa-calendar-alt"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Nama Seminar</div>
                        <p class="chat-header text-muted"><?= $nama_seminar ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-warning btn-icon" href="#!" role="button"><i class="fas fa-user"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">ID User</div>
                        <p class="chat-header text-muted"><?= $nomor_induk ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-danger btn-icon" href="#!" role="button"><i class="fas fa-user"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Nama Peserta</div>
                        <p class="chat-header text-muted"><?= $nama_mhs ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-primary btn-icon" href="#!" role="button"><i class="fas fa-at"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">Email</div>
                        <p class="chat-header text-muted"><?= $email ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="media">
                    <div class="media-left">
                        <a class="btn btn-outline-success btn-icon" href="#!" role="button"><i class="fas fa-mobile-alt"></i>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="chat-header">No Telepon</div>
                        <p class="chat-header text-muted"><?= $no_telp ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
