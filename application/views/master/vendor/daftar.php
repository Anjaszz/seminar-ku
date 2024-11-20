<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Form Pendaftaran Mahasiswa</h2>
        <form action="<?php echo base_url('mahasiswa/simpan'); ?>" method="POST">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="number" name="nim" class="form-control" placeholder="Masukkan NIM" required>

            </div>
            <div class="form-group">
                <label for="nama_mhs">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No Telpon</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>

            <!-- Dropdown Fakultas -->
            <div class="form-group">
                <label for="fakultas">Fakultas</label>
                <select class="form-control" id="fakultas" name="id_fakultas" required>
                    <option value="">-- Pilih Fakultas --</option>
                    <?php foreach ($fakultas as $row) { ?>
                        <option value="<?php echo $row->id_fakultas; ?>"><?php echo $row->nama_fakultas; ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Dropdown Jenjang -->
            <div class="form-group">
                <label for="jenjang">Jenjang</label>
                <select class="form-control" id="jenjang" name="id_jenjang" required>
                    <option value="">-- Pilih Jenjang --</option>
                </select>
            </div>

            <!-- Dropdown Prodi -->
            <div class="form-group">
                <label for="prodi">Prodi</label>
                <select class="form-control" id="prodi" name="id_prodi" required>
                    <option value="">-- Pilih Prodi --</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
    </div>

    <script>
        // Mengambil data jenjang berdasarkan fakultas yang dipilih
        $('#fakultas').change(function() {
            var id_fakultas = $(this).val();
            if (id_fakultas != '') {
                $.ajax({
                    url: "<?php echo base_url('mahasiswa/getJenjangByFakultas'); ?>",
                    method: "POST",
                    data: { id_fakultas: id_fakultas },
                    dataType: "json",
                    success: function(data) {
                        $('#jenjang').html('<option value="">-- Pilih Jenjang --</option>');
                        $.each(data, function(key, value) {
                            $('#jenjang').append('<option value="' + value.id_jenjang + '">' + value.nama_jenjang + '</option>');
                        });
                    }
                });
            }
        });

        // Mengambil data prodi berdasarkan jenjang yang dipilih
        $('#jenjang').change(function() {
            var id_jenjang = $(this).val();
            if (id_jenjang != '') {
                $.ajax({
                    url: "<?php echo base_url('mahasiswa/getProdiByJenjang'); ?>",
                    method: "POST",
                    data: { id_jenjang: id_jenjang },
                    dataType: "json",
                    success: function(data) {
                        $('#prodi').html('<option value="">-- Pilih Prodi --</option>');
                        $.each(data, function(key, value) {
                            $('#prodi').append('<option value="' + value.id_prodi + '">' + value.nama_prodi + '</option>');
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>
