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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5><?= $title ?></h5>
                <div class="card-header-right">
                    <div class="float-right"></div>
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
                <?= $formopen ?>
                <div class="form-row">
                    <?= $lnim ?>
                    <?= $inputnim; ?>
                    <?= $fe_nim ?>
                    <div class="invalid-feedback"><?= $ivnim ?></div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="form-row">
                    <?= $lnama_mhs ?>
                    <?= $inputnama_mhs ?>
                    <?= $fe_namamhs ?>
                    <div class="invalid-feedback"><?= $ivnama_mhs ?></div>
                    <div class="valid-feedback"></div>
                </div>
                <div class="form-row">
                    <?= $lfakultas ?>
                    <?= $ddfakultas ?>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?= $lprodi ?>
                        <?= $ddprodi ?>
                    </div>
                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?= $lemail ?>
                        <?= $iemail ?>
                        <?= $fe_email ?>
                        <div class="invalid-feedback"><?= $ivemail ?></div>
                        <div class="valid-feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <?= $lno_telp ?>
                        <?= $inputno_telp ?>
                        <?= $fe_notelp ?>
                        <div class="invalid-feedback"><?= $ivnotelp ?></div>
                        <div class="valid-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <?= $ltanggal_lahir ?> <!-- Label untuk tanggal lahir -->
                        <?= $inputtanggal_lahir ?> <!-- Input untuk tanggal lahir -->
                        <div class="invalid-feedback"><?= $ivtanggal_lahir ?></div>
                        <div class="valid-feedback"></div>
                    </div>
                </div>
                <?= $inputid ?>
                <?= $submit ?>
                <?= $formclose ?>
                <div class="form-row"></div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- SweetAlert Script -->
<script type="text/javascript">
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= $this->session->flashdata('success') ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= $this->session->flashdata('error') ?>',
                showConfirmButton: true,
            });
        <?php endif; ?>

        // Dropdown dinamis fakultas & prodi
        $('#fakultas').change(function() {
            var fakultas_id = $(this).val();
            if (fakultas_id != '') {
                $.ajax({
                    url: "<?php echo base_url('mahasiswa/get_prodi_by_fakultas'); ?>",
                    method: "POST",
                    data: {fakultas_id: fakultas_id},
                    success: function(data) {
                        $('#prodi').html(data);
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal mengambil data jurusan. Silakan coba lagi.',
                            showConfirmButton: true,
                        });
                    }
                });
            } else {
                $('#prodi').html('<option value="">Pilih Jurusan</option>'); // Reset dropdown jika fakultas tidak dipilih
            }
        });
    });
</script>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>


