<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Vendor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Pesan Flash -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>Pendaftaran Berhasil!</strong> <?= $this->session->flashdata('success') ?>
                <br>
                <a href="<?= base_url('auth/login') ?>" class="btn btn-success mt-2">Login Sekarang</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h2 class="text-center mb-4">Form Pendaftaran Vendor</h2>
        <form action="<?= base_url('vendor/register') ?>" method="post" class="p-4 shadow-sm bg-light rounded">
            <!-- Nama Vendor -->
            <div class="mb-3">
                <label for="nama_vendor" class="form-label">Nama Vendor</label>
                <input type="text" name="nama_vendor" id="nama_vendor" class="form-control" required>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control" required>
            </div>
            <!-- Dropdown Nama Bank -->
            <div class="mb-3">
                <label for="id_bank" class="form-label">Nama Bank</label>
                <select name="id_bank" id="id_bank" class="form-select" required>
                    <option value="" disabled selected>Pilih Bank</option>
                    <?php foreach ($banks as $bank): ?>
                        <option value="<?= $bank->id_bank ?>"><?= $bank->nama_bank ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Nomor Rekening -->
            <div class="mb-3">
                <label for="no_rekening" class="form-label">Nomor Rekening</label>
                <input type="text" name="no_rekening" id="no_rekening" class="form-control" required>
            </div>
            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <!-- Konfirmasi Password -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <!-- Tanggal Langganan -->
            <div class="mb-3">
                <label for="tgl_subs" class="form-label">Tanggal Langganan</label>
                <input type="text" name="tgl_subs" id="tgl_subs" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
            </div>
            <!-- Tanggal Berakhir -->
            <div class="mb-3">
                <label for="tgl_berakhir" class="form-label">Tanggal Berakhir</label>
                <input type="text" name="tgl_berakhir" id="tgl_berakhir" class="form-control" value="<?= date('Y-m-d', strtotime('+1 year')) ?>" readonly>
            </div>
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
