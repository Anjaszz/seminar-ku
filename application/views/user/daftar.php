<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Daftar Mahasiswa</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        body {
            background: linear-gradient(135deg, #00bfff, #ACB6E5);
            height: 110vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #00bfff;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #ACB6E5;
            box-shadow: 0 0 10px rgba(173, 216, 230, 0.4);
        }

        .btn-primary {
            background: linear-gradient(45deg, #00bfff, #ACB6E5);
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: bold;
            box-shadow: 0 6px 20px rgba(173, 216, 230, 0.5);
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #ACB6E5, #74ebd5);
            box-shadow: 0 12px 40px rgba(173, 216, 230, 0.8);
        }

        h1 {
            color: #fff;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Form Simulasi SIMAS</h1>
        <div class="card shadow-lg">
            <div class="card-body">
                <form id="form-daftar" action="<?= base_url('daftar/simpan'); ?>" method="post" class="row g-3">
                    <div class="col-md-6">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" id="nim" name="nim" class="form-control" value="<?= set_value('nim') ?>" placeholder="Masukkan NIM" required>
                    </div>

                    <div class="col-md-6">
                        <label for="nama_mhs" class="form-label">Nama</label>
                        <input type="text" id="nama_mhs" name="nama_mhs" class="form-control" value="<?= set_value('nama_mhs') ?>" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= set_value('email') ?>" placeholder="Masukkan email aktif" required>
                    </div>

                    <div class="col-md-6">
                        <label for="no_telp" class="form-label">No. Telpon</label>
                        <input type="tel" id="no_telp" name="no_telp" class="form-control" inputmode="numeric" pattern="[0-9]*" placeholder="Masukkan nomor telepon" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir') ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="id_jenjang" class="form-label">Jenjang</label>
                        <select id="id_jenjang" name="id_jenjang" class="form-select" required>
                            <option value="">Pilih Jenjang</option>
                            <?php foreach ($jenjang as $j): ?>
                                <option value="<?= $j->id_jenjang ?>"><?= $j->nama_jenjang ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="id_fakultas" class="form-label">Fakultas</label>
                        <select id="id_fakultas" name="id_fakultas" class="form-select" required>
                            <option value="">Pilih Fakultas</option>
                            <?php foreach ($fakultas as $f): ?>
                                <option value="<?= $f->id_fakultas ?>"><?= $f->nama_fakultas ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="id_prodi" class="form-label">Program Studi</label>
                        <select id="id_prodi" name="id_prodi" class="form-select" required>
                            <option value="">Pilih Program Studi</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    $('#form-daftar').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                    }).then(function() {
                        window.location.href = 'user/index';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan pada server. Coba lagi nanti.',
                });
            }
        });
    });

    $(document).ready(function () {
        $('#id_fakultas').change(function () {
            var fakultas_id = $(this).val();
            if (fakultas_id != '') {
                $.ajax({
                    url: "<?= base_url('daftar/get_prodi_by_fakultas') ?>",
                    method: "POST",
                    data: {id_fakultas: fakultas_id},
                    dataType: "json",
                    success: function (data) {
                        var options = '<option value="">Pilih Program Studi</option>';
                        $.each(data, function (key, value) {
                            options += '<option value="' + value.id_prodi + '">' + value.nama_prodi + '</option>';
                        });
                        $('#id_prodi').html(options);
                    }
                });
            }
        });
    });
</script>
</body>
</html>
